---
title: PRD Website SMK Alhidayah
status: draft
created: 2026-07-04
updated: 2026-07-04
product: Website Profil + PPDB SMK Alhidayah
version: 1.0
author: Mahaguru
---

# PRD — Website SMK Alhidayah

> **Visi:** Modernisasi portal digital SMK Alhidayah — mencerminkan identitas Islam modern, memudahkan PPDB, dan menyajikan informasi sekolah secara profesional.

---

## 1. Ringkasan Eksekutif

Website SMK Alhidayah adalah portal digital resmi SMK Alhidayah (di bawah Yayasan Islam) yang mencakup:
- **Profil sekolah** sebagai wajah digital
- **Platform PPDB** untuk penerimaan siswa baru
- **Manajemen artikel & konten** untuk publikasi berita dan pengumuman**

Dibangun dengan **Laravel + Filament + Tailwind CSS + MySQL**, mengadopsi nuansa islami modern (referensi template Al-Quran) dan menyasar 4 jurusan: AKL, Pemasaran, MPLB, dan TJKT.

---

## 2. Target Audiens & User Persona

| Persona | Peran | Tujuan Utama |
|---------|------|-------------|
| **Rudi** | Calon siswa SMP | Cari info jurusan, daftar PPDB, cek status pendaftaran |
| **Bu Siti** | Orang tua calon siswa | Cek biaya, prospek kerja, kredibilitas sekolah |
| **Pak Ahmad** | Admin/guru sekolah | Validasi PPDB, kelola konten, lihat statistik |
| **Publik** | Masyarakat umum | Lihat profil, galeri, prestasi, berita |

---

## 3. User Journeys

### UJ-1: Rudi — Calon Siswa (PPDB)
1. Buka website → lihat Beranda & Profil Sekolah
2. Jelajahi halaman jurusan → pelajari prospek kerja
3. Pilih jurusan → isi formulir PPDB + upload dokumen
4. Lakukan pembayaran → status "Menunggu Pembayaran"
5. Upload bukti bayar
6. Admin approve → Rudi resmi diterima
7. Cek status pendaftaran kapan saja

### UJ-2: Bu Siti — Orang Tua
1. Lihat Profil Sekolah (akreditasi, visi-misi)
2. Cari Info Biaya PPDB
3. Lihat halaman jurusan → prospek kerja
4. Lihat Galeri & Prestasi untuk validasi
5. Hubungi Kontak jika ragu

### UJ-3: Pak Ahmad — Admin
1. Dapat notifikasi pembayaran masuk
2. Validasi bukti bayar → approve/tolak
3. Lihat Statistik PPDB (per jurusan, total)
4. Tambah/edit artikel jika diperlukan
5. Upload galeri/prestasi/info jurusan

---

## 4. Fitur & Fungsionalitas

### FR-01: Beranda (Halaman Utama)
- Hero section dengan tagline & CTA
- Ringkasan jurusan (4 kartu jurusan)
- Berita/artikel terbaru (3-4 post)
- Prestasi terbaru
- CTA PPDB (saat musim pendaftaran)

### FR-02: Profil Sekolah
- Halaman: Sejarah, Visi & Misi
- Struktur Organisasi
- Daftar Guru & Tenaga Pengajar
- Identitas Islami (navbar, footer, nuansa hijau)

### FR-03: Halaman Jurusan (`/jurusan/{slug}`)
- **AKL** — Akuntansi Keuangan dan Lembaga
- **Pemasaran**
- **MPLB** — Manajemen Perkantoran dan Layanan Bisnis
- **TJKT** — Teknik Jaringan Komputer dan Telekomunikasi

Setiap halaman berisi:
- Profil jurusan
- Kepala jurusan (foto + bio)
- Kurikulum & mata pelajaran inti
- Prospek kerja / karier
- Kegiatan jurusan (foto)

### FR-04: PPDB (Penerimaan Peserta Didik Baru)
- Halaman info PPDB: jadwal, biaya, syarat
- Form pendaftaran online:
  - Data calon siswa (nama, tempat/tgl lahir, alamat, dll)
  - Pilihan jurusan
  - Upload dokumen (ijazah, KK, pas foto, dll)
- Status pendaftaran:
  - **Menunggu Pembayaran** → setelah submit form
  - Upload bukti bayar
  - **Terverifikasi** → setelah admin approve
- Cek status pendaftaran (input nomor pendaftaran)

### FR-05: Cek Kelulusan
- Input nomor ujian/NISN
- Tampilkan hasil: **LULUS / TIDAK LULUS** + info tambahan

### FR-06: Manajemen Artikel
- CRUD artikel (berita, pengumuman, prestasi)
- Kategori artikel
- Tags
- Search & pagination
- Admin dashboard: statistik, notifikasi PPDB

### FR-07: Prestasi
- Galeri prestasi (akademik & non-akademik)
- Tampilan grid dengan filter jurusan/tahun

### FR-08: Ekstrakurikuler
- Daftar ekskul
- Halaman detail per ekskul
- Foto kegiatan

### FR-09: Galeri
- Galeri foto kegiatan sekolah
- Lightbox preview

### FR-10: Kontak
- Alamat, no telepon, email
- Google Maps embed
- Form pesan cepat

---

## 5. Admin Panel (Filament)

| Modul | Fitur |
|-------|-------|
| **Dashboard** | Statistik PPDB, notifikasi pembayaran |
| **PPDB** | Daftar pendaftar, detail, validasi bukti bayar, approve/tolak |
| **Artikel** | CRUD, kategori, tags, publish/unpublish |
| **Jurusan** | CRUD konten per jurusan, kepala jurusan |
| **Guru** | CRUD data guru & tenaga pengajar |
| **Prestasi** | CRUD prestasi |
| **Ekskul** | CRUD ekstrakurikuler |
| **Galeri** | Upload & manage galeri foto |
| **Kelulusan** | Input data kelulusan (nomor ujian → hasil) |
| **Kontak** | Lihat pesan masuk |
| **Pengaturan** | Profil sekolah, visi misi, biaya PPDB |

---

## 6. Alur PPDB Detail

```
1. Calon siswa buka halaman PPDB
2. Baca info & biaya
3. Klik "Daftar Sekarang"
4. Isi formulir:
   - Data pribadi
   - Pilih jurusan (1 pilihan)
   - Upload dokumen (ijazah, KK, pas foto, akta lahir)
5. Submit → Sistem generate nomor pendaftaran
6. Status: "Menunggu Pembayaran"
7. Calon siswa bayar → upload bukti bayar
8. Admin dapat notifikasi → cek bukti bayar
9. Admin approve → Status: "Diterima"
10. Calon siswa cek status & cetak bukti diterima
```

---

## 7. Kebutuhan Non-Fungsional

| NFR-ID | Deskripsi |
|--------|-----------|
| NFR-01 | **Keamanan**: Role-based access control (Admin, Public) |
| NFR-02 | **Performa**: Waktu muat halaman < 3 detik |
| NFR-03 | **Responsive**: Mobile-first, semua halaman responsif |
| NFR-04 | **SEO**: Meta tags, sitemap, slug URL yang rapi |
| NFR-05 | **Backup**: Database di-backup berkala |
| NFR-06 | **Maintainability**: Kode modular, dokumentasi minimal |

---

## 8. Tech Stack

| Layer | Teknologi | Keterangan |
|-------|-----------|------------|
| Backend | Laravel 11 | PHP framework |
| Database | MySQL / MariaDB | Relational database |
| Frontend | Blade + Tailwind CSS | Server-side rendering + utility CSS |
| Admin Panel | Filament PHP | Rapid admin panel builder |
| File Upload | Laravel Storage | Untuk dokumen PPDB & galeri |
| Notifikasi | Database Notifications | Notifikasi PPDB di admin panel |
| Hosting | Shared hosting / VPS | Niagahoster, DomaiNesia, dll |

### Tampilan Visual
- **Referensi:** Template Al-Quran (nuansa hijau islami modern)
- **Warna:** Hijau emerald + emas/navy sebagai aksen
- **Font:** Modern & readable (Inter, Plus Jakarta Sans, atau sejenisnya)
- **Gaya:** Clean, profesional, islami

---

## 9. Struktur URL

```
/
/profil
/profil/sejarah
/profil/visi-misi
/profil/struktur-organisasi
/profil/guru
/jurusan/akl
/jurusan/pemasaran
/jurusan/mplb
/jurusan/tjkt
/ppdb
/ppdb/daftar
/ppdb/status
/prestasi
/ekstrakurikuler
/galeri
/artikel
/artikel/{slug}
/pengumuman-kelulusan
/kontak
/admin/**  (Filament panel)
```

---

## 10. Prioritas Fitur (MVP = Semua)

Seluruh fitur dikerjakan dalam satu fase, tanpa MVP bertahap:

| Prioritas | Fitur |
|-----------|-------|
| P0 | Beranda, Profil Sekolah, 4 Halaman Jurusan |
| P0 | PPDB (full flow: daftar → bayar → upload bukti → verifikasi) |
| P0 | Admin Panel (Filament) + Statistik + Notifikasi |
| P0 | Artikel/Blog |
| P0 | Cek Kelulusan |
| P1 | Galeri, Prestasi, Ekstrakurikuler |
| P1 | Kontak (dengan Google Maps & form pesan) |

---

## 11. Open Questions

- [ ] Berapa biaya PPDB yang akan ditampilkan di website?
- [ ] Apakah perlu integrasi payment gateway (midtrans, dll) atau manual transfer saja?
- [ ] Siapa yang akan menjadi admin utama? (butuh akses Filament)
- [ ] Domain apa yang akan digunakan? (smkalhidayah.sch.id? .sch.id domain untuk sekolah)
- [ ] Apakah perlu multi-bahasa (Indonesia + Inggris)?
- [ ] Format dokumen yang diupload untuk PPDB: PDF/JPG? Max ukuran?
- [ ] Butuh fitur cetak bukti pendaftaran?
