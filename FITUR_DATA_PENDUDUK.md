# Panduan Fitur Data Penduduk

## 📋 Daftar Isi
1. [Akses Fitur](#akses-fitur)
2. [Daftar Penduduk (Index)](#daftar-penduduk-index)
3. [Tambah Penduduk Baru](#tambah-penduduk-baru)
4. [Edit Data Penduduk](#edit-data-penduduk)
5. [Lihat Detail Penduduk](#lihat-detail-penduduk)
6. [Hapus Penduduk](#hapus-penduduk)
7. [Export ke CSV](#export-ke-csv)

---

## 🚀 Akses Fitur

### Dari Sidebar
1. Login sebagai admin
2. Lihat sidebar di sebelah kiri
3. Klik menu **"Data Penduduk"** dengan ikon 👥 (users-group)
4. Anda akan diarahkan ke halaman daftar penduduk

### URL Langsung
- Akses: `http://localhost/admin/data-penduduk`
- Hanya admin yang dapat mengakses fitur ini

---

## 📊 Daftar Penduduk (Index)

### Tampilan Utama
Halaman menampilkan:
- **3 Kartu Statistik**:
  - Total Penduduk: Jumlah semua penduduk terdaftar
  - Terverifikasi: Penduduk yang sudah diverifikasi
  - Belum Terverifikasi: Penduduk yang belum diverifikasi

- **Tabel Data Penduduk** dengan kolom:
  - No: Nomor urut
  - Nama: Nama lengkap penduduk
  - Email: Alamat email penduduk
  - Status Verifikasi: Terverifikasi / Belum Terverifikasi
  - Tanggal Pendaftaran: Kapan penduduk terdaftar
  - Aksi: Menu untuk Edit, Lihat Detail, atau Hapus

### Fitur Pencarian
**Cari Penduduk**:
- Masukkan nama atau email di kolom pencarian
- Sistem akan mencari secara real-time
- Klik tombol "Cari" untuk memperbarui hasil

### Fitur Filter
**Filter Berdasarkan Status**:
- **Semua Status**: Tampilkan semua penduduk
- **Terverifikasi**: Hanya penduduk yang sudah diverifikasi
- **Belum Terverifikasi**: Hanya penduduk yang belum diverifikasi

### Fitur Pengurutan
**Urutkan Data**:
- **Terbaru**: Penduduk yang baru terdaftar muncul di atas
- **Tertua**: Penduduk yang lama terdaftar muncul di atas
- **Nama A-Z**: Urutan alfabetis A sampai Z
- **Nama Z-A**: Urutan alfabetis Z sampai A

### Pagination
- Setiap halaman menampilkan 15 data penduduk
- Gunakan tombol navigasi di bawah untuk pindah halaman
- Nomor urut otomatis menyesuaikan untuk setiap halaman

---

## ➕ Tambah Penduduk Baru

### Cara Akses
1. Klik tombol **"Tambah Penduduk"** (warna biru) di bagian atas kanan
2. Anda akan dibuka form pendaftaran penduduk baru

### Form Pengisian
**Kolom yang Wajib Diisi** (ditandai *):

1. **Nama Lengkap** *(required)*
   - Masukkan nama lengkap penduduk
   - Contoh: "Ahmad Suryanto"
   - Maksimal 255 karakter

2. **Email** *(required)*
   - Masukkan email unik (belum pernah terdaftar)
   - Contoh: "ahmad.suryanto@email.com"
   - Format email harus valid
   - Setiap email hanya bisa digunakan 1 kali

3. **Password** *(required)*
   - Masukkan kata sandi minimal 8 karakter
   - Contoh: "P@ssw0rd123"
   - Gunakan kombinasi huruf besar, kecil, dan angka

4. **Tandai sebagai Terverifikasi** *(opsional)*
   - Centang checkbox jika ingin langsung mengaktifkan akses
   - Jika tidak dicentang, penduduk perlu verifikasi manual kemudian

### Tombol Aksi
- **Simpan Penduduk**: Menyimpan data dan kembali ke daftar
- **Batal**: Membatalkan dan kembali ke daftar tanpa menyimpan

### Validasi
- Jika ada kesalahan, pesan error akan muncul di atas form
- Perbaiki data sesuai pesan error
- Klik "Simpan Penduduk" lagi

---

## ✏️ Edit Data Penduduk

### Cara Akses
1. Di tabel daftar penduduk, klik menu titik tiga (⋮) di kolom Aksi
2. Pilih **"Edit"**
3. Atau klik **"Edit Data"** dari halaman detail penduduk

### Form Perubahan
**Field yang dapat diubah**:

1. **Nama Lengkap**
   - Ubah nama sesuai kebutuhan
   - Tidak boleh kosong

2. **Email**
   - Email dapat diubah dengan persyaratan:
     - Format harus valid
     - Email baru tidak boleh sudah terdaftar
     - Penduduk harus gunakan email baru untuk login

3. **Status Verifikasi**
   - Gunakan toggle switch untuk mengaktifkan/menonaktifkan
   - Aktif (hijau): Penduduk dapat login
   - Nonaktif (kuning): Penduduk tidak dapat login

### Info Tambahan di Sidebar
- Avatar/Foto profil penduduk
- Nama, Email, Status aktual
- Tombol "Lihat Detail" untuk melihat profil lengkap
- Tombol "Kembali ke Daftar" untuk kembali

### Simpan Perubahan
- Klik **"Simpan Perubahan"** untuk menyimpan
- Klik **"Batal"** untuk membatalkan perubahan

---

## 👁️ Lihat Detail Penduduk

### Cara Akses
1. Di tabel daftar penduduk, klik menu titik tiga (⋮) → **"Lihat Detail"**
2. Atau klik nama penduduk langsung

### Informasi yang Ditampilkan

**Bagian Utama**:
- Avatar/Foto profil
- Nama lengkap
- Email (dapat diklik untuk kirim email)
- Status verifikasi (Terverifikasi/Belum Terverifikasi)
- Tanggal pendaftaran
- Tanggal terakhir diperbarui
- ID pengguna sistem
- Metode pendaftaran (Manual/Google/dll)

**Bagian Sidebar**:
- **Statistik**:
  - Durasi terdaftar (berapa hari)
  - Status verifikasi (Aktif/Tertunda)
  - Tipe pendaftar
  
- **Aksi Cepat**:
  - Edit Data: Mengubah informasi penduduk
  - Kembali: Kembali ke daftar
  - Hapus Penduduk: Menghapus akun penduduk

---

## 🗑️ Hapus Penduduk

### Cara Akses
1. Di tabel daftar penduduk, klik menu titik tiga (⋮) → **"Hapus"**
2. Atau dari halaman detail penduduk, klik tombol **"Hapus Penduduk"**

### Konfirmasi Penghapusan
- Akan muncul dialog konfirmasi: "Yakin ingin menghapus?"
- Klik **"OK"** untuk melanjutkan penghapusan
- Klik **"Batal"** untuk membatalkan

### ⚠️ Peringatan
- **Penghapusan tidak dapat dibatalkan**
- Data penduduk akan dihapus permanen dari database
- Semua pengajuan dan pengaduan terkait penduduk akan tetap tersimpan

---

## 📥 Export ke CSV

### Cara Akses
1. Di halaman daftar penduduk, klik tombol **"Export CSV"** (warna hijau)
2. File CSV akan otomatis diunduh ke komputer Anda

### Format File
**Nama File**: `data-penduduk.csv`

**Kolom dalam File**:
1. Nama - Nama lengkap penduduk
2. Email - Alamat email penduduk
3. Status Verifikasi - Terverifikasi / Belum Terverifikasi
4. Tanggal Pendaftaran - Format: dd-mm-yyyy

### Contoh Isi CSV
```
Nama,Email,Status Verifikasi,Tanggal Pendaftaran
Ahmad Suryanto,ahmad@example.com,Terverifikasi,15-01-2025
Siti Nurhaliza,siti@example.com,Belum Terverifikasi,14-01-2025
```

### Penggunaan
- Buka file dengan Excel, Google Sheets, atau text editor
- Gunakan untuk laporan, backup, atau import ke sistem lain
- Perbarui data export berkala untuk backup terbaru

---

## 🔐 Keamanan & Kontrol Akses

### Siapa yang Bisa Akses?
- **Hanya Admin** yang dapat mengakses fitur Data Penduduk
- Penduduk biasa tidak bisa melihat atau mengelola data penduduk lain

### Validasi Keamanan
- Email unik: Tidak ada 2 penduduk dengan email sama
- Password aman: Minimal 8 karakter, ter-hash di database
- Konfirmasi penghapusan: Mencegah penghapusan tidak sengaja
- Verifikasi: Admin mengontrol akses penduduk ke sistem

---

## 💡 Tips & Trik

### 1. Verifikasi Penduduk
- **Baru Daftar**: Penduduk otomatis masuk tapi belum terverifikasi
- **Edit Status**: Admin cek email valid, lalu verifikasi
- **Login**: Penduduk hanya bisa login setelah terverifikasi

### 2. Pencarian Cepat
- Ketik nama atau email untuk langsung mencari
- Gunakan filter untuk melihat hanya terverifikasi/belum
- Kombinasikan dengan sort untuk hasil terbaik

### 3. Backup Data
- Export CSV secara berkala (mingguan/bulanan)
- Simpan file CSV untuk referensi dan backup
- Gunakan untuk audit trail atau analisis

### 4. Manajemen Efisien
- Verifikasi penduduk segera setelah daftar
- Hapus akun duplikat atau tidak valid
- Monitor pertumbuhan dengan kartu statistik

---

## ❓ Pertanyaan Umum (FAQ)

**Q: Bisakah penduduk mengubah email mereka sendiri?**
A: Tidak, hanya admin yang bisa mengubah email melalui fitur ini. Penduduk dapat mengubah profil di menu "Profil Saya" tapi terbatas.

**Q: Bagaimana jika lupa password?**
A: Penduduk bisa gunakan "Lupa Password" di halaman login. Admin juga bisa reset password dari halaman detail.

**Q: Bisa hapus multiple penduduk sekaligus?**
A: Saat ini hanya bisa satu per satu. Fitur bulk delete akan ditambahkan di versi berikutnya.

**Q: Data diekspor ke CSV, aman?**
A: Ya, CSV hanya berisi info dasar (nama, email, status). Password tidak pernah diekspor.

**Q: Penduduk sudah terverifikasi, bisa diubah jadi belum?**
A: Ya, buka halaman Edit dan toggle switch untuk mengubah status verifikasi kapan saja.

---

## 📞 Dukungan
Jika ada masalah atau pertanyaan tentang fitur Data Penduduk:
1. Hubungi administrator sistem
2. Cek menu "Bantuan" di sidebar
3. Kunjungi halaman dukungan di menu pengaturan

---

**Versi Dokumentasi**: 1.0
**Tanggal**: Januari 2025
**Sistem**: Desa Wonoayu v1.0
