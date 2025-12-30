# Super Admin Setup Guide

## Konfigurasi Super Admin

Super Admin di Klik Farmasi dikelola melalui environment variables untuk keamanan maksimal.

### 1. Konfigurasi .env

Tambahkan konfigurasi berikut di file `.env`:

```env
# Super Admin Configuration
SUPER_ADMIN_NAME="Super Administrator"
SUPER_ADMIN_EMAIL="superadmin@klikfarmasi.com"
SUPER_ADMIN_PASSWORD="KlikFarmasi2024!"
```

### 2. Setup Super Admin

Jalankan command berikut untuk membuat/update akun super admin:

```bash
php artisan superadmin:setup
```

### 3. Migrasi Database

Jalankan migrasi untuk memastikan role super_admin tersedia:

```bash
php artisan migrate
```

## Keamanan

- **Jangan commit** file `.env` ke repository
- **Gunakan password yang kuat** untuk production
- **Ganti email dan password default** sebelum production
- **Backup** konfigurasi .env dengan aman

## Akses Super Admin

Super Admin memiliki akses penuh untuk:
- Mengelola admin
- Mengelola pasien
- Mengakses semua fitur sistem

URL akses: `/superadmin/dashboard`

## Troubleshooting

### Super Admin tidak bisa login
1. Pastikan konfigurasi di `.env` benar
2. Jalankan `php artisan superadmin:setup` lagi
3. Periksa apakah migrasi sudah dijalankan

### Role tidak dikenali
1. Jalankan `php artisan migrate`
2. Pastikan middleware terdaftar di `bootstrap/app.php`