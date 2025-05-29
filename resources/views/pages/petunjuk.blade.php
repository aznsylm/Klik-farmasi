@extends('layouts.app')

@section('title', 'Petunjuk Penggunaan')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Petunjuk Penggunaan Website</h2>
        <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Panduan lengkap untuk menggunakan semua fitur website dengan mudah</p>
        <div class="d-flex justify-content-center mt-3">
            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;"></div>
        </div>
    </div>

    <!-- Navigation Guide -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">1</span>
                        </div>
                        <h4 class="mb-0 text-primary">Navigasi Website</h4>
                    </div>
                    <p class="text-muted mb-3">Pelajari cara menavigasi website dengan mudah:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Gunakan menu utama di bagian atas untuk mengakses halaman utama</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Klik logo untuk kembali ke beranda</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Gunakan breadcrumb untuk mengetahui posisi halaman saat ini</li>
                        <li class="mb-0"><i class="bi bi-check-circle-fill text-primary me-2"></i>Footer berisi link penting dan informasi kontak</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout for Steps 2-3 -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">2</span>
                        </div>
                        <h4 class="mb-0 text-primary">Cara Mengakses Web</h4>
                    </div>
                    <p class="text-muted mb-3">Langkah-langkah mengakses website:</p>
                    <ol class="text-muted">
                        <li>Buka browser favorit Anda</li>
                        <li>Masukkan URL website di address bar</li>
                        <li>Tunggu halaman loading selesai</li>
                        <li>Website siap digunakan</li>
                    </ol>
                    <div class="alert alert-primary">
                        <small><i class="bi bi-info-circle me-1"></i>Pastikan koneksi internet stabil untuk pengalaman terbaik</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">3</span>
                        </div>
                        <h4 class="mb-0 text-primary">Cara Baca Artikel</h4>
                    </div>
                    <p class="text-muted mb-3">Nikmati membaca artikel dengan fitur:</p>
                    <ul class="text-muted">
                        <li>Klik judul artikel untuk membuka</li>
                        <li>Scroll untuk membaca konten lengkap</li>
                        <li>Gunakan tombol share untuk berbagi</li>
                        <li>Baca artikel terkait di bagian bawah</li>
                    </ul>
                    <div class="alert alert-primary">
                        <small><i class="bi bi-lightbulb me-1"></i>Bookmark artikel favorit untuk dibaca nanti</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Account Management Section -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">4</span>
                        </div>
                        <h4 class="mb-0 text-primary">Cara Registrasi</h4>
                    </div>
                    <p class="text-muted mb-3">Daftar akun baru dengan mudah:</p>
                    <ol class="text-muted">
                        <li>Klik tombol "Daftar" di halaman utama</li>
                        <li>Isi form dengan data yang valid</li>
                        <li>Verifikasi email jika diperlukan</li>
                        <li>Akun siap digunakan</li>
                    </ol>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-primary btn-sm">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">5</span>
                        </div>
                        <h4 class="mb-0 text-primary">Cara Login</h4>
                    </div>
                    <p class="text-muted mb-3">Masuk ke akun Anda:</p>
                    <ol class="text-muted">
                        <li>Klik tombol "Masuk" di header</li>
                        <li>Masukkan email dan password</li>
                        <li>Klik tombol "Login"</li>
                        <li>Selamat datang kembali!</li>
                    </ol>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-primary btn-sm">Login Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Download Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">6</span>
                        </div>
                        <h4 class="mb-0 text-primary">Cara Pengunduhan</h4>
                    </div>
                    <p class="text-muted mb-3">Download file dan dokumen dengan aman:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-download text-primary me-2"></i>Cari file yang ingin diunduh</li>
                                <li class="mb-2"><i class="bi bi-download text-primary me-2"></i>Klik tombol "Download"</li>
                                <li class="mb-0"><i class="bi bi-download text-primary me-2"></i>Tunggu proses download selesai</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-primary">
                                <h6 class="mb-2"><i class="bi bi-shield-check me-1"></i>Tips Keamanan:</h6>
                                <small>
                                    • Pastikan file dari sumber terpercaya<br>
                                    • Scan file dengan antivirus<br>
                                    • Periksa ekstensi file sebelum membuka
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Section -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body p-4 text-center">
                    <h5 class="mb-3">Butuh Bantuan Lebih Lanjut?</h5>
                    <p class="text-muted mb-4">Tim support kami siap membantu Anda 24/7</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-envelope me-1"></i> Email Support
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-question-circle me-1"></i> FAQ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card { transition: transform 0.2s; }
.card:hover { transform: translateY(-2px); }
</style>
@endsection