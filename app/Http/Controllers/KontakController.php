<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email|max:255',
            'no_telepon' => 'nullable|max:20|regex:/^[0-9\-\+\s\(\)]+$/',
            'pesan' => 'required|min:10',
        ]);

        $pesan = PesanKontak::create($validated);

        // Kirim notifikasi ke semua admin
        $adminUsers = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['super_admin', 'admin_staff']);
        })->get();

        foreach ($adminUsers as $user) {
            $user->notify(
                Notification::make()
                    ->title('✉️ Pesan Baru dari ' . $validated['nama'])
                    ->body(Str::limit(strip_tags($validated['pesan']), 120))
                    ->icon('heroicon-o-envelope')
                    ->actions([
                        \Filament\Notifications\Actions\Action::make('lihat')
                            ->label('Lihat Pesan')
                            ->url('/admin/pesan-kontaks/' . $pesan->id . '/edit'),
                    ])
                    ->toDatabase()
            );
        }

        return back()->with('success', 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.');
    }
}
