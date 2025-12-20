@extends('layouts.app')

@section('title', 'Petunjuk Penggunaan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Panduan lengkap cara menggunakan website Klik Farmasi. Tutorial pengingat obat, akses artikel kesehatan, dan fitur konsultasi farmasi online.">
    <meta name="keywords"
        content="panduan klik farmasi, tutorial pengingat obat, cara menggunakan, petunjuk website, bantuan pengguna">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

@section('content')
    <section class="py-5 guide-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bolder mb-3 text-primary">Panduan Penggunaan Website Klik Farmasi</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">Selamat datang! Berikut
                    panduan sederhana untuk menjelajahi layanan kami</p>
                <div class="d-flex justify-content-center mt-3">
                    <div class="section-divider"></div>
                </div>
            </div>

            <!-- Step 1 -->
            <div class="guide-step" data-aos="fade-up" data-aos-delay="100">
                <div class="step-header">
                    <div class="step-number-circle">1</div>
                    <h3 class="step-title">Beranda</h3>
                </div>
                <p class="step-description">Mulai dari sini! Temukan informasi seputar kesehatan mengenai hipertensi terbaru dan layanan utama kami.</p>
                <div class="step-instructions">
                    <h5 class="instructions-title">Cara Penggunaan:</h5>
                    <ul class="instructions-list">
                        <li>Buka halaman utama atau <a href="https://klikfarmasi.com/" class="text-primary">klik disini</a></li>
                        <li>Geser layer ke bawah untuk melihat menu utama dalam beranda</li>
                        <li>Tidak perlu login</li>
                    </ul>
                </div>
            </div>

            <!-- Steps 2-3 -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="guide-step" data-aos="fade-up" data-aos-delay="200">
                        <div class="step-header">
                            <div class="step-number-circle">2</div>
                            <h3 class="step-title">Artikel Kesehatan</h3>
                        </div>
                        <p class="step-description">Temukan berbagai tips seputar hipertensi dan kesehatan! mulai dari cara menjaga pola hidup sehat, penggunaan obat, hingga mengenali penyakit hipertensi.</p>
                        <div class="step-instructions">
                            <h5 class="instructions-title">Cara Penggunaan:</h5>
                            <ul class="instructions-list">
                                <li>Tekan menu "Artikel" di bagian atas halaman</li>
                                <li>Pilih topik yang ingin kamu baca, misalnya tentang Hipertensi Kehamilan atau Hipertensi Non Kehamilan</li>
                                <li>Setelah masuk, pilih judul yang ingin dibaca dan klik "Baca Selengkapnya"</li>
                                <li>Bisa diakses gratis, tanpa harus login dulu!</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="guide-step" data-aos="fade-up" data-aos-delay="300">
                        <div class="step-header">
                            <div class="step-number-circle">3</div>
                            <h3 class="step-title">Tanya Jawab (FAQ)</h3>
                        </div>
                        <p class="step-description">Dapatkan jawaban cepat untuk pertanyaan seputar hipertensi dan kesehatan yang paling sering ditanyakan.</p>
                        <div class="step-instructions">
                            <h5 class="instructions-title">Cara Penggunaan:</h5>
                            <ul class="instructions-list">
                                <li>Tekan menu "Tanya Jawab" di bagian atas halaman</li>
                                <li>Pilih topik yang ingin kamu ketahui, misalnya tentang Hipertensi Kehamilan atau Hipertensi Non Kehamilan</li>
                                <li>Temukan jawaban langsung dari ahlinya</li>
                                <li>Semua bisa dibuka gratis tanpa login!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Steps 4-5 -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="guide-step" data-aos="fade-up" data-aos-delay="400">
                        <div class="step-header">
                            <div class="step-number-circle">4</div>
                            <h3 class="step-title">Unduhan Poster</h3>
                        </div>
                        <p class="step-description">Download/unduh poster edukasi kesehatan secara gratis untuk anda dan keluarga!</p>
                        <div class="step-instructions">
                            <h5 class="instructions-title">Cara Penggunaan:</h5>
                            <ul class="instructions-list">
                                <li>Tekan menu "Unduhan"</li>
                                <li>Pilih poster yang diinginkan</li>
                                <li>Tekan tombol "Unduh"</li>
                                <li>Poster akan langsung diarahkan ke Google Drive</li>
                                <li>Download poster tersebut, kemudian gambar tersimpan di perangkat anda</li>
                                <li>Gratis dan tanpa perlu login</li>
                            </ul>
                        </div>
                        <div class="info-note">
                            <i class="bi bi-info-circle me-2"></i>
                            <span>Poster tersedia: Panduan Penggunaan Obat, Pengelolaan Hipertensi, Gaya Hidup Sehat, Monitoring Tekanan Darah, dll.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="guide-step" data-aos="fade-up" data-aos-delay="500">
                        <div class="step-header">
                            <div class="step-number-circle">5</div>
                            <h3 class="step-title">Konsultasi Langsung</h3>
                        </div>
                        <p class="step-description">Ngobrol langsung dengan ahli farmasi secara gratis dan cepat!</p>
                        <div class="step-instructions">
                            <h5 class="instructions-title">Cara Penggunaan:</h5>
                            <ul class="instructions-list">
                                <li>Tekan logo WhatsApp/lingkaran hijau bagian pojok kanan bawah pada layar anda</li>
                                <li>Gunakan fitur dibawah petunjuk ini, tekan bagian "Konsultasi Via WhatsApp"</li>
                                <li>Tekan "Lanjutkan ke Chat", Secara langsung terhubung admin via WhatsApp</li>
                                <li>Ketik pertanyaan kamu di kotak chat. (Contoh: "Bolehkah ibu hamil minum obat hipertensi ini?")</li>
                                <li>Tekan "Kirim"</li>
                                <li>Tunggu jawaban dari ahli farmasi/apoteker maksimal dalam 1x24 jam</li>
                                <li>Gratis dilakukan tanpa harus login</li>
                            </ul>
                        </div>
                        <div class="text-center mt-4">
                            <a href="https://wa.me/+6281292936247" class="btn btn-success px-4 py-2" target="_blank">
                                <i class="bi bi-whatsapp me-2"></i>Konsultasi via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Steps 6-7 -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="guide-step" data-aos="fade-up" data-aos-delay="600">
                        <div class="step-header">
                            <div class="step-number-circle">6</div>
                            <h3 class="step-title">Cara Mendaftar Akun Pasien</h3>
                        </div>
                        <p class="step-description">Akun pasien dibutuhkan untuk menggunakan fitur pengingat minum obat.</p>
                        <div class="step-instructions">
                            <h5 class="instructions-title">Cara Penggunaan:</h5>
                            <ul class="instructions-list">
                                <li>Tekan tombol "Akun", lalu pilih "Register"</li>
                                <li>Isi data diri dengan lengkap</li>
                                <li>Masukan Kode pendaftaran yang sudah diberikan oleh admin. Catatan: setiap 1 kode pendaftaran, hanya untuk 1 akun pasien</li>
                                <li>Centang kotak "Saya menyetujui syarat & ketentuan"</li>
                                <li>Tekan "Daftar Sekarang", lalu kamu akan diarahkan ke halaman login</li>
                                <li>Hubungi Admin jika memiliki kendala pendaftaran</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="guide-step" data-aos="fade-up" data-aos-delay="700">
                        <div class="step-header">
                            <div class="step-number-circle">7</div>
                            <h3 class="step-title">Cara Menggunakan Pengingat Minum Obat</h3>
                        </div>
                        <p class="step-description">Setelah punya akun dan login, ikuti langkah ini untuk atur pengingat minum obat anda.</p>
                        <div class="step-instructions">
                            <h5 class="instructions-title">Cara Penggunaan:</h5>
                            <ul class="instructions-list">
                                <li>Tekan fitur akun bagian pojok kanan atas, tekan bagian "Login"</li>
                                <li>Masukkan email/no telepon dan password yang sudah didaftarkan</li>
                                <li>Tekan "Buat Pengingat"</li>
                                <li>Isi jenis kondisi kesehatan, tekanan darah, nama obat/suplemen minimal 1, jadwal minum, dan frekuensi minum obat</li>
                                <li>Berikan catatan untuk admin, bila perlu disampaikan dari anda</li>
                                <li>Tekan "Simpan Pengingat Saya" → Informasi Pengingat Minum Obat akan dikirim ke nomor WhatsApp yang sudah terdaftar</li>
                                <li>Notifikasi pengingat minum obat akan terkirim 5 menit sebelum waktu minum obat dan disesuaikan dari jumlah obat yang di masukan</li>
                                <li>Khusus untuk pengguna yang sudah daftar (Wajib login Website)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection