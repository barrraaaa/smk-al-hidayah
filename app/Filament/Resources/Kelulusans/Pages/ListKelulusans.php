<?php

namespace App\Filament\Resources\Kelulusans\Pages;

use App\Filament\Resources\Kelulusans\KelulusanResource;
use App\Models\Jurusan;
use App\Models\Kelulusan;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ListKelulusans extends ListRecords
{
    protected static string $resource = KelulusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadTemplate')
                ->label('Download Template CSV')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->url(route('kelulusan.template'))
                ->openUrlInNewTab(),

            Action::make('import')
                ->label('Import CSV')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('warning')
                ->form([
                    Placeholder::make('info')
                        ->label('Petunjuk')
                        ->content('Upload file CSV dengan kolom: nomor_ujian, nama, hasil (lulus/tidak_lulus), jurusan (nama jurusan, optional). Download template untuk contoh format.'),
                    FileUpload::make('csv_file')
                        ->label('Pilih File CSV')
                        ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel', 'application/csv'])
                        ->disk('local')
                        ->directory('import-temp')
                        ->maxSize(2048)
                        ->preserveFilenames()
                        ->required(),
                ])
                ->action(function (array $data) {
                    $filePath = $data['csv_file'];
                    $fullPath = Storage::disk('local')->path($filePath);

                    if (!file_exists($fullPath)) {
                        Notification::make()
                            ->title('File tidak ditemukan')
                            ->danger()
                            ->send();
                        return;
                    }

                    $handle = fopen($fullPath, 'r');
                    if (!$handle) {
                        Notification::make()
                            ->title('Gagal membaca file')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Baca header
                    $headers = fgetcsv($handle);
                    if (!$headers) {
                        fclose($handle);
                        Notification::make()
                            ->title('File CSV kosong')
                            ->danger()
                            ->send();
                        return;
                    }

                    $headers = array_map('trim', $headers);

                    // Hapus BOM (Byte Order Mark) dari Excel
                    $headers[0] = preg_replace('/^\xEF\xBB\xBF/', '', $headers[0]);

                    $headerMap = [
                        'nomor_ujian' => ['nomor_ujian', 'no_ujian', 'no ujian', 'nomor ujian'],
                        'nama' => ['nama', 'name', 'nama_lengkap', 'nama lengkap'],
                        'hasil' => ['hasil', 'result', 'keterangan', 'status'],
                        'jurusan' => ['jurusan', 'jurusan_id', 'program_keahlian', 'program keahlian'],
                    ];

                    // Map header ke field internal
                    $fieldMap = [];
                    foreach ($headers as $i => $header) {
                        $lower = strtolower($header);
                        foreach ($headerMap as $field => $aliases) {
                            if (in_array($lower, $aliases)) {
                                $fieldMap[$i] = $field;
                                break;
                            }
                        }
                    }

                    // Validasi header wajib
                    if (!isset(array_flip($fieldMap)['nomor_ujian']) || !isset(array_flip($fieldMap)['nama']) || !isset(array_flip($fieldMap)['hasil'])) {
                        fclose($handle);
                        Notification::make()
                            ->title('Format CSV tidak valid')
                            ->body('Kolom wajib: nomor_ujian, nama, hasil. Download template untuk contoh.')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Cache jurusan untuk lookup
                    $jurusanCache = Jurusan::pluck('id', 'nama')->toArray();

                    $rowNumber = 1;
                    $imported = 0;
                    $errors = [];
                    $duplicates = 0;

                    DB::beginTransaction();
                    try {
                        while (($row = fgetcsv($handle)) !== false) {
                            $rowNumber++;
                            $dataRow = [];
                            foreach ($fieldMap as $i => $field) {
                                $dataRow[$field] = trim($row[$i] ?? '');
                            }

                            // Validasi
                            if (empty($dataRow['nomor_ujian'])) {
                                $errors[] = "Baris {$rowNumber}: Nomor ujian kosong";
                                continue;
                            }
                            if (empty($dataRow['nama'])) {
                                $errors[] = "Baris {$rowNumber}: Nama kosong";
                                continue;
                            }
                            if (!in_array($dataRow['hasil'], ['lulus', 'tidak_lulus'])) {
                                $errors[] = "Baris {$rowNumber}: Hasil harus 'lulus' atau 'tidak_lulus' (ditemukan: '{$dataRow['hasil']}')";
                                continue;
                            }

                            // Cek duplikat
                            $exists = Kelulusan::where('nomor_ujian', $dataRow['nomor_ujian'])->exists();
                            if ($exists) {
                                $duplicates++;
                                continue;
                            }

                            // Cari jurusan
                            $jurusanId = null;
                            if (!empty($dataRow['jurusan'])) {
                                $jurusanName = trim($dataRow['jurusan']);
                                if (isset($jurusanCache[$jurusanName])) {
                                    $jurusanId = $jurusanCache[$jurusanName];
                                } else {
                                    $errors[] = "Baris {$rowNumber}: Jurusan '{$jurusanName}' tidak ditemukan. Data tetap diimport tanpa jurusan.";
                                }
                            }

                            Kelulusan::create([
                                'nomor_ujian' => $dataRow['nomor_ujian'],
                                'nama' => $dataRow['nama'],
                                'hasil' => $dataRow['hasil'],
                                'jurusan_id' => $jurusanId,
                            ]);

                            $imported++;
                        }

                        DB::commit();

                        // Hapus file temp
                        fclose($handle);
                        Storage::disk('local')->delete($filePath);

                        $summary = "Berhasil import {$imported} data.";
                        if ($duplicates > 0) {
                            $summary .= " {$duplicates} data duplikat dilewati.";
                        }
                        if (count($errors) > 0) {
                            $summary .= " " . count($errors) . " baris error.";
                        }

                        Notification::make()
                            ->title('Import Selesai')
                            ->body($summary)
                            ->success()
                            ->send();

                        if (count($errors) > 0) {
                            $errorText = implode("\n", array_slice($errors, 0, 20));
                            if (count($errors) > 20) {
                                $errorText .= "\n... dan " . (count($errors) - 20) . " error lainnya";
                            }
                            Notification::make()
                                ->title('Detail Error')
                                ->body($errorText)
                                ->warning()
                                ->send();
                        }

                    } catch (\Exception $e) {
                        DB::rollBack();
                        fclose($handle);
                        Storage::disk('local')->delete($filePath);

                        Notification::make()
                            ->title('Gagal Import')
                            ->body('Terjadi kesalahan: ' . $e->getMessage())
                            ->danger()
                            ->send();
                        return;
                    }

                    // Notifikasi jika tidak ada data
                    if ($imported === 0 && $duplicates === 0 && count($errors) === 0) {
                        Notification::make()
                            ->title('File CSV kosong')
                            ->body('File CSV tidak memiliki data setelah header. Isi file dengan data kelulusan.')
                            ->warning()
                            ->send();
                    }
                }),
        ];
    }
}
