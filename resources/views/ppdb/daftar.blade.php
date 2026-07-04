@extends('layouts.app')

@section('title', 'Form Pendaftaran PPDB — SMK Alhidayah')

@section('content')
{{-- Hero kecil --}}
<section class="bg-primary-dark relative overflow-hidden pt-32">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/95 via-primary/90 to-primary-dark/95"></div>
    <div class="container-page relative py-16 text-center">
        <div class="section-title-tag justify-center mb-4">
            <span class="text-accent">PPDB {{ date('Y') }}</span>
        </div>
        <h1 class="font-heading text-4xl font-bold text-white">Formulir Pendaftaran Online</h1>
        <p class="mx-auto mt-3 max-w-xl text-white/75">Isi data dengan lengkap dan benar</p>
    </div>
</section>

<section class="section-padding">
    <div class="container-page">
        <div class="mx-auto max-w-3xl">
            {{-- Progress Stepper --}}
            <div class="mb-10" id="stepper">
                <div class="flex items-center justify-between">
                    <div class="step-item active" data-step="1">
                        <div class="step-circle">1</div>
                        <span class="step-label">Data Pribadi</span>
                    </div>
                    <div class="step-line" data-step="1"></div>
                    <div class="step-item" data-step="2">
                        <div class="step-circle">2</div>
                        <span class="step-label">Pilih Jurusan</span>
                    </div>
                    <div class="step-line" data-step="2"></div>
                    <div class="step-item" data-step="3">
                        <div class="step-circle">3</div>
                        <span class="step-label">Upload Dokumen</span>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data" id="form-ppdb" class="card">
                @csrf

                {{-- Error Summary --}}
                @if($errors->any())
                <div class="mb-6 rounded-md bg-danger/10 px-4 py-3 text-sm text-danger">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- ============ STEP 1: DATA PRIBADI ============ --}}
                <div class="step-content" data-step="1">
                    <h2 class="font-heading text-2xl font-bold text-text-heading mb-6">Data Pribadi</h2>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="input-field" required>
                        </div>
                        <div>
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="input-field" required>
                        </div>
                        <div>
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="input-field" required max="{{ date('Y-m-d', strtotime('-12 years')) }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" rows="3" class="input-field" required>{{ old('alamat') }}</textarea>
                        </div>
                        <div>
                            <label class="form-label">No. Telepon/HP</label>
                            <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" class="input-field" required>
                        </div>
                        <div>
                            <label class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="input-field" required>
                        </div>
                    </div>

                    <h3 class="font-heading text-xl font-bold text-text-heading mt-8 mb-4">Data Orang Tua/Wali</h3>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label class="form-label">Nama Orang Tua/Wali</label>
                            <input type="text" name="nama_ortu" value="{{ old('nama_ortu') }}" class="input-field" required>
                        </div>
                        <div>
                            <label class="form-label">No. Telepon Orang Tua</label>
                            <input type="tel" name="no_telepon_ortu" value="{{ old('no_telepon_ortu') }}" class="input-field" required>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button type="button" class="theme-btn" onclick="nextStep(2)">
                            Selanjutnya
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- ============ STEP 2: PILIH JURUSAN ============ --}}
                <div class="step-content hidden" data-step="2">
                    <h2 class="font-heading text-2xl font-bold text-text-heading mb-6">Pilih Jurusan</h2>
                    <p class="text-text-body/70 mb-6">Pilih salah satu jurusan yang tersedia di SMK Alhidayah</p>

                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach($jurusans as $j)
                        <label class="jurusan-option relative cursor-pointer">
                            <input type="radio" name="jurusan_id" value="{{ $j->id }}" class="sr-only peer" {{ old('jurusan_id') == $j->id ? 'checked' : '' }} required>
                            <div class="rounded-lg border-2 border-border p-5 transition-all duration-200 peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:ring-2 peer-checked:ring-primary/20 hover:border-primary/50">
                                <div class="flex items-start gap-4">
                                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-primary to-primary-light text-lg font-bold text-white">
                                        {{ substr($j->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-heading font-bold text-text-heading">{{ $j->nama }}</h3>
                                        <p class="mt-1 text-sm text-text-body/70 line-clamp-2">{{ $j->deskripsi }}</p>
                                    </div>
                                </div>
                                <div class="mt-3 hidden peer-checked:flex items-center gap-1 text-sm font-semibold text-primary">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Dipilih
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>

                    <div class="mt-8 flex items-center justify-between">
                        <button type="button" class="theme-btn-outline" onclick="prevStep(1)">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Sebelumnya
                        </button>
                        <button type="button" class="theme-btn" onclick="nextStep(3)">
                            Selanjutnya
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- ============ STEP 3: UPLOAD DOKUMEN ============ --}}
                <div class="step-content hidden" data-step="3">
                    <h2 class="font-heading text-2xl font-bold text-text-heading mb-2">Upload Dokumen</h2>
                    <p class="text-text-body/70 mb-6">Upload dokumen persyaratan dalam format PDF/JPG/PNG (maks. 2MB per file).<br>Kosongkan jika belum punya, bisa diupload nanti.</p>

                    <div class="space-y-5">
                        <div class="upload-box" data-for="dokumen_ijazah">
                            <label class="form-label">Ijazah / SKBH</label>
                            <div class="mt-1 flex items-center gap-4">
                                <div class="upload-area flex-1 cursor-pointer rounded-lg border-2 border-dashed border-border p-6 text-center transition-colors hover:border-primary hover:bg-primary/5" onclick="document.getElementById('dokumen_ijazah').click()">
                                    <svg class="mx-auto h-8 w-8 text-text-body/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-text-body/60">Klik untuk upload atau seret file ke sini</p>
                                    <p class="text-xs text-text-body/40">PDF, JPG, PNG (maks. 2MB)</p>
                                </div>
                                <div class="upload-preview hidden text-center">
                                    <svg class="mx-auto h-8 w-8 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="mt-1 text-xs text-text-body/60 file-name"></p>
                                    <button type="button" class="mt-1 text-xs text-danger hover:underline" onclick="removeFile('dokumen_ijazah')">Hapus</button>
                                </div>
                            </div>
                            <input type="file" id="dokumen_ijazah" name="dokumen_ijazah" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="previewFile(this, 'dokumen_ijazah')">
                        </div>

                        <div class="upload-box" data-for="dokumen_kk">
                            <label class="form-label">Kartu Keluarga (KK)</label>
                            <div class="mt-1 flex items-center gap-4">
                                <div class="upload-area flex-1 cursor-pointer rounded-lg border-2 border-dashed border-border p-6 text-center transition-colors hover:border-primary hover:bg-primary/5" onclick="document.getElementById('dokumen_kk').click()">
                                    <svg class="mx-auto h-8 w-8 text-text-body/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-text-body/60">Klik untuk upload</p>
                                    <p class="text-xs text-text-body/40">PDF, JPG, PNG (maks. 2MB)</p>
                                </div>
                                <div class="upload-preview hidden text-center">
                                    <svg class="mx-auto h-8 w-8 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="mt-1 text-xs text-text-body/60 file-name"></p>
                                    <button type="button" class="mt-1 text-xs text-danger hover:underline" onclick="removeFile('dokumen_kk')">Hapus</button>
                                </div>
                            </div>
                            <input type="file" id="dokumen_kk" name="dokumen_kk" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="previewFile(this, 'dokumen_kk')">
                        </div>

                        <div class="upload-box" data-for="dokumen_pas_foto">
                            <label class="form-label">Pas Foto 3×4</label>
                            <div class="mt-1 flex items-center gap-4">
                                <div class="upload-area flex-1 cursor-pointer rounded-lg border-2 border-dashed border-border p-6 text-center transition-colors hover:border-primary hover:bg-primary/5" onclick="document.getElementById('dokumen_pas_foto').click()">
                                    <svg class="mx-auto h-8 w-8 text-text-body/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-text-body/60">Klik untuk upload</p>
                                    <p class="text-xs text-text-body/40">JPG, PNG (maks. 2MB)</p>
                                </div>
                                <div class="upload-preview hidden text-center">
                                    <svg class="mx-auto h-8 w-8 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="mt-1 text-xs text-text-body/60 file-name"></p>
                                    <button type="button" class="mt-1 text-xs text-danger hover:underline" onclick="removeFile('dokumen_pas_foto')">Hapus</button>
                                </div>
                            </div>
                            <input type="file" id="dokumen_pas_foto" name="dokumen_pas_foto" accept=".jpg,.jpeg,.png" class="hidden" onchange="previewFile(this, 'dokumen_pas_foto')">
                        </div>

                        <div class="upload-box" data-for="dokumen_akta">
                            <label class="form-label">Akta Kelahiran</label>
                            <div class="mt-1 flex items-center gap-4">
                                <div class="upload-area flex-1 cursor-pointer rounded-lg border-2 border-dashed border-border p-6 text-center transition-colors hover:border-primary hover:bg-primary/5" onclick="document.getElementById('dokumen_akta').click()">
                                    <svg class="mx-auto h-8 w-8 text-text-body/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-text-body/60">Klik untuk upload</p>
                                    <p class="text-xs text-text-body/40">PDF, JPG, PNG (maks. 2MB)</p>
                                </div>
                                <div class="upload-preview hidden text-center">
                                    <svg class="mx-auto h-8 w-8 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="mt-1 text-xs text-text-body/60 file-name"></p>
                                    <button type="button" class="mt-1 text-xs text-danger hover:underline" onclick="removeFile('dokumen_akta')">Hapus</button>
                                </div>
                            </div>
                            <input type="file" id="dokumen_akta" name="dokumen_akta" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="previewFile(this, 'dokumen_akta')">
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-between">
                        <button type="button" class="theme-btn-outline" onclick="prevStep(2)">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Sebelumnya
                        </button>
                        <button type="submit" class="theme-btn">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Daftar Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    let currentStep = 1;

    function updateStepper(step) {
        document.querySelectorAll('.step-item').forEach(el => {
            const s = parseInt(el.dataset.step);
            el.classList.toggle('active', s <= step);
            el.classList.toggle('completed', s < step);
        });
        document.querySelectorAll('.step-line').forEach(el => {
            const s = parseInt(el.dataset.step);
            el.classList.toggle('active', s < step);
        });
        document.querySelectorAll('.step-content').forEach(el => {
            el.classList.toggle('hidden', parseInt(el.dataset.step) !== step);
        });
    }

    function nextStep(step) {
        // Basic validation before moving forward
        const currentContent = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        const requiredFields = currentContent.querySelectorAll('[required]');
        let valid = true;
        requiredFields.forEach(f => {
            if (!f.value || (f.type === 'radio' && !document.querySelector(`input[name="${f.name}"]:checked`))) {
                f.classList.add('border-danger');
                valid = false;
            } else {
                f.classList.remove('border-danger');
            }
        });
        if (!valid) return;
        currentStep = step;
        updateStepper(step);
        window.scrollTo({ top: document.getElementById('stepper').offsetTop - 120, behavior: 'smooth' });
    }

    function prevStep(step) {
        currentStep = step;
        updateStepper(step);
        window.scrollTo({ top: document.getElementById('stepper').offsetTop - 120, behavior: 'smooth' });
    }

    function previewFile(input, id) {
        const box = document.querySelector(`.upload-box[data-for="${id}"]`);
        const area = box.querySelector('.upload-area');
        const preview = box.querySelector('.upload-preview');
        const fileName = preview.querySelector('.file-name');

        if (input.files && input.files[0]) {
            area.classList.add('hidden');
            preview.classList.remove('hidden');
            fileName.textContent = input.files[0].name;
        }
    }

    function removeFile(id) {
        const input = document.getElementById(id);
        const box = document.querySelector(`.upload-box[data-for="${id}"]`);
        const area = box.querySelector('.upload-area');
        const preview = box.querySelector('.upload-preview');

        input.value = '';
        area.classList.remove('hidden');
        preview.classList.add('hidden');
    }

    // Form submission validation
    document.getElementById('form-ppdb').addEventListener('submit', function(e) {
        const jurusanSelected = document.querySelector('input[name="jurusan_id"]:checked');
        if (!jurusanSelected) {
            e.preventDefault();
            nextStep(2);
            document.querySelector('.step-content[data-step="2"] .text-danger')?.remove();
            const msg = document.createElement('p');
            msg.className = 'text-danger text-sm mt-2';
            msg.textContent = 'Silakan pilih jurusan terlebih dahulu.';
            document.querySelector('.step-content[data-step="2"] .grid').after(msg);
        }
    });

    // Initialize
    updateStepper(1);
</script>
@endpush

@push('head')
<style>
    .step-item { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; }
    .step-circle { width: 2.5rem; height: 2.5rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.875rem; background: #e5e7eb; color: #9ca3af; transition: all 0.3s; }
    .step-item.active .step-circle { background: #254636; color: white; box-shadow: 0 4px 6px -1px rgb(37 70 54 / 0.3); }
    .step-item.completed .step-circle { background: #50bc84; color: white; }
    .step-item.completed .step-circle::after { content: '✓'; font-size: 1.25rem; }
    .step-item.completed .step-circle span { display: none; }
    .step-label { font-size: 0.75rem; font-weight: 500; color: #9ca3af; transition: color 0.3s; white-space: nowrap; }
    .step-item.active .step-label { color: #254636; font-weight: 600; }
    .step-item.completed .step-label { color: #50bc84; }
    .step-line { flex: 1; height: 2px; background: #e5e7eb; margin: 0 0.5rem; margin-bottom: 2rem; transition: background 0.3s; }
    .step-line.active { background: #50bc84; }
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #1f2937; margin-bottom: 0.375rem; }
    .theme-btn-outline { display: inline-flex; align-items: center; gap: 0.5rem; border-radius: 0.5rem; border: 2px solid #254636; padding: 0.75rem 1.5rem; font-weight: 600; color: #254636; transition: all 0.2s; }
    .theme-btn-outline:hover { background: #254636; color: white; }
</style>
@endpush
@endsection
