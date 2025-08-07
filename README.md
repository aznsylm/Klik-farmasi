<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1 align="center">Klik Farmasi</h1>
<p align="center">Platform Kesehatan Digital untuk Manajemen Hipertensi</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Tentang Klik Farmasi

**Klik Farmasi** adalah platform kesehatan digital yang dirancang khusus untuk manajemen hipertensi. Aplikasi ini menyediakan solusi komprehensif untuk penderita hipertensi dalam mengelola kesehatan mereka.

### Fitur Utama

#### 1. Pengingat Minum Obat
- Sistem pengingat untuk penderita hipertensi
- Mendukung 2 kategori: Hipertensi Kehamilan & Non-Kehamilan
- Tracking tekanan darah dan jadwal obat
- Status monitoring (aktif/tidak aktif/selesai)

#### 2. Sistem Informasi Kesehatan
- Artikel kesehatan terpercaya tentang hipertensi
- Berita kesehatan terkini
- FAQ (Tanya Jawab) untuk hipertensi kehamilan dan non-kehamilan
- Download center untuk materi edukasi

#### 3. Multi-Role Management
- **Super Admin**: Kelola admin dan pasien
- **Admin**: Kelola konten (artikel, berita, FAQ, unduhan, testimoni) dan data pasien
- **Pasien**: Akses pengingat obat dan dashboard personal

#### 4. Fitur Pendukung
- Sistem autentikasi (login/register)
- Profile management
- Tim pengelola
- Testimoni
- Petunjuk penggunaan

### Target Pengguna
- Penderita hipertensi (kehamilan & non-kehamilan)
- Tenaga kesehatan/admin
- Masyarakat umum yang membutuhkan informasi kesehatan

## Database Schema (ERD)

### Entitas dan Atribut

**USERS**
- id (PK)
- name, email (unique), password
- role (default: 'pasien')
- email_verified_at, remember_token
- timestamps

**PENGINGAT_OBAT**
- id (PK)
- user_id (FK → users.id)
- diagnosa (enum: 'Hipertensi-Non-Kehamilan', 'Hipertensi-Kehamilan')
- tekanan_darah, status, tanggal_mulai, catatan
- timestamps

**DETAIL_OBAT_PENGINGAT**
- id (PK)
- pengingat_obat_id (FK → pengingat_obat.id)
- nama_obat, jumlah_obat, waktu_minum
- suplemen, urutan, status_obat
- timestamps

**ARTICLES**
- id (PK)
- title, slug (unique), category, article_type
- content, author, published_at, image
- timestamps

**NEWS**
- id (PK)
- title, source, link, published_at
- timestamps

**FAQS**
- id (PK)
- category, question, answer
- timestamps

**DOWNLOADS**
- id (PK)
- title, description, image, file_link
- timestamps

**TESTIMONIALS**
- id (PK)
- quote, name
- timestamps

### Relasi Database
1. **USERS → PENGINGAT_OBAT** (One-to-Many)
2. **PENGINGAT_OBAT → DETAIL_OBAT_PENGINGAT** (One-to-Many)
