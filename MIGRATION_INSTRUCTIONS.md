# INSTRUKSI MIGRATION - PRIORITAS TINGGI

## ✅ PERUBAHAN YANG TELAH DIBUAT:

### 1. Migration Files:
- `2024_12_19_000001_rename_puskesmas_id_to_puskesmas_in_users_table.php`
- `2024_12_19_000002_rename_detail_obat_pengingat_table.php`

### 2. Model Updates:
- `User.php` - Update fillable array: `puskesmas_id` → `puskesmas`
- `DetailObatPengingat.php` - Update table name: `detail_obat_pengingat` → `detail_obat`

### 3. View Updates:
- `detail.blade.php` - Update semua referensi `puskesmas_id` → `puskesmas`

## 🚀 CARA MENJALANKAN:

### 1. Backup Database (WAJIB):
```bash
mysqldump -u username -p database_name > backup_before_migration.sql
```

### 2. Jalankan Migration:
```bash
php artisan migrate
```

### 3. Verifikasi:
- Cek tabel `users` kolom `puskesmas` (bukan `puskesmas_id`)
- Cek tabel `detail_obat` (bukan `detail_obat_pengingat`)
- Test halaman admin/pasien/detail

## ⚠️ ROLLBACK (Jika Ada Masalah):
```bash
php artisan migrate:rollback --step=2
```

## 📋 CHECKLIST SETELAH MIGRATION:
- [ ] Kolom `users.puskesmas` ada dan berisi data
- [ ] Tabel `detail_obat` ada dan berisi data
- [ ] Halaman detail pasien berfungsi normal
- [ ] Form edit pasien berfungsi normal
- [ ] Tidak ada error di log

## 🔍 FILES YANG PERLU DICEK MANUAL:
Cari file lain yang mungkin menggunakan:
- `puskesmas_id` 
- `detail_obat_pengingat`

Dan update sesuai nama baru.