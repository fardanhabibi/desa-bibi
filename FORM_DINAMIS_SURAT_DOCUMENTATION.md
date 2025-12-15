# Implementasi Form Dinamis untuk Setiap Jenis Surat

## Ringkasan Perubahan

Telah ditambahkan form dinamis untuk setiap jenis surat sehingga user dapat mengisi detail spesifik sesuai dengan tipe surat yang dipilih. Form akan ditampilkan/disembunyikan secara otomatis berdasarkan pilihan jenis surat.

## File yang Ditambahkan

### 1. Database Migrations
- **`database/migrations/2025_12_03_000000_add_jenis_surat_id_to_pengajuan_surats_table.php`**
  - Menambahkan kolom `jenis_surat_id` (foreign key) ke tabel `pengajuan_surats`
  - Relasi ke tabel `jenis_surat`

- **`database/migrations/2025_12_03_000001_add_detail_to_pengajuan_surats_table.php`**
  - Menambahkan kolom `detail` (JSON) untuk menyimpan data spesifik setiap jenis surat

### 2. Seeder
- **`database/seeders/JenisSuratSeeder.php`**
  - Mengisi tabel `jenis_surat` dengan 9 jenis surat:
    1. Surat Keterangan Domisili
    2. Surat Keterangan Usaha
    3. Surat Keterangan Tidak Mampu
    4. Surat Keterangan Kelahiran
    5. Surat Keterangan Kematian
    6. Surat Pengantar
    7. Surat Keterangan Beda Nama
    8. **Surat Keterangan Migrasi** ✓ (baru ditambahkan)
    9. Surat Keterangan Lainnya

### 3. Form Partials
Setiap form partial terletak di `resources/views/user/pengajuan/forms/`:

- **`_domisili.blade.php`**
  - Alamat Domisili
  - Lama Tinggal (tahun)

- **`_usaha.blade.php`**
  - Nama Usaha
  - Alamat Usaha

- **`_tidak_mampu.blade.php`**
  - Keterangan Kondisi Ekonomi
  - Jumlah Tanggungan

- **`_kelahiran.blade.php`**
  - Nama Bayi
  - Tanggal Lahir
  - Tempat Lahir

- **`_kematian.blade.php`**
  - Nama Almarhum / Almarhumah
  - Tanggal Meninggal
  - Sebab Kematian

- **`_pengantar.blade.php`**
  - Tujuan Pengantar
  - Keterangan Tambahan

- **`_beda_nama.blade.php`**
  - Nama Lama
  - Nama Baru
  - Alasan Perubahan Nama

- **`_migrasi.blade.php`** ✓ (BARU - sesuai request)
  - Alamat Tujuan Migrasi
  - Alasan Migrasi

- **`_lainnya.blade.php`**
  - Judul / Perihal
  - Rincian

### 4. Controller
- **`app/Http/Controllers/PengajuanSuratController.php`** (dimodifikasi)
  - Method `store()` sekarang menerima dan menyimpan array `detail` sebagai JSON
  - Detail data disimpan di kolom `detail` untuk referensi di masa depan

### 5. Model
- **`app/Models/PengajuanSurat.php`** (dimodifikasi)
  - Menambahkan `detail` ke `$fillable`
  - Menambahkan casting JSON untuk kolom `detail`
  - Relasi `jenisSurat()` dengan model `JenisSurat`

### 6. View
- **`resources/views/user/pengajuan/create.blade.php`** (dimodifikasi)
  - Menambahkan semua form partials
  - Menambahkan JavaScript untuk toggle form sections berdasarkan pilihan jenis surat
  - Setiap opsi dropdown memiliki `data-label` untuk mapping ke class CSS form section

## Cara Kerja

### Di Frontend:
1. User membuka halaman "Ajukan Surat Baru"
2. User memilih "Jenis Surat" dari dropdown
3. Form spesifik untuk jenis surat yang dipilih muncul secara otomatis
4. User mengisi detail form spesifik + form umum (Keperluan, Keterangan, Lampiran)
5. User submit form

### Di Backend:
1. Controller menerima `jenis_surat` (ID) dan array `detail`
2. Menyimpan ke database:
   - `jenis_surat_id`: ID dari tabel `jenis_surat`
   - `jenis_surat`: String nama surat (untuk backward compatibility)
   - `detail`: JSON array berisi data spesifik (alamat, nama, dll)
3. Admin dapat melihat detail data ketika mengelola pengajuan

## Database Schema

Kolom baru di tabel `pengajuan_surats`:
```sql
jenis_surat_id INT UNSIGNED NULLABLE (FK ke jenis_surat)
detail JSON NULLABLE
```

## Contoh Data yang Tersimpan

### Pengajuan Surat Domisili:
```json
{
  "jenis_surat_id": 1,
  "jenis_surat": "Surat Keterangan Domisili",
  "detail": {
    "alamat": "Jl. Merdeka No. 123",
    "lama_tinggal": "5"
  }
}
```

### Pengajuan Surat Migrasi:
```json
{
  "jenis_surat_id": 8,
  "jenis_surat": "Surat Keterangan Migrasi",
  "detail": {
    "alamat_tujuan": "Jl. Sudirman No. 456, Kota Lain",
    "alasan_migrasi": "Pekerjaan"
  }
}
```

## Langkah Instalasi (Sudah Dilakukan)

✅ Semua langkah di bawah sudah selesai dilaksanakan:

```powershell
# 1. Jalankan migration
php artisan migrate

# 2. Jalankan seeder untuk mengisi jenis_surat
php artisan db:seed --class=JenisSuratSeeder

# 3. Clear cache
php artisan view:clear
php artisan cache:clear
```

## Hasil

✅ **Fitur "Migrasi" sudah ditambahkan dan muncul di dropdown dengan form spesifik:**
- Dropdown "Jenis Surat" menampilkan 9 opsi termasuk "Surat Keterangan Migrasi"
- Form untuk Migrasi berisi:
  - Alamat Tujuan Migrasi (required)
  - Alasan Migrasi (optional)
- Data tersimpan di database dengan struktur JSON

## Verifikasi

Untuk memverifikasi fitur bekerja:
1. Buka halaman user dashboard → Pengajuan Surat → Ajukan Surat Baru
2. Dropdown "Jenis Surat" sekarang menampilkan semua jenis termasuk "Surat Keterangan Migrasi"
3. Pilih "Surat Keterangan Migrasi" → form spesifik akan muncul dengan field Alamat Tujuan dan Alasan Migrasi
4. Isi form dan submit → data akan tersimpan dengan baik

## Catatan untuk Admin

Admin dapat melihat detail data yang disimpan di halaman admin untuk setiap pengajuan. Detail tersimpan dalam format JSON dan dapat diekstrak untuk berbagai kebutuhan seperti:
- Laporan
- Template surat yang dapat disesuaikan
- Analytics

## File Berubah/Ditambah:

**Migrations (2 file baru):**
- 2025_12_03_000000_add_jenis_surat_id_to_pengajuan_surats_table.php
- 2025_12_03_000001_add_detail_to_pengajuan_surats_table.php

**Seeders (1 file baru):**
- database/seeders/JenisSuratSeeder.php

**Form Partials (9 file baru):**
- resources/views/user/pengajuan/forms/_domisili.blade.php
- resources/views/user/pengajuan/forms/_usaha.blade.php
- resources/views/user/pengajuan/forms/_tidak_mampu.blade.php
- resources/views/user/pengajuan/forms/_kelahiran.blade.php
- resources/views/user/pengajuan/forms/_kematian.blade.php
- resources/views/user/pengajuan/forms/_pengantar.blade.php
- resources/views/user/pengajuan/forms/_beda_nama.blade.php
- resources/views/user/pengajuan/forms/_migrasi.blade.php
- resources/views/user/pengajuan/forms/_lainnya.blade.php

**Files Dimodifikasi (3 file):**
- app/Http/Controllers/PengajuanSuratController.php
- app/Models/PengajuanSurat.php
- resources/views/user/pengajuan/create.blade.php

**Plus file pendukung yang sudah dibuat sebelumnya:**
- app/Models/JenisSurat.php
- resources/views/user/pengajuan/index.blade.php
