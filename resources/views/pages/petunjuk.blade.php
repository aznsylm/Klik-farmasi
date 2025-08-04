@extends('layouts.app')

@section('title', 'Petunjuk Penggunaan')

@section('content')
    <section class="py-5 guide-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Panduan Penggunaan Website Klik Farmasi</h2>
                <p class="lead text-muted mx-auto"
                    style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Selamat datang! Berikut
                    panduan sederhana untuk menjelajahi layanan kami</p>
                <div class="d-flex justify-content-center mt-3">
                    <div
                        style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;">
                    </div>
                </div>
            </div>

            <!-- Navigation Guide -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="guide-card featured-card" data-aos="fade-up" data-aos-delay="100">
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
                                    <li>Buka halaman utama</li>
                                    <li>Scroll untuk melihat menu utama dalam beranda</li>
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
                            <p class="step-description mb-3">"Baca tips kesehatan seputar hipertensi yang berfokus pada pola
                                hidup sehat, obat-obatan, dan penyakit."</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu "Informasi” </li>
                                    <li>Pilih topik yang diminati</li>
                                    <li>Baca langsung</li>
                                    <li>Bebas diakses tanpa login</li> <br>
                                </ol>
                            </div>
                            <div class="info-badge">
                                <i class="bi bi-info-circle me-2"></i>Artikel ditulis oleh mahasiswa farmasi UAA yang
                                kompeten
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
                            <p class="step-description mb-3">"Cari jawaban instan untuk pertanyaan kesehatan yang paling
                                sering ditanyakan seputar hipertensi!"</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu "Tanya Jawab"</li>
                                    <li>Pilih pertanyaan yang ingin Anda ketahui jawabannya</li>
                                    <li>Temukan jawaban langsung dari ahlinya</li>
                                    <li>Akses bebas tanpa login (Contoh: "Bagaimana cara menyimpan obat hipertensi yang
                                        benar?")</li>
                                </ol>
                            </div>
                            <div class="info-badge">
                                <i class="bi bi-lightbulb me-2"></i>Jawaban dari Tim Pengelola Website Klik-Farmasi
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
                            <p class="step-description mb-3">"Download poster edukasi kesehatan gratis untuk keluarga Anda!"
                            </p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu "Unduhan"</li>
                                    <li>Pilih poster yang diinginkan</li>
                                    <li>Klik tombol "Download"</li>
                                    <li>File akan otomatis tersimpan di perangkat Anda</li>
                                    <li>Gratis tanpa login</li>
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
                            <p class="step-description mb-3">"Ngobrol langsung dengan ahli farmasi - gratis dan cepat!"</p>
                            <div class="step-content">
                                <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                <ol class="step-list numbered">
                                    <li>Klik menu "Konsultasi"</li>
                                    <li>Ketik pertanyaan Anda di kotak chat</li>
                                    <li>Tekan "Kirim"</li>
                                    <li>Tunggu balasan ahli dalam 1x24 jam</li>
                                    <li>Tanpa login (Contoh: "Bolehkah ibu hamil dengan hiperteni minum obat X?")</li>
                                </ol>
                            </div>
                            <div class="text-center mt-3">
                                <a href="https://wa.me/+6285280909235" class="btn btn-primary btn-sm" target="_blank">
                                    <i class="bi bi-whatsapp me-2"></i>Konsultasi via WhatsApp
                                </a>
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
                            <p class="step-description mb-3">Akun pasien diperlukan untuk menggunakan fitur pengingat minum
                                obat:</p> <br>
                            <div class="step-content">
                                <ol class="step-list numbered">
                                    <li>Klik tombol "Akun" lalu pilih "Register"</li>
                                    <li>Isi data diri dengan lengkap</li>
                                    <li>Centang kotak "Saya menyetujui semua syarat & ketentuan"</li>
                                    <li>Klik "Daftar Sekarang" - Anda akan diarahkan ke halaman login</li>
                                </ol>
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar Sekarang</a>
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
                                <h4 class="mb-0 step-title">Cara Menggunakan Pengingat Obat</h4>
                            </div>
                            <p class="step-description mb-3">Setelah memiliki akun dan login, ikuti langkah berikut untuk
                                mengatur pengingat obat hipertensi:</p>
                            <div class="step-content">
                                <ol class="step-list numbered">
                                    <li>Login ke akun pasien Anda</li>
                                    <li>Klik menu "Pengingat"</li>
                                    <li>Isi data kesehatan, nama obat, dan atur waktu pengingat</li>
                                    <li>Klik Submit - Anda akan menerima notifikasi sebagai pengingat minum obat</li>
                                </ol>
                            </div>
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
                    <div class="guide-card featured-card" data-aos="fade-up" data-aos-delay="800">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="step-number">
                                    <span>8</span>
                                </div>
                                <h4 class="mb-0 step-title">Pengingat Obat</h4>
                            </div>
                            <p class="step-description mb-3">"Atur alarm minum obat dan dapatkan notifikasi!"</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="step-content">
                                        <h6 class="fw-bold mb-3">Cara Penggunaan:</h6>
                                        <ol class="step-list numbered">
                                            <li>Klik menu "Pengingat Obat" (akan muncul halaman login)</li>
                                            <li>Masukkan email & password</li>
                                            <li>Klik "+ Tambah Pengingat"</li>
                                            <li>Isi nama obat, jadwal, frekuensi</li>
                                            <li>Simpan → Notifikasi akan dikirim ke HP/email Anda</li>
                                            <li>(Hanya untuk pengguna terdaftar) <strong>Wajib login</strong></li>
                                        </ol>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="alert alert-primary">
                                    <h6 class="mb-2"><i class="bi bi-shield-check me-1"></i>Informasi Terpercaya:</h6>
                                    <small>
                                        • Jawaban dari Tim Pengelola Website Klik-Farmasi<br>
                                        • Sumber Berdasarkan Literatur Ilmiah<br>
                                        • Konsultasi Lebih Lanjut dengan Apoteker dan Dokter
                                    </small>
                                </div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <style>
        .guide-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh
        }

        .guide-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 6px 20px rgba(11, 94, 145, .3)
        }

        .guide-icon i {
            font-size: 1.8rem;
            color: white
        }

        .guide-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .08);
            border: none;
            transition: all .3s ease;
            overflow: hidden;
            position: relative
        }

        .guide-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, .12)
        }

        .featured-card {
            border-left: 4px solid #0b5e91
        }

        .guide-card .card-body {
            padding: 1.25rem !important
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: .75rem;
            box-shadow: 0 3px 10px rgba(11, 94, 145, .3)
        }

        .step-number span {
            color: white;
            font-weight: 700;
            font-size: 1rem
        }

        .step-icon {
            width: 35px;
            height: 35px;
            background: rgba(11, 94, 145, .1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0b5e91;
            font-size: 1.1rem
        }

        .step-title {
            color: #0b5e91;
            font-weight: 700;
            font-size: 1.1rem
        }

        .step-description {
            color: #6c757d;
            font-style: italic;
            font-size: .9rem;
            line-height: 1.5;
            background: rgba(11, 94, 145, .05);
            padding: .75rem;
            border-radius: 6px;
            border-left: 3px solid #baa971
        }

        .step-content h6 {
            color: #0b5e91;
            font-size: 1rem;
            margin-bottom: .75rem
        }

        .step-list {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .step-list li {
            padding: .4rem 0;
            color: #495057;
            font-size: .85rem;
            line-height: 1.4;
            display: flex;
            align-items: flex-start
        }

        .step-list li i {
            color: #0b5e91;
            margin-top: .15rem;
            flex-shrink: 0
        }

        .step-list.numbered {
            counter-reset: step-counter
        }

        .step-list.numbered li {
            counter-increment: step-counter;
            position: relative;
            padding-left: 1.75rem
        }

        .step-list.numbered li::before {
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: .4rem;
            width: 18px;
            height: 18px;
            background: #baa971;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .75rem;
            font-weight: 600
        }

        .info-badge {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #0b5e91;
            padding: .6rem .8rem;
            border-radius: 6px;
            font-size: .8rem;
            margin-top: .75rem;
            border: 1px solid rgba(11, 94, 145, .2)
        }

        .btn-primary {
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            border: none;
            border-radius: 6px;
            padding: .4rem 1.2rem;
            font-weight: 600;
            transition: all .3s ease;
            box-shadow: 0 3px 10px rgba(11, 94, 145, .3);
            font-size: .85rem
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #baa971 0%, #d4c589 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(186, 169, 113, .4)
        }

        .btn-outline-primary {
            border: 2px solid #0b5e91;
            color: #0b5e91;
            border-radius: 6px;
            padding: .4rem 1.2rem;
            font-weight: 600;
            transition: all .3s ease;
            font-size: .85rem
        }

        .btn-outline-primary:hover {
            background: #0b5e91;
            border-color: #0b5e91;
            color: white;
            transform: translateY(-1px)
        }

        @media (max-width:768px) {
            .guide-icon {
                width: 55px;
                height: 55px
            }

            .guide-icon i {
                font-size: 1.4rem
            }

            .step-number {
                width: 35px;
                height: 35px
            }

            .step-number span {
                font-size: .9rem
            }

            .step-icon {
                width: 30px;
                height: 30px;
                font-size: 1rem
            }

            .step-title {
                font-size: 1rem
            }

            .step-description {
                font-size: .8rem;
                padding: .6rem
            }

            .guide-card .card-body {
                padding: 1rem !important
            }
        }
    </style>
@endsection
