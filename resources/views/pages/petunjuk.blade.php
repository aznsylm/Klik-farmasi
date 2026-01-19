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
                <p class="lead text-muted mx-auto" style="max-width: 700px;">Hai! Yuk ikuti panduan mudah ini buat kamu yang
                    baru pertama kali pakai website Klik Farmasi</p>
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
                            <p class="step-description mb-3">"Mulai dari sini! Di halaman utama kamu bisa langsung lihat
                                info kesehatan terbaru tentang hipertensi dan semua layanan yang tersedia."</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Menggunakannya:</h6>
                                <ol class="step-list numbered">
                                    <li>Buka halaman utama dengan <a href="{{ route('beranda') }}">klik di sini</a></li>
                                    <li>Scroll ke bawah untuk lihat artikel dan info kesehatan terbaru</li>
                                    <li>Semua bisa dibaca langsung tanpa perlu daftar atau login dulu</li>
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
                            <p class="step-description mb-3">"Cari info lengkap tentang hipertensi? Di sini ada banyak
                                artikel berguna mulai dari tips hidup sehat, cara minum obat yang benar, sampai penjelasan
                                tentang penyakit hipertensi."
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Menggunakannya:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu <strong>"Artikel"</strong> yang ada di bagian atas website</li>
                                    <li>Pilih kategori yang kamu butuhkan:
                                        <ul class="ms-3 mt-2">
                                            <li><a href="{{ route('artikel.kehamilan') }}" class="text-primary">Hipertensi
                                                    Kehamilan</a> (khusus untuk ibu hamil)</li>
                                            <li><a href="{{ route('artikel.non-kehamilan') }}"
                                                    class="text-primary">Hipertensi Non Kehamilan</a> (untuk masyarakat
                                                umum)</li>
                                        </ul>
                                    </li>
                                    <li>Pilih artikel yang menarik, terus klik tombol <strong>"Baca Selengkapnya"</strong>
                                    </li>
                                    <li>Langsung bisa dibaca gratis tanpa perlu login!</li>
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
                            <p class="step-description mb-3">"Ada pertanyaan tentang hipertensi? Cek dulu di bagian FAQ,
                                siapa tau pertanyaan kamu sudah ada jawabannya dari ahli farmasi!"
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Menggunakannya:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu <strong>"Tanya Jawab"</strong> di bagian atas website</li>
                                    <li>Pilih kategori sesuai kebutuhan kamu:
                                        <ul class="ms-3 mt-2">
                                            <li><a href="{{ route('tanya-jawab.kehamilan') }}"
                                                    class="text-primary">Hipertensi Kehamilan</a> (untuk ibu hamil)</li>
                                            <li><a href="{{ route('tanya-jawab.non-kehamilan') }}"
                                                    class="text-primary">Hipertensi Non Kehamilan</a> (untuk umum)</li>
                                        </ul>
                                    </li>
                                    <li>Baca daftar pertanyaan yang sudah dijawab langsung sama ahli farmasi</li>
                                    <li>Gratis dan bisa dibaca tanpa login!</li>
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
                            <p class="step-description mb-3">"Butuh materi edukasi yang bisa dicetak? Download poster-poster
                                kesehatan gratis buat kamu dan keluarga di rumah!"
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Menggunakannya:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu <a href="{{ route('unduhan') }}"
                                            class="text-primary"><strong>"Unduhan"</strong></a> di bagian atas</li>
                                    <li>Lihat-lihat koleksi poster yang tersedia, pilih yang kamu butuhkan</li>
                                    <li>Klik tombol <strong>"Unduh"</strong> pada poster yang dipilih</li>
                                    <li>Kamu akan diarahkan ke halaman download (biasanya Google Drive)</li>
                                    <li>Klik <strong>"Download"</strong> dan poster akan tersimpan di HP/laptop kamu</li>
                                    <li>Semuanya gratis dan tanpa perlu daftar akun!</li>
                                </ol>
                            </div>
                            <div class="info-badge">
                                <i class="bi bi-info-circle me-2"></i><strong>Jenis poster yang tersedia:</strong> Panduan
                                minum obat, tips kelola hipertensi, pola hidup sehat, cara cek tekanan darah, dan masih
                                banyak lagi!
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
                            <p class="step-description mb-3">"Punya pertanyaan khusus tentang obat atau kesehatan? Chat
                                langsung sama ahli farmasi lewat WhatsApp, gratis!"
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Menggunakannya:</h6>
                                <ol class="step-list numbered">
                                    <li><strong>Cara 1:</strong> Klik ikon WhatsApp hijau yang ada di pojok kanan bawah
                                        layar</li>
                                    <li><strong>Cara 2:</strong> Langsung klik tombol <a href="https://wa.me/+6281292936247"
                                            class="text-primary" target="_blank"><strong>"Konsultasi Via
                                                WhatsApp"</strong></a></li>
                                    <li>Klik <strong>"Lanjutkan ke Chat"</strong> buat buka aplikasi WhatsApp kamu</li>
                                    <li>Ketik pertanyaan kamu dengan jelas
                                        <div class="mt-2 p-2 bg-light rounded">
                                            <small><strong>Contoh:</strong> "Dok, apakah obat hipertensi aman diminum ibu
                                                hamil?" atau "Obat darah tinggi saya habis, boleh ganti merk?"</small>
                                        </div>
                                    </li>
                                    <li>Tekan tombol <strong>"Kirim"</strong></li>
                                    <li>Tunggu balasan dari ahli farmasi dalam waktu maksimal 24 jam</li>
                                    <li>Konsultasi ini benar-benar gratis dan tidak perlu daftar akun!</li>
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
                                    <li>Masukan Kode pendaftaran yang sudah diberikan oleh admin. Catatan: setiap 1 kode
                                        pendaftaran, hanya untuk 1 akun pasien</li>
                                    <li>Centang kotak “Saya menyetujui syarat & ketentuan”</li>
                                    <li>Tekan "Daftar Sekarang", lalu kamu akan diarahkan ke halaman login</li>
                                    <li>Hubungi <a href="https://wa.me/+6281292936247" class="text-primary"
                                            target="_blank">Admin</a> jika memiliki kendala pendaftaran</li>
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
                            <p class="step-description mb-3">Sudah punya akun dan login? Sekarang saatnya setting pengingat
                                minum obat biar gak lupa!</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Setting Pengingat:</h6>
                                <ol class="step-list numbered">
                                    <li>Login ke akun pasien kamu yang sudah terdaftar</li>
                                    <li>Di halaman dashboard, cari dan klik menu <strong>"Pengingat"</strong> atau
                                        <strong>"Buat Pengingat Baru"</strong></li>
                                    <li>Isi form pengingat dengan lengkap:
                                        <ul class="ms-3 mt-2">
                                            <li>Kondisi kesehatan kamu</li>
                                            <li>Data tekanan darah terakhir</li>
                                            <li>Nama obat/suplemen (minimal 1 jenis)</li>
                                            <li>Jadwal minum (jam berapa aja)</li>
                                            <li>Seberapa sering minum (berapa kali sehari)</li>
                                        </ul>
                                    </li>
                                    <li>Kalau ada catatan khusus untuk admin, tulis juga ya</li>
                                    <li>Klik <strong>"Simpan Pengingat Saya"</strong></li>
                                    <li>Sistem akan kirim konfirmasi ke WhatsApp kamu yang terdaftar</li>
                                    <li>Mulai sekarang, kamu akan dapat notifikasi WhatsApp 5 menit sebelum waktu minum obat
                                    </li>
                                    <li>
                                        <div class="p-2 bg-info bg-opacity-25 rounded mt-2"><small><i
                                                    class="bi bi-info-circle me-1"></i><strong>Catatan:</strong> Fitur ini
                                                hanya bisa dipakai kalau kamu sudah login ke akun pasien</small></div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
