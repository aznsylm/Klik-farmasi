@extends('layouts.medicio')
@section('title', 'Petunjuk Penggunaan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Petunjuk lengkap penggunaan platform Klik Farmasi untuk manajemen hipertensi, pengingat obat, dan akses informasi kesehatan.">
    <meta name="keywords" content="petunjuk, panduan, cara penggunaan, klik farmasi, hipertensi, pengingat obat, tutorial">
    <meta name="author" content="Klik Farmasi - Universitas Alma Ata">
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Petunjuk Penggunaan</h1>
                        <p class="mb-0">Panduan lengkap untuk menggunakan platform Klik Farmasi dalam mengelola hipertensi
                            Anda dengan mudah dan efektif</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Petunjuk</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Tabs Section -->
    <section id="tabs" class="tabs section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" href="#tabs-tab-1">1. Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-2">2. Artikel Kesehatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-3">3. Tanya Jawab (FAQ)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-4">4. Unduhan Poster</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-5">5. Konsultasi Langsung</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-6">6. Mendaftar Akun Pasien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-7">7. Pengingat Minum Obat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-8">8. Dashboard Pasien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-9">9. Monitoring Tekanan Darah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-10">10. Setting Notifikasi WhatsApp</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9 mt-4 mt-lg-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabs-tab-1">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Beranda - Halaman Utama Platform</h3>
                                    <p class="fst-italic">Halaman awal yang berisi informasi lengkap tentang layanan
                                        kesehatan Klik Farmasi.</p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li>Buka <a href="{{ route('beranda') }}" class="text-primary">halaman beranda</a>
                                        </li>
                                        <li><strong>Hero Section:</strong> 3 slide informasi utama (pengingat obat, artikel
                                            kesehatan, konsultasi gratis)</li>
                                        <li><strong>Layanan Unggulan:</strong> 3 fitur utama - Pengingat Obat, Artikel
                                            Kesehatan, Konsultasi Ahli</li>
                                        <li><strong>Tentang Klik Farmasi:</strong> Penjelasan platform kesehatan digital
                                            untuk hipertensi</li>
                                        <li><strong>Statistik:</strong> Data pengguna, artikel, konsultasi, dan unduhan</li>
                                        <li><strong>Artikel Terbaru:</strong> 3 artikel kesehatan terkini</li>
                                        <li><strong>FAQ:</strong> 5 pertanyaan yang sering ditanyakan</li>
                                        <li><strong>Kontak:</strong> Info tim dan cara hubungi admin</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Catatan:</strong> Semua konten beranda bisa diakses tanpa login atau
                                        registrasi.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-2">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Artikel Kesehatan - Informasi Terpercaya</h3>
                                    <p class="fst-italic">Kumpulan artikel kesehatan dari ahli farmasi tentang hipertensi
                                        dan manajemen kesehatan.</p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li>Pilih kategori artikel dari menu utama:</li>
                                        <li><strong><a href="{{ route('artikel.non-kehamilan') }}"
                                                    class="text-primary">Hipertensi Non Kehamilan</a>:</strong> Artikel
                                            untuk masyarakat umum</li>
                                        <li><strong><a href="{{ route('artikel.kehamilan') }}"
                                                    class="text-primary">Hipertensi Kehamilan</a>:</strong> Khusus untuk ibu
                                            hamil dengan hipertensi</li>
                                        <li>Klik "Baca Selengkapnya" untuk membaca artikel lengkap</li>
                                        <li>Artikel detail dilengkapi dengan fitur berbagi ke media sosial</li>
                                        <li>Tersedia artikel terkait di sidebar untuk referensi tambahan</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Gratis:</strong> Semua artikel dapat diakses tanpa registrasi atau login.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-3">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Tanya Jawab - Pertanyaan Umum</h3>
                                    <p class="fst-italic">Kumpulan pertanyaan dan jawaban seputar hipertensi yang dijawab
                                        oleh ahli farmasi.</p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li>Pilih kategori sesuai kebutuhan:</li>
                                        <li><strong><a href="{{ route('tanya-jawab.non-kehamilan') }}"
                                                    class="text-primary">Hipertensi Umum</a>:</strong> Tanya jawab untuk
                                            masyarakat umum</li>
                                        <li><strong><a href="{{ route('tanya-jawab.kehamilan') }}"
                                                    class="text-primary">Hipertensi Kehamilan</a>:</strong> Khusus untuk ibu
                                            hamil dengan hipertensi</li>
                                        <li>Klik pertanyaan untuk membuka jawaban (format accordion)</li>
                                        <li>Bagian bawah ada kontak langsung ke ahli farmasi</li>
                                        <li>Link media sosial untuk informasi lebih lanjut</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Gratis:</strong> Semua Tanya Jawab dapat diakses tanpa registrasi. Jika
                                        tidak menemukan jawaban, konsultasi langsung via WhatsApp.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-4">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Unduhan Materi - Download Gratis</h3>
                                    <p class="fst-italic">Koleksi poster edukasi dan materi kesehatan yang dapat diunduh
                                        gratis.</p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li>Buka <a href="{{ route('unduhan') }}" class="text-primary">halaman unduhan</a>
                                        </li>
                                        <li><strong>Layout Services Card:</strong>
                                            <ul class="ms-3 mt-2">
                                                <li>Grid layout dengan card untuk setiap materi</li>
                                                <li>Thumbnail preview gambar materi</li>
                                                <li>Judul dan deskripsi singkat</li>
                                                <li>Tombol "Download" biru</li>
                                            </ul>
                                        </li>
                                        <li>Hover pada card untuk efek zoom thumbnail</li>
                                        <li>Klik tombol "Download" pada materi yang diinginkan</li>
                                        <li>File akan otomatis ter-download ke perangkat Anda</li>
                                        <li><strong>Pagination:</strong> Jika materi banyak, gunakan navigasi halaman di
                                            bawah</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Gratis Semua:</strong> Tidak perlu registrasi atau login untuk mengunduh
                                        materi edukasi kesehatan.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-5">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Konsultasi Langsung - Chat dengan Ahli</h3>
                                    <p class="fst-italic">Layanan konsultasi gratis dengan tim farmasi melalui WhatsApp.
                                    </p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li><strong>Via Topbar Website:</strong> Klik "Konsultasi Via WhatsApp" di bagian
                                            atas halaman</li>
                                        <li><strong>Via Dashboard Pasien:</strong> Login ke akun pasien, pilih menu
                                            "Konsultasi"</li>
                                        <li><strong>Tim yang Tersedia:</strong>
                                            <ul class="ms-3 mt-2">
                                                <li>apt. Nurul Kusumawardani, M. Farm (Pakar Kesehatan) - <a
                                                        href="https://wa.me/6281292936247" class="text-success"
                                                        target="_blank">0812-9293-6247</a></li>
                                                <li>Abdi Sugeng (Admin Klik Farmasi) - <a
                                                        href="https://wa.me/6285741983749" class="text-success"
                                                        target="_blank">0857-4198-3749</a></li>
                                                <li>Adinda Putri (Admin Klik Farmasi) - <a
                                                        href="https://wa.me/6281904374399" class="text-success"
                                                        target="_blank">0819-0437-4399</a></li>
                                                <li>Enzelika (Admin Klik Farmasi) - <a href="https://wa.me/628170557080"
                                                        class="text-success" target="_blank">0817-0557-080</a></li>
                                                <li>Febby Trianingsih (Admin Klik Farmasi) - <a
                                                        href="https://wa.me/6285729292624" class="text-success"
                                                        target="_blank">0857-2929-2624</a></li>
                                            </ul>
                                        </li>
                                        <li>Klik nomor telepon admin yang ingin dihubungi</li>
                                        <li>Akan terbuka WhatsApp dengan template pesan</li>
                                        <li>Ketik pertanyaan Anda dan kirim</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Gratis 24/7:</strong> Konsultasi tidak dipungut biaya, tersedia setiap hari.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-6">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Daftar Akun Pasien - Registrasi</h3>
                                    <p class="fst-italic">Akun pasien diperlukan untuk mengakses fitur pengingat obat dan
                                        monitoring kesehatan.</p>
                                    <h6 class="fw-bold mb-3">Cara Mendaftar:</h6>
                                    <ol>
                                        <li>Klik tombol "Akun" di menu utama, pilih "Register"</li>
                                        <li><strong>Isi Form Registrasi:</strong>
                                            <ul class="ms-3 mt-2">
                                                <li>Nama Lengkap (wajib)</li>
                                                <li>Email (wajib, akan divalidasi)</li>
                                                <li>Nomor Telepon (format: +62812xxxxx, akan divalidasi)</li>
                                                <li>Umur (wajib)</li>
                                                <li>Jenis Kelamin (pilihan dropdown)</li>
                                                <li>Alamat Lengkap (wajib)</li>
                                                <li>Password dan konfirmasi password</li>
                                                <li>Kode Pendaftaran (wajib, dari admin)</li>
                                            </ul>
                                        </li>
                                        <li>Centang checkbox "Syarat & Ketentuan"</li>
                                        <li>Klik "Daftar Sekarang"</li>
                                        <li><strong>Modal Sukses:</strong> Akan muncul konfirmasi berhasil daftar</li>
                                        <li>Otomatis diarahkan ke halaman login</li>
                                        <li>Login dengan email dan password yang sudah didaftarkan</li>
                                    </ol>
                                    <div class="alert alert-warning mt-3">
                                        <strong>Penting:</strong> Kode pendaftaran hanya bisa digunakan 1 kali. Hubungi
                                        admin jika belum punya kode.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-7">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Pengingat Minum Obat - Setting Notifikasi</h3>
                                    <p class="fst-italic">Fitur utama untuk membuat jadwal pengingat obat dengan notifikasi
                                        WhatsApp.</p>
                                    <h6 class="fw-bold mb-3">Cara Setting Pengingat:</h6>
                                    <ol>
                                        <li>Login ke akun pasien, klik menu "Pengingat"</li>
                                        <li><strong>Data Tekanan Darah (Card Kiri):</strong>
                                            <ul class="ms-3 mt-2">
                                                <li>Input Sistol (50-250 mmHg)</li>
                                                <li>Input Diastol (50-150 mmHg)</li>
                                                <li>Pilih tanggal mulai pengingat</li>
                                            </ul>
                                        </li>
                                        <li><strong>Daftar Obat (Card Kanan):</strong>
                                            <ul class="ms-3 mt-2">
                                                <li>Klik "Tambah Obat Pertama"</li>
                                                <li>Pilih nama obat dari dropdown (34 pilihan)</li>
                                                <li>Tentukan waktu minum (06:00-20:00)</li>
                                                <li>Pilih dosis (0.5-3 tablet)</li>
                                                <li>Pilih kapan minum (sebelum/sesudah/bersamaan makan)</li>
                                                <li>Bisa tambah sampai maksimal 5 obat</li>
                                            </ul>
                                        </li>
                                        <li>Klik "AKTIFKAN PENGINGAT" untuk menyimpan</li>
                                        <li>Sistem akan kirim notifikasi WhatsApp sesuai jadwal</li>
                                    </ol>
                                    <div class="alert alert-warning mt-3">
                                        <strong>Wajib Login:</strong> Harus login sebagai pasien untuk mengakses fitur ini.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-8">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Dashboard Pasien - Pusat Informasi Kesehatan</h3>
                                    <p class="fst-italic">Halaman utama setelah login yang menampilkan ringkasan kesehatan
                                        dan aksi cepat.</p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li>Login dengan akun pasien Anda</li>
                                        <li><strong>Sistem Alert:</strong> Peringatan otomatis jika TD tinggi, lama tidak
                                            input, atau belum ada pengingat obat</li>
                                        <li><strong>4 Card Statistik:</strong> Total catatan TD, jumlah obat, TD terakhir,
                                            tim konsultasi</li>
                                        <li><strong>Menu Aksi Cepat:</strong> Tombol langsung ke "Catat TD", "Lihat Obat",
                                            "Konsultasi", "Unduh PDF"</li>
                                        <li>Semua data real-time dan terupdate otomatis</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Tips:</strong> Dashboard adalah pusat kendali kesehatan - semua fitur utama
                                        dapat diakses dari sini.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-9">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Monitoring Tekanan Darah - Catat & Analisis</h3>
                                    <p class="fst-italic">Fitur untuk mencatat TD harian dan melihat trend kesehatan dengan
                                        grafik.</p>
                                    <h6 class="fw-bold mb-3">Cara Menggunakan:</h6>
                                    <ol>
                                        <li>Masuk ke menu "Tekanan Darah" dari dashboard</li>
                                        <li><strong>Input Data:</strong> Isi sistol (70-250) dan diastol (40-150), klik
                                            "Simpan Data"</li>
                                        <li><strong>Grafik Visual:</strong> Line chart merah (sistol) dan biru (diastol)
                                            dengan skala 60-200 mmHg</li>
                                        <li><strong>Tabel Data:</strong> Semua catatan dengan kategori otomatis (Normal,
                                            Pre-Hipertensi, Stage 1, Stage 2)</li>
                                        <li><strong>Kelola Data:</strong> Edit data lama dengan tombol kuning, pagination
                                            untuk data banyak</li>
                                        <li><strong>Download:</strong> Klik "Unduh Laporan PDF" untuk file laporan kesehatan
                                        </li>
                                    </ol>
                                    <div class="alert alert-warning mt-3">
                                        <strong>Penting:</strong> Input data rutin untuk analisis trend yang akurat.
                                        Kategori sesuai standar medis.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-tab-10">
                            <div class="row">
                                <div class="col-lg-12 details">
                                    <h3>Kelola Pengingat Obat - Setting Status</h3>
                                    <p class="fst-italic">Halaman untuk mengatur status aktif/tidak aktif setiap obat dalam
                                        pengingat.</p>
                                    <h6 class="fw-bold mb-3">Cara Mengelola:</h6>
                                    <ol>
                                        <li>Masuk ke menu "Daftar Obat" dari dashboard</li>
                                        <li><strong>Card Info Biru:</strong> Status pengingat keseluruhan, tanggal mulai,
                                            catatan admin</li>
                                        <li><strong>Alert System:</strong> Peringatan kuning jika semua obat tidak aktif
                                        </li>
                                        <li><strong>Card per Obat:</strong> Hijau (aktif) atau abu-abu (tidak aktif) dengan
                                            detail nama, jumlah, waktu</li>
                                        <li><strong>Tabel Ringkasan:</strong> Ubah status "Aktif/Tidak Aktif" via dropdown,
                                            otomatis tersimpan</li>
                                        <li><strong>Sistem Otomatis:</strong> Jika semua tidak aktif, pengingat mati.
                                            Aktifkan minimal 1 obat untuk reaktivasi</li>
                                    </ol>
                                    <div class="alert alert-info mt-3">
                                        <strong>Tips:</strong> Ubah ke "Tidak Aktif" jika obat habis, kembali "Aktif" jika
                                        sudah beli lagi.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Featured Services Section untuk Tips -->
        <div class="container mt-5">
            <section id="featured-services" class="featured-services section">

                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <h2>Tips & Saran</h2>
                        <p>Kiat-kiat penting untuk memaksimalkan penggunaan platform Klik Farmasi</p>
                    </div>

                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="service-item">
                                <div class="details position-relative">
                                    <h3>Konsistensi adalah Kunci</h3>
                                    <p>Gunakan pengingat obat secara rutin dan jangan lewatkan jadwal minum obat.
                                        Konsistensi dalam pengobatan sangat penting untuk mengendalikan hipertensi.</p>
                                </div>
                            </div>
                        </div><!-- End Service Item -->

                        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                            <div class="service-item">
                                <div class="details position-relative">
                                    <h3>Manfaatkan Konsultasi</h3>
                                    <p>Jangan ragu untuk berkonsultasi melalui WhatsApp jika ada pertanyaan. Tim farmasi
                                        kami siap membantu Anda 24/7.</p>
                                </div>
                            </div>
                        </div><!-- End Service Item -->

                        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                            <div class="service-item">
                                <div class="details position-relative">
                                    <h3>Simpan Materi Edukasi</h3>
                                    <p>Download dan simpan materi edukasi untuk dibaca offline. Bagikan juga dengan keluarga
                                        untuk menambah pengetahuan tentang hipertensi.</p>
                                </div>
                            </div>
                        </div><!-- End Service Item -->

                    </div>

                </div>

            </section><!-- /Featured Services Section -->

            <!-- Services Section untuk Bantuan -->
            <section id="services" class="services section">

                <div class="container">
                    <div class="section-title text-center" data-aos="fade-up">
                        <h2>Butuh Bantuan?</h2>
                        <p>Tim support kami siap membantu Anda dalam menggunakan platform Klik Farmasi</p>
                    </div>

                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="service-item position-relative">
                                <div class="icon">
                                    <i class="bi bi-whatsapp"></i>
                                </div>
                                <h3>Konsultasi WhatsApp</h3>
                                <p>Hubungi langsung tim farmasi melalui WhatsApp untuk konsultasi cepat dan mendapatkan
                                    jawaban atas pertanyaan Anda.</p>
                                <a href="https://wa.me/+6281292936247" class="readmore stretched-link"
                                    target="_blank">Chat Sekarang <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div><!-- End Service Item -->

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="service-item position-relative">
                                <div class="icon">
                                    <i class="bi bi-question-circle"></i>
                                </div>
                                <h3>Tanya Jawab Lengkap</h3>
                                <p>Cari jawaban cepat untuk pertanyaan yang sering ditanyakan seputar penggunaan platform
                                    dan informasi hipertensi.</p>
                                <a href="{{ route('tanya-jawab.non-kehamilan') }}" class="readmore stretched-link">Lihat
                                    Tanya Jawab <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div><!-- End Service Item -->

                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="service-item position-relative">
                                <div class="icon">
                                    <i class="bi bi-book"></i>
                                </div>
                                <h3>Panduan Lengkap</h3>
                                <p>Akses panduan lengkap penggunaan platform, tutorial video, dan materi edukasi untuk
                                    membantu Anda.</p>
                                <a href="{{ route('unduhan') }}" class="readmore stretched-link">Download Panduan <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>
                        </div><!-- End Service Item -->

                    </div>

                </div>

            </section><!-- /Services Section -->

        </div>

    </section><!-- /Tabs Section -->

    <!-- Call to Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Siap Mulai Mengelola Hipertensi?</h3>
                        <p>Ikuti petunjuk di atas dan mulai manfaatkan semua fitur Klik Farmasi untuk kesehatan Anda yang
                            lebih baik.</p>
                        <a class="cta-btn" href="{{ route('pengingat') }}">Mulai Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call to Action Section -->

@endsection

@push('scripts')
    <script>
        // Custom JavaScript untuk halaman petunjuk medicio jika diperlukan
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Halaman Petunjuk Medicio Template siap!');

            // Smooth scroll untuk internal links
            const links = document.querySelectorAll('a[href^="#"]');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endpush

@push('head')
    <style>
        /* Custom styling untuk halaman petunjuk */
        .section-header {
            margin-bottom: 40px;
        }

        .instruction-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .instruction-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .instruction-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .instruction-icon i {
            font-size: 3rem;
            color: #0b5e91;
        }

        .instruction-card h3 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
        }

        .instruction-content ol,
        .instruction-content ul {
            padding-left: 20px;
        }

        .instruction-content ol li,
        .instruction-content ul li {
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .tips-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 40px;
            border-left: 5px solid #0b5e91;
        }

        .tips-section h3 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }

        .tip-item {
            text-align: center;
            padding: 20px;
        }

        .tip-item h5 {
            color: #0b5e91;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .support-section {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .support-section h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .support-item {
            padding: 20px;
        }

        .support-item i {
            font-size: 2.5rem;
            color: #0b5e91;
            margin-bottom: 15px;
        }

        .support-item h5 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .support-item p {
            color: #666;
            margin: 0;
        }

        /* Service item hover effect for h3 color */
        .service-item:hover h3 {
            color: #0b5e91 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .instruction-card {
                padding: 20px;
            }

            .tips-section,
            .support-section {
                padding: 30px 20px;
            }

            .instruction-icon i {
                font-size: 2.5rem;
            }

            .support-item i {
                font-size: 2rem;
            }
        }
    </style>
@endpush
