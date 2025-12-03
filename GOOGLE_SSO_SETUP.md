# Google SSO (Single Sign-On) Setup Guide

Panduan lengkap untuk mengintegrasikan Google Sign-In ke aplikasi Laravel.

## 1. Prerequisite

- Laravel Socialite (`laravel/socialite`) sudah terinstall ✅
- Database sudah siap
- Aplikasi dapat diakses melalui internet (penting untuk OAuth callback)

## 2. Setup di Google Cloud Console

### Langkah 1: Buat Proyek Google Cloud

1. Buka [Google Cloud Console](https://console.cloud.google.com/)
2. Buat proyek baru dengan nama "desa-bibi" atau sesuai nama aplikasi
3. Tunggu proyek selesai dibuat

### Langkah 2: Enable OAuth 2.0 API

1. Di Google Cloud Console, cari **"OAuth consent screen"** di menu pencarian
2. Pilih **"External"** untuk tipe user (External = menerima akses dari siapapun)
3. Isi form **OAuth Consent Screen**:
   - **App Name**: `DESA BIBI` atau nama aplikasi Anda
   - **User Support Email**: `habibifardan9@gmail.com`
   - **Developer Contact**: `habibifardan9@gmail.com`
4. Klik **"Save and Continue"**

### Langkah 3: Buat OAuth 2.0 Credentials

1. Di menu sidebar, pilih **"Credentials"**
2. Klik **"Create Credentials"** → **"OAuth 2.0 Client ID"**
3. Jika diminta, setup OAuth Consent Screen terlebih dahulu (lihat langkah 2)
4. Pilih **"Web application"** sebagai Application Type
5. Isi form:
   - **Name**: `DESA BIBI OAuth2`
   - **Authorized JavaScript origins**: 
     - `http://127.0.0.1:8000` (local development)
     - `http://localhost:8000` (alternative local)
     - `https://restful-saltless-zariah.ngrok-free.dev` (ngrok tunnel jika pakai)
   - **Authorized redirect URIs**:
     - `http://127.0.0.1:8000/auth/google/callback`
     - `http://localhost:8000/auth/google/callback`
     - `https://restful-saltless-zariah.ngrok-free.dev/auth/google/callback` (ngrok)
     - **Production**: `https://yourdomain.com/auth/google/callback`

6. Klik **"Create"**
7. Copy **Client ID** dan **Client Secret** (important!)

## 3. Setup Environment Variables

1. Buka file `.env` di root aplikasi
2. Tambahkan/update konfigurasi Google:

```dotenv
# Google OAuth
GOOGLE_CLIENT_ID=YOUR_GOOGLE_CLIENT_ID_HERE
GOOGLE_CLIENT_SECRET=YOUR_GOOGLE_CLIENT_SECRET_HERE
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

Ganti nilai `YOUR_GOOGLE_CLIENT_ID_HERE` dan `YOUR_GOOGLE_CLIENT_SECRET_HERE` dengan credentials dari Google Cloud Console.

## 4. Verifikasi Konfigurasi

Konfigurasi Google SSO sudah ada di `config/services.php`:

```php
'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],
```

AuthController sudah memiliki method `redirect()` dan `callback()` untuk handle SSO.

## 5. Testing Lokal

### Opsi A: Development Lokal (127.0.0.1:8000)

1. Jalankan server Laravel:
```bash
php artisan serve
```

2. Akses login page: `http://127.0.0.1:8000/login`

3. Klik tombol "Google" untuk test

### Opsi B: Dengan ngrok (untuk testing dari device lain/mobile)

1. Install ngrok: https://ngrok.com/download
2. Jalankan ngrok:
```bash
ngrok http 8000
```

3. Copy URL ngrok yang muncul (misal: `https://xxx.ngrok-free.dev`)

4. Update `.env`:
```dotenv
APP_URL=https://xxx.ngrok-free.dev
GOOGLE_REDIRECT_URI=https://xxx.ngrok-free.dev/auth/google/callback
```

5. Update authorized URIs di Google Cloud Console dengan URL ngrok

6. Akses via ngrok URL dan test login Google

## 6. Production Deployment

Untuk production, update `.env` dengan domain production Anda:

```dotenv
APP_URL=https://yourdomain.com
GOOGLE_CLIENT_ID=YOUR_PRODUCTION_CLIENT_ID
GOOGLE_CLIENT_SECRET=YOUR_PRODUCTION_CLIENT_SECRET
GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback
```

Jangan lupa update **Authorized JavaScript origins** dan **Authorized redirect URIs** di Google Cloud Console.

## 7. User Model & Database

Kolom untuk menyimpan social login data sudah ada di table `users`:

- `provider` → nama provider (e.g., "google")
- `provider_id` → ID dari provider (e.g., Google User ID)
- `avatar` → URL avatar dari Google profile
- `email` → email dari Google

Method `callback()` di AuthController otomatis membuat/update user berdasarkan data dari Google.

## 8. Flow Penggunaan

```
User klik "Google Sign-In"
↓
→ Route: GET /auth/google (AuthController::redirect)
  Redirect ke Google login page
↓
User login dengan akun Google
↓
Google redirect ke callback URL dengan authorization code
↓
→ Route: GET /auth/google/callback (AuthController::callback)
  Exchange code dengan access token
  Fetch user data dari Google
  Create/Update user di database
  Authenticate user
  Redirect ke /dashboard
```

## 9. Troubleshooting

### Masalah: "Redirect URI mismatch"
- **Solusi**: Pastikan `GOOGLE_REDIRECT_URI` di `.env` cocok dengan "Authorized redirect URIs" di Google Cloud Console

### Masalah: "Client ID or secret invalid"
- **Solusi**: Pastikan Client ID dan Secret di `.env` sesuai dengan yang di Google Cloud Console

### Masalah: HTTPS requirement (di production)
- **Solusi**: Google OAuth hanya bekerja dengan HTTPS di production. Setup SSL certificate di server.

### Masalah: "Localhost localhost:8000" tidak ditemukan
- **Solusi**: Sudah ditangani di AuthController::callback() dengan auto-redirect dari `localhost` ke `127.0.0.1`

## 10. Additional Features

### Menampilkan Google Avatar sebagai User Avatar
Sudah dilakukan otomatis di `AuthController::callback()`:
```php
'avatar' => $socialUser->getAvatar(),
```

### Linking Social Account ke Existing User
Saat ini implementation memungkinkan multiple akun dengan email sama (updateOrCreate).
Untuk advanced linking (1 user bisa login dengan multiple providers), modify logic di `callback()`.

### Logout & Account Linking
- Logout: Route `POST /logout` (normal logout juga berlaku untuk SSO)
- Account linking: Perlu tambahan logic di profile/settings page

## 11. Admin Panel Integration

Untuk admin juga bisa menggunakan Google SSO, user dengan role 'admin' otomatis bisa login via Google asalkan provider & provider_id tersimpan.

## Reference Links

- [Laravel Socialite Docs](https://laravel.com/docs/12.x/socialite)
- [Google OAuth 2.0 Docs](https://developers.google.com/identity/protocols/oauth2)
- [Google Cloud Console](https://console.cloud.google.com/)
