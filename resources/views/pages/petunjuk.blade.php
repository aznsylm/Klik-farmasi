@extends('layouts.app')

@section('title', 'Petunjuk Penggunaan')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Petunjuk Penggunaan Klik Farmasi</h2>
        <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Panduan lengkap untuk menggunakan platform edukasi hipertensi dan pengingat obat</p>
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
                        <h4 class="mb-0 text-primary">Mengenal Klik Farmasi</h4>
                    </div>
                    <p class="text-muted mb-3">Klik Farmasi adalah platform edukasi kesehatan yang fokus pada hipertensi:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Artikel edukatif tentang hipertensi dan kesehatan jantung</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Pengingat minum obat untuk pasien hipertensi</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Materi unduhan berupa poster</li>
                        <li class="mb-0"><i class="bi bi-check-circle-fill text-primary me-2"></i>Tanya jawab seputar hipertensi dengan ahli farmasi</li>
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
                        <h4 class="mb-0 text-primary">Membaca Artikel Kesehatan</h4>
                    </div>
                    <p class="text-muted mb-3">Akses informasi kesehatan terpercaya:</p>
                    <ol class="text-muted">
                        <li>Klik menu "Informasi" → "Artikel" atau "Berita"</li>
                        <li>Pilih artikel/berita yang ingin dibaca</li>
                        <li>Baca konten lengkap dan tips kesehatan</li>
                        <li>Bagikan artikel bermanfaat ke keluarga</li>
                    </ol>
                    <div class="alert alert-primary">
                        <small><i class="bi bi-info-circle me-1"></i>Artikel ditulis oleh mahasiswa farmasi UAA yang kompeten</small>
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
                        <h4 class="mb-0 text-primary">Mengunduh Materi Edukasi</h4>
                    </div>
                    <p class="text-muted mb-3">Download materi edukasi hipertensi:</p>
                    <ul class="text-muted">
                        <li>Klik menu "Unduhan"</li>
                        <li>Pilih poster yang dibutuhkan</li>
                        <li>Klik tombol "Unduh" pada materi</li>
                        <li>Simpan dan gunakan untuk edukasi</li>
                    </ul>
                    <div class="alert alert-primary">
                        <small><i class="bi bi-lightbulb me-1"></i>Materi dapat digunakan untuk edukasi keluarga dan komunitas</small>
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
                        <h4 class="mb-0 text-primary">Mendaftar Akun Pasien</h4>
                    </div>
                    <p class="text-muted mb-3">Daftar untuk menggunakan fitur pengingat obat:</p>
                    <ol class="text-muted">
                        <li>Klik tombol "Akun" → "Register"</li>
                        <li>Isi data diri dengan lengkap</li>
                        <li>Klik checkbox "Saya menyetujui semua syarat & ketentuan"</li>
                        <li>Klik "Daftar Sekarang", lalu akan diarahkan ke halaman login</li>
                    </ol>
                    <div class="text-center mt-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar Sekarang</a>
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
                        <h4 class="mb-0 text-primary">Menggunakan Pengingat Obat</h4>
                    </div>
                    <p class="text-muted mb-3">Atur pengingat minum obat hipertensi (harus terdaftar dan login terlebih dahulu):</p>
                    <ol class="text-muted">
                        <li>Login ke akun pasien Anda</li>
                        <li>Klik menu "Pengingat"</li>
                        <li>Isi data medis, daftar obat dan pengaturan pengingat</li>
                        <li>Submit data, lalu terima notifikasi pengingat minum obat</li>
                    </ol>
                    <div class="text-center mt-3">
                        <a href="{{ route('pengingat') }}" class="btn btn-primary btn-sm">Atur Pengingat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                            <span class="text-white fw-bold">6</span>
                        </div>
                        <h4 class="mb-0 text-primary">Tanya Jawab Kesehatan</h4>
                    </div>
                    <p class="text-muted mb-3">Dapatkan jawaban seputar hipertensi dan obat-obatan:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-question-circle text-primary me-2"></i>Klik menu "Tanya Jawab"</li>
                                <li class="mb-2"><i class="bi bi-question-circle text-primary me-2"></i>Baca FAQ yang tersedia</li>
                                <li class="mb-0"><i class="bi bi-question-circle text-primary me-2"></i>Hubungi tim farmasi jika perlu</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-primary">
                                <h6 class="mb-2"><i class="bi bi-shield-check me-1"></i>Informasi Terpercaya:</h6>
                                <small>
                                    • Jawaban dari mahasiswa farmasi UAA<br>
                                    • Berdasarkan literatur ilmiah<br>
                                    • Konsultasi lebih lanjut dengan dokter
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
                    <p class="text-muted mb-4">Tim Klik Farmasi UAA siap membantu Anda</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="mailto:klikfarmasi.official@gmail.com" class="btn btn-outline-primary">
                            <i class="bi bi-envelope me-1"></i> Email Kami
                        </a>
                        <a href="https://wa.me/+6285280909235" class="btn btn-outline-primary" target="_blank">
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="{{ route('tanya-jawab.kehamilan') }}" class="btn btn-outline-primary">
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