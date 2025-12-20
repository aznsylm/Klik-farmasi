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

            <!-- Navigation Guide -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="guide-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>1</span>
                                </div>
                                <h4 class="mb-0 step-title">Beranda</h4>
                            </div>
                            <p class="step-description mb-3">"Mulai dari sini! Temukan informasi seputar kesehatan mengenai
                                hipertensi terbaru dan layanan utama kami."</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Buka halaman utama atau <a href="https://klikfarmasi.com/"> klik disini</a></li>
                                    <li>Geser layer ke bawah untuk melihat artikel terbaru</li>
                                    <li>Tidak perlu login</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout for Steps 2-3 -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="guide-card h-100" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>2</span>
                                </div>
                                <h4 class="mb-0 step-title">Artikel Kesehatan</h4>
                            </div>
                            <p class="step-description mb-3">"Temukan berbagai tips seputar hipertensi dan kesehatan! mulai
                                dari cara menjaga pola hidup sehat, penggunaan obat, hingga mengenali penyakit hipertensi."
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Tekan menu <a href="{{ route('artikel.non-kehamilan') }}" class="text-primary">"Artikel"</a> di bagian atas halaman.</li>
                                    <li>Pilih topik yang ingin kamu baca, misalnya tentang <a href="{{ route('artikel.kehamilan') }}" class="text-primary">Hipertensi Kehamilan</a> atau
                                        <a href="{{ route('artikel.non-kehamilan') }}" class="text-primary">Hipertensi Non Kehamilan</a>.</li>
                                    <li>Setelah masuk, pilih judul yang ingin dibaca dan klik "Baca Selengkapnya"</li>
                                    <li>Bisa diakses gratis, tanpa harus login dulu!</li> <br>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="guide-card h-100" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>3</span>
                                </div>
                                <h4 class="mb-0 step-title">Tanya Jawab (FAQ)</h4>
                            </div>
                            <p class="step-description mb-3">"Dapatkan jawaban cepat untuk pertanyaan seputar hipertensi dan
                                kesehatan yang paling sering ditanyakan!."</p> <br>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Tekan menu <a href="{{ route('tanya-jawab.non-kehamilan') }}" class="text-primary">"Tanya Jawab"</a> di bagian atas halaman.</li>
                                    <li>Pilih topik yang ingin kamu ketahui, misalnya tentang <a href="{{ route('tanya-jawab.kehamilan') }}" class="text-primary">Hipertensi Kehamilan</a> atau
                                        <a href="{{ route('tanya-jawab.non-kehamilan') }}" class="text-primary">Hipertensi Non Kehamilan</a>.</li>
                                    <li>Temukan jawaban langsung dari ahlinya.</li>
                                    <li>Semua bisa dibuka gratis tanpa login!</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout for Steps 4-5 -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="guide-card h-100" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>4</span>
                                </div>
                                <h4 class="mb-0 step-title">Unduhan Poster</h4>
                            </div>
                            <p class="step-description mb-3">"Download/unduh poster edukasi kesehatan secara gratis untuk
                                anda dan keluarga!"
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Tekan menu <a href="{{ route('unduhan') }}" class="text-primary">"Unduhan"</a></li>
                                    <li>Pilih poster yang diinginkan.</li>
                                    <li>Tekan tombol "Unduh"</li>
                                    <li>Poster akan langsung diarahkan langsung ke Google Drive</li>
                                    <li>Download poster tersebut, kemudian gambar tersimpan di perangkat anda</li>
                                    <li>Gratis dan tanpa perlu login</li>
                                </ol>
                            </div>
                            <div class="info-badge">
                                <i class="bi bi-info-circle me-2"></i>Poster tersedia: Panduan Penggunaan Obat, Pengelolaan
                                Hipertensi, Gaya Hidup Sehat, Monitoring Tekanan Darah, dll.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="guide-card h-100" data-aos="fade-up" data-aos-delay="500">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>5</span>
                                </div>
                                <h4 class="mb-0 step-title">Konsultasi Langsung</h4>
                            </div>
                            <p class="step-description mb-3">"Ngobrol langsung dengan ahli farmasi secara gratis dan cepat!"
                            </p> <br>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Tekan logo WhatsApp/lingkaran hijau bagian pojok kanan bawah pada layar anda</li>
                                    <li>Gunakan fitur dibawah petunjuk ini, tekan bagian <a href="https://wa.me/+6281292936247" class="text-primary" target="_blank">"Konsultasi Via WhatsApp"</a></li>
                                    <li>Tekan "Lanjutkan ke Chat", Secara langsung terhubung admin via WhatsApp</li>
                                    <li>Ketik pertanyaan kamu di kotak chat. (Contoh: "Bolehkah ibu hamil minum obat
                                        hipertensi ini?")</li>
                                    <li>Tekan "Kirim".</li>
                                    <li>Tunggu jawaban dari ahli farmasi/apoteker maksimal dalam 1x24 jam.</li>
                                    <li>Gratis dilakukan tanpa harus login</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Management Section -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="guide-card h-100" data-aos="fade-up" data-aos-delay="600">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>6</span>
                                </div>
                                <h4 class="mb-0 step-title">Cara Mendaftar Akun Pasien</h4>
                            </div>
                            <p class="step-description mb-3">Akun pasien dibutuhkan untuk menggunakan fitur pengingat minum
                                obat.</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Tekan tombol "Akun", lalu pilih "Register"</li>
                                    <li>Isi data diri dengan lengkap</li>
                                    <li>Masukan Kode pendaftaran yang sudah diberikan oleh admin. Catatan: setiap 1 kode pendaftaran, hanya untuk 1 akun pasien</li>
                                    <li>Centang kotak “Saya menyetujui syarat & ketentuan”</li>
                                    <li>Tekan "Daftar Sekarang", lalu kamu akan diarahkan ke halaman login</li>
                                    <li>Hubungi <a href="https://wa.me/+6281292936247" class="text-primary" target="_blank">Admin</a> jika memiliki kendala pendaftaran</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="guide-card h-100" data-aos="fade-up" data-aos-delay="700">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>7</span>
                                </div>
                                <h4 class="mb-0 step-title">Cara Menggunakan Pengingat Minum Obat</h4>
                            </div>
                            <p class="step-description mb-3">Setelah punya akun dan login, ikuti langkah ini untuk atur
                                pengingat minum obat anda.</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Login ke akun pasien yang sudah terdaftar</li>
                                    <li>Masuk ke dashboard pasien</li>
                                    <li>Tekan menu "Pengingat" atau "Buat Pengingat Baru"</li>
                                    <li>Isi jenis kondisi kesehatan, tekanan darah, nama obat/suplemen minimal 1, jadwal minum, dan frekuensi minum obat</li>
                                    <li>Berikan catatan untuk admin, bila perlu disampaikan dari anda</li>
                                    <li>Tekan "Simpan Pengingat Saya" → Informasi Pengingat Minum Obat akan dikirim ke nomor WhatsApp yang sudah terdaftar</li>
                                    <li>Notifikasi pengingat minum obat akan terkirim 5 menit sebelum waktu minum obat dan disesuaikan dari jumlah obat yang di masukan</li>
                                    <li>Khusus untuk pengguna yang sudah daftar (Wajib login Website)</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            {{-- <div class="row mb-5">
                <div class="col-12">
                    <div class="guide-card featured-card" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>8</span>
                                </div>
                                <h4 class="mb-0 step-title">Pengingat Minum Obat</h4>
                            </div>
                            <p class="step-description mb-3">"Atur alarm minum obat dan dapatkan informasi notifikasinya!"
                            </p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="step-content">
                                        <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                        <ol class="step-list numbered">
                                            <li>Tekan menu "Pengingat" (akan muncul pada halaman login)</li>
                                            <li>Masukkan email & password</li>
                                            <li>Tekan " Tombol (+) Tambah Pengingat"</li>
                                            <li>Isi nama obat, jadwal minum, dan frekuensi minum obat</li>
                                            <li>Tekan "Simpan" → Informasi notifikasi akan dikirim ke HP/email
                                            </li>
                                            <li>Khusus untuk pengguna yang sudah daftar (Wajib login Website)</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </section>
@endsection
