@extends('layouts.app')
@section('title', 'Beranda')
@section('content')
    <style>
        .revolutionary-hero-section {
            min-height: 100vh;
            position: relative;
            overflow: hidden
        }

        .hero-background-new {
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 50%, #2c7bb8 100%);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0
        }

        .hero-overlay-new {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, .05)
        }

        .hero-visual-section {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: none;
        }

        .clean-carousel-wrapper {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .2);
            background: white;
            padding: .3rem;
            width: 100%;
            max-width: 100%;
        }

        .clean-slide-wrapper {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            border-radius: 12px;
        }

        .clean-slide-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .clean-carousel-controls {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            z-index: 10
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 0;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, .9);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1)
        }

        .carousel-control-prev {
            left: 20px
        }

        .carousel-control-next {
            right: 20px
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: white;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .15)
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 20px 20px;
            width: 20px;
            height: 20px
        }

        .clean-carousel-indicators {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10
        }

        .clean-carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            background: transparent;
            transition: all .3s ease
        }

        .clean-carousel-indicators button.active {
            background: white;
            transform: scale(1.2)
        }

        .hero-content-section {
            /* padding: 2rem 0 4rem;    */
            position: relative;
            z-index: 2
        }

        /* .hero-welcome-content {
            margin-bottom: 3rem
        } */

        .revolutionary-hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, .3)
        }

        .revolutionary-text-gradient {
            background: linear-gradient(135deg, #baa971 0%, #d4c589 50%, #e8d9a3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text
        }

        .revolutionary-hero-subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, .95);
            line-height: 1.6;
            font-weight: 400;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, .2)
        }

        .action-cards-wrapper {
            margin-top: 2rem
        }

        .enhanced-action-card {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
            transition: all .4s ease;
            position: relative;
            overflow: hidden
        }

        .action-card-inner {
            background: rgba(255, 255, 255, .95);
            border-radius: 20px;
            padding: 2rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, .1)
        }

        .enhanced-action-card:hover {
            transform: translateY(-8px);
            text-decoration: none;
            color: inherit
        }

        .enhanced-action-card:hover .action-card-inner {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .15)
        }

        .action-card-header {
            margin-bottom: 1.5rem
        }

        .action-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(11, 94, 145, .3)
        }

        .action-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0b5e91;
            margin-bottom: .5rem
        }

        .action-subtitle {
            color: #6c757d;
            font-size: .9rem;
            margin-bottom: 0
        }

        .action-card-body {
            flex-grow: 1;
            margin-bottom: 1.5rem
        }

        .action-description {
            color: #495057;
            line-height: 1.6;
            font-size: .95rem
        }

        .action-card-footer {
            margin-top: auto
        }

        .action-link {
            color: #0b5e91;
            font-weight: 600;
            font-size: .9rem
        }

        .action-arrow {
            width: 20px;
            height: 20px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%230b5e91' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z'/%3E%3C/svg%3E") no-repeat center;
            background-size: contain;
            display: inline-block;
            margin-left: .5rem;
            transition: transform .3s ease
        }

        .enhanced-action-card:hover .action-arrow {
            transform: translateX(5px)
        }

        .action-card-glow {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(11, 94, 145, .1) 0%, rgba(186, 169, 113, .1) 100%);
            border-radius: 20px;
            opacity: 0;
            transition: opacity .4s ease;
            z-index: 1
        }

        .enhanced-action-card:hover .action-card-glow {
            opacity: 1
        }

        .features-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative
        }

        .features-header {
            margin-bottom: 4rem
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0b5e91;
            margin-bottom: 1rem
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto
        }

        .section-divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #0b5e91, #baa971);
            border-radius: 2px;
            margin-top: 1.5rem
        }

        .enhanced-feature-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(11, 94, 145, .1);
            transition: all .4s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .08)
        }

        .enhanced-feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .15);
            border-color: rgba(11, 94, 145, .2)
        }

        .feature-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem
        }

        .feature-icon-wrapper {
            position: relative
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            position: relative;
            z-index: 2
        }

        .reminder-icon {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%)
        }

        .info-icon {
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%)
        }

        .icon-glow {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            background: inherit;
            filter: blur(15px);
            opacity: .3;
            z-index: 1
        }

        .feature-number {
            width: 35px;
            height: 35px;
            background: rgba(11, 94, 145, .1);
            color: #0b5e91;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .9rem
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0b5e91;
            margin-bottom: 1rem
        }

        .feature-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1
        }

        .feature-benefits {
            margin-bottom: 1.5rem
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: .5rem;
            margin-bottom: .5rem;
            font-size: .9rem
        }

        .benefit-item i {
            color: #28a745;
            font-size: .8rem
        }

        .feature-card-footer {
            margin-top: auto
        }

        .feature-link {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: #0b5e91;
            text-decoration: none;
            font-weight: 600;
            transition: all .3s ease
        }

        .feature-link:hover {
            color: #baa971;
            transform: translateX(3px)
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            transition: all .3s ease;
            border: 1px solid rgba(11, 94, 145, .1)
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .1)
        }

        .feature-bg-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(11, 94, 145, .05) 0%, rgba(186, 169, 113, .05) 100%);
            border-radius: 0 16px 0 100px
        }

        .feature-icon {
            background: linear-gradient(135deg, #0b5e91 0%, #1a6fa0 100%);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .testimonial-card-desktop .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .testimonial-card-mobile .card {
            transition: all 0.3s ease;
        }

        /* Custom Indicator Styles */
        .carousel-indicators button {
            transition: all 0.3s ease !important;
        }

        .carousel-indicators button:hover {
            opacity: 0.8 !important;
            transform: scale(1.2);
        }

        .carousel-indicators button.active {
            opacity: 1 !important;
            transform: scale(1.3);
            box-shadow: 0 2px 8px rgba(11, 94, 145, 0.4);
        }

        /* Smooth carousel transitions */
        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }

        /* Animation for carousel items */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .carousel-item.active .card {
            animation: slideInUp 0.6s ease-out;
        }

        @media (max-width:768px) {
            .revolutionary-hero-title {
                font-size: 2.5rem
            }

            .revolutionary-hero-subtitle {
                font-size: 1.1rem
            }

            .clean-slide-wrapper {
                height: 350px
            }

            .hero-visual-section {
                padding: 2rem 0 1.5rem;
            }

            .clean-carousel-wrapper {
                border-radius: 10px;
                padding: .2rem;
            }

            .carousel-control-prev,
            .carousel-control-next {
                width: 40px;
                height: 40px
            }

            .carousel-control-prev {
                left: 10px
            }

            .carousel-control-next {
                right: 10px
            }

            .action-card-inner {
                padding: 1.5rem
            }

            .action-number {
                width: 40px;
                height: 40px;
                font-size: 1rem
            }

            .action-title {
                font-size: 1.3rem
            }

            .section-title {
                font-size: 2rem
            }

            .enhanced-feature-card {
                padding: 1.5rem
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem
            }

            .feature-number {
                width: 30px;
                height: 30px;
                font-size: .8rem
            }
        }
    </style>
    <header class="revolutionary-hero-section position-relative overflow-hidden">
        <div class="hero-background-new">
            <div class="hero-overlay-new"></div>
        </div>
        <div class="container-fluid px-0 position-relative">

            <div class="hero-visual-section" data-aos="fade-down">
                <div class="container-fluid px-2 px-lg-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-11 col-xl-10">
                            <div class="clean-carousel-wrapper">
                                <div id="cleanCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="4000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="clean-slide-wrapper"><img
                                                    src="{{ asset('assets/Slideketiga.png') }}"
                                                    alt="Informasi Hipertensi" class="clean-slide-image" loading="eager">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="clean-slide-wrapper"><img src="{{ asset('assets/Slidekedua.png') }}"
                                                    alt="Pengingat Obat" class="clean-slide-image" loading="lazy">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="clean-slide-wrapper"><img
                                                    src="{{ asset('assets/SlidePertama1.webp') }}" alt="Konsultasi Online"
                                                    class="clean-slide-image" loading="lazy">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clean-carousel-controls"><button class="carousel-control-prev"
                                            type="button" data-bs-target="#cleanCarousel" data-bs-slide="prev"><span
                                                class="carousel-control-prev-icon"></span></button><button
                                            class="carousel-control-next" type="button" data-bs-target="#cleanCarousel"
                                            data-bs-slide="next"><span class="carousel-control-next-icon"></span></button>
                                    </div>
                                    <div class="clean-carousel-indicators"><button type="button"
                                            data-bs-target="#cleanCarousel" data-bs-slide-to="0"></button><button
                                            type="button" data-bs-target="#cleanCarousel"
                                            data-bs-slide-to="1"></button><button type="button"
                                            data-bs-target="#cleanCarousel" data-bs-slide-to="2"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>
    <section class="features-section py-5" id="features">
        <div class="container px-4 px-lg-5">
            <div class="features-header text-center mb-5" data-aos="fade-up">
                <h2 class="section-title mb-4">Kenapa Memilih Kami?</h2>
                <p class="section-subtitle">Alasan utama mengapa platform ini bisa jadi pilihan terbaik Anda untuk
                    kesehatan yang lebih baik</p>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="features-grid">
                <div class="row g-4">
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="enhanced-feature-card reminder-card">
                            <div class="feature-card-header">
                                <div class="feature-icon-wrapper">
                                    <div class="feature-icon reminder-icon"><i class="bi bi-alarm-fill"></i></div>
                                    <div class="icon-glow"></div>
                                </div>
                            </div>
                            <div class="feature-card-body">
                                <h4 class="feature-title">Pengingat Minum Obat (In Progress)</h4>
                                <p class="feature-description">
                                    Fitur pengingat minum obat kami dirancang khusus untuk membantu penderita hipertensi
                                    agar tidak melewatkan jadwal minum obat yang penting untuk kesehatan.
                                </p>
                                <div class="feature-benefits">
                                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Notifikasi
                                            Real-time</span></div>
                                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Jadwal
                                            Fleksibel</span></div>
                                </div>
                            </div>
                            <div class="feature-card-footer"><a href="{{ url('/pengingat') }}"
                                    class="feature-link"><span>Coba Sekarang</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="enhanced-feature-card info-card">
                            <div class="feature-card-header">
                                <div class="feature-icon-wrapper">
                                    <div class="feature-icon info-icon"><i class="bi bi-journal-medical"></i></div>
                                    <div class="icon-glow"></div>
                                </div>
                            </div>
                            <div class="feature-card-body">
                                <h4 class="feature-title">Informasi Kesehatan Terpercaya</h4>
                                <p class="feature-description">
                                    Kami menyediakan artikel dan berita kesehatan yang akurat dan terpercaya untuk membantu
                                    Anda menjalani hidup lebih sehat dan berkualitas.
                                </p>
                                <div class="feature-benefits">
                                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Artikel
                                            Terkini</span></div>
                                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Sumber
                                            Terpercaya</span></div>
                                </div>
                            </div>
                            <div class="feature-card-footer"><a href="{{ route('artikel.non-kehamilan') }}"
                                    class="feature-link"><span>Baca Artikel</span><i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                            <div class="feature-bg-pattern"></div>
                            <div class="position-relative">
                                <div class="d-flex align-items-start mb-4">
                                    <div class="feature-icon bg-success bg-gradient rounded-circle d-flex justify-content-center align-items-center me-4 flex-shrink-0"
                                        style="width:70px;height:70px;box-shadow:0 8px 25px rgba(25, 135, 84, 0.3);"><i
                                            class="bi bi-calendar-check text-white" style="font-size:28px;"></i></div>
                                    <div class="flex-grow-1">
                                        <h4 class="fw-bold mb-3"
                                            style="font-family:'Open Sans', sans-serif;color:#2c3e50;">Kelola Jadwal Minum
                                            Obat</h4>
                                        <p class="text-muted mb-0"
                                            style="font-family:'Open Sans', sans-serif;font-size:15px;line-height:1.7;">
                                            Kelola jadwal minum obat anda dengan praktis menggunakan fitur kalender cerdas
                                            kami! Cukup input waktu minum obat sekali, dan sistem akan mengingatkan anda
                                            secara otomatis - tidak perlu khawatir lupa lagi. Dengan tampilan sederhana yang
                                            mudah dipahami, fitur ini cocok untuk siapapun lebih disiplin dalam pengobatan.
                                            Dapatkan notifikasi tepat waktu dan pantau semua jadwal obat anda, membuat hidup
                                            sehat jadi lebih mudah dan menyenangkan!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                            <div class="feature-bg-pattern"></div>
                            <div class="position-relative">
                                <div class="d-flex align-items-start mb-4">
                                    <div class="feature-icon bg-primary bg-gradient rounded-circle d-flex justify-content-center align-items-center me-4 flex-shrink-0"
                                        style="width:70px;height:70px;box-shadow:0 8px 25px rgba(13, 110, 253, 0.3);"><i
                                            class="bi bi-people text-white" style="font-size:28px;"></i></div>
                                    <div class="flex-grow-1">
                                        <h4 class="fw-bold mb-3"
                                            style="font-family:'Open Sans', sans-serif;color:#2c3e50;">Komunitas Pendukung
                                        </h4>
                                        <p class="text-muted mb-0"
                                            style="font-family:'Open Sans', sans-serif;font-size:15px;line-height:1.7;">
                                            Bergabunglah dengan komunitas kami untuk berbagi pengalaman dan mendapatkan
                                            dukungan dari sesama penderita hipertensi dalam perjalanan hidup sehat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    {{-- <div class="py-5" style="background:linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6" data-aos="zoom-in-up">
                    <div class="text-center mb-5">
                        <h2 class="fw-bolder mb-3" style="color:#0b5e91;">Apa Kata Mereka?</h2>
                        <p class="lead text-muted" style="font-family:'Open Sans', sans-serif;">Pendapat pengguna tentang
                            Klik Farmasi dari berbagai kalangan.</p>
                        <div class="d-flex justify-content-center mb-4">
                            <div
                                style="width:60px;height:4px;background:linear-gradient(90deg, #0b5e91, #baa971);border-radius:2px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block">
                <div id="testimonialCarouselDesktop" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="4000">
                    <div class="carousel-indicators position-relative mb-4"
                        style="position:relative;bottom:auto;margin-bottom:2rem;">
                        @php
                            $totalSlides = ceil($testimonials->count() / 3);
                        @endphp
                        @for ($i = 0; $i < $totalSlides; $i++)
                            <button type="button" data-bs-target="#testimonialCarouselDesktop"
                                data-bs-slide-to="{{ $i }}" class="{{ $i === 0 ? 'active' : '' }}"
                                style="width:12px;height:12px;border-radius:50%;background-color:#0b5e91;border:none;margin:0 5px;opacity:{{ $i === 0 ? '1' : '0.5' }};"
                                aria-current="{{ $i === 0 ? 'true' : '' }}"
                                aria-label="Slide {{ $i + 1 }}"></button>
                        @endfor
                    </div>
                    <div class="carousel-inner p-5">
                        @php
                            $chunkedTestimonials = $testimonials->chunk(3);
                        @endphp
                        @foreach ($chunkedTestimonials as $slideIndex => $testimonialChunk)
                            <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
                                <div class="row g-4">
                                    @foreach ($testimonialChunk as $testimonial)
                                        <div class="col-lg-4" data-aos="fade-up"
                                            data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="testimonial-card-desktop h-100">
                                                <div class="card border-0 shadow-lg h-100"
                                                    style="border-radius:20px;overflow:hidden;transition:all 0.3s ease;">
                                                    <div class="card-body p-4 d-flex flex-column">
                                                        <div class="text-center mb-3">
                                                            <div class="quote-icon mx-auto"
                                                                style="width:50px;height:50px;background:linear-gradient(135deg, #0b5e91, #084b75);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                                                <i class="bi bi-quote text-white fs-4"></i></div>
                                                        </div>
                                                        <div class="flex-grow-1 d-flex flex-column">
                                                            <p class="testimonial-text text-center mb-4 flex-grow-1"
                                                                style="font-style:italic;color:#495057;line-height:1.6;font-size:15px;">
                                                                "{{ $testimonial->quote }}"</p>
                                                            <div class="text-center mt-auto">
                                                                <h6 class="fw-bold mb-1"
                                                                    style="color:#0b5e91;font-family:'Open Sans', sans-serif;">
                                                                    {{ $testimonial->name }}</h6><small
                                                                    class="text-muted">Pengguna Klik Farmasi</small>
                                                                <div class="mt-2">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i class="bi bi-star-fill"
                                                                            style="color:#ffc107;font-size:12px;"></i>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($testimonialChunk->count() < 3)
                                        @for ($i = $testimonialChunk->count(); $i < 3; $i++)
                                            <div class="col-lg-4"></div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div><button class="carousel-control-prev" type="button"
                        data-bs-target="#testimonialCarouselDesktop" data-bs-slide="prev" style="width:5%;left:-5%;">
                        <div
                            style="background-color:#0b5e91;border-radius:50%;width:50px;height:50px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(11, 94, 145, 0.3);">
                            <span class="carousel-control-prev-icon" aria-hidden="true"
                                style="width:20px;height:20px;"></span></div><span class="visually-hidden">Previous</span>
                    </button><button class="carousel-control-next" type="button"
                        data-bs-target="#testimonialCarouselDesktop" data-bs-slide="next" style="width:5%;right:-5%;">
                        <div
                            style="background-color:#0b5e91;border-radius:50%;width:50px;height:50px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(11, 94, 145, 0.3);">
                            <span class="carousel-control-next-icon" aria-hidden="true"
                                style="width:20px;height:20px;"></span></div><span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="d-lg-none">
                <div id="testimonialCarouselMobile" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="4000">
                    <div class="carousel-indicators" style="bottom:-50px;">
                        @foreach ($testimonials as $index => $testimonial)
                            <button type="button" data-bs-target="#testimonialCarouselMobile"
                                data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                style="width:12px;height:12px;border-radius:50%;background-color:#0b5e91;border:none;margin:0 5px;opacity:{{ $index === 0 ? '1' : '0.5' }};"
                                aria-current="{{ $index === 0 ? 'true' : '' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner pb-5 pt-4">
                        @foreach ($testimonials as $index => $testimonial)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="d-flex justify-content-center px-3">
                                    <div class="testimonial-card-mobile" style="max-width:500px;width:100%;">
                                        <div class="card border-0 shadow-lg" style="border-radius:20px;overflow:hidden;">
                                            <div class="card-body p-4 text-center">
                                                <div class="mb-3">
                                                    <div class="quote-icon mx-auto"
                                                        style="width:50px;height:50px;background:linear-gradient(135deg, #0b5e91, #084b75);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                                        <i class="bi bi-quote text-white fs-4"></i></div>
                                                </div>
                                                <p class="fs-6 fst-italic mb-4" style="color:#495057;line-height:1.6;">
                                                    "{{ $testimonial->quote }}"</p>
                                                <h6 class="fw-bold mb-1"
                                                    style="color:#0b5e91;font-family:'Open Sans', sans-serif;">
                                                    {{ $testimonial->name }}</h6><small class="text-muted">Pengguna Klik
                                                    Farmasi</small>
                                                <div class="mt-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star-fill"
                                                            style="color:#ffc107;font-size:12px;"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4 mb-2"><button class="carousel-control-mobile me-3"
                            type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide="prev">
                            <div
                                style="background-color:#0b5e91;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(11, 94, 145, 0.3);">
                                <span class="carousel-control-prev-icon" aria-hidden="true"
                                    style="width:20px;height:20px;"></span></div><span
                                class="visually-hidden">Previous</span>
                        </button><button class="carousel-control-mobile" type="button"
                            data-bs-target="#testimonialCarouselMobile" data-bs-slide="next">
                            <div
                                style="background-color:#0b5e91;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 15px rgba(11, 94, 145, 0.3);">
                                <span class="carousel-control-next-icon" aria-hidden="true"
                                    style="width:20px;height:20px;"></span></div><span class="visually-hidden">Next</span>
                        </button></div>
                </div>
            </div>
        </div>
    </div> --}}
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5" data-aos="zoom-in-up">
                    <div class="text-center">
                        <h2 class="fw-bolder mb-3" style="color:#0b5e91;">Artikel Hipertensi</h2>
                        <p class="lead text-muted mx-auto"
                            style="font-family:'Open Sans', sans-serif;max-width:700px;margin:0 auto;">Temukan informasi
                            kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
                        <div class="d-flex justify-content-center mt-4">
                            <div
                                style="width:80px;height:4px;background:linear-gradient(90deg, #0b5e91, #baa971);border-radius:2px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-4 gy-5">
                @forelse ($articles as $article)
                    <div class="col-lg-4 mb-lg-0" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        loading="lazy" decoding="async">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image" loading="lazy"
                                        decoding="async">
                                @endif
                                <div class="article-category"><span>{{ $article->category }}</span></div>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">{{ $article->title }}</h3>
                                <div class="article-meta">
                                    <div class="meta-item"><i
                                            class="bi bi-person-circle me-1"></i><span>{{ $article->author }}</span></div>
                                    <div class="meta-item"><i
                                            class="bi bi-calendar3 me-1"></i><span>{{ $article->published_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <p class="article-excerpt">
                                    {{ Str::words($article->content, 30, '...') }}
                                </p><a
                                    href="{{ route($article->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $article->slug) }}"
                                    class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info py-4"><i class="bi bi-info-circle me-2 fs-4"></i>
                            <p class="mb-0" style="font-family:'Open Sans', sans-serif;">Belum ada artikel yang
                                tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-5"><a href="{{ route('artikel.non-kehamilan') }}"
                    class="btn btn-khusus rounded-pill px-4 py-2" style="font-family:'Open Sans', sans-serif;">
                    Lihat Semua Artikel <i class="bi bi-arrow-right ms-2"></i></a></div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const c = document.getElementById('cleanCarousel');
            if (c) {
                new bootstrap.Carousel(c, {
                    interval: 4000,
                    wrap: true,
                    touch: true
                })
            }
            const carousels = document.querySelectorAll('.carousel');
            carousels.forEach(carousel => {
                carousel.addEventListener('mouseenter', function() {
                    bootstrap.Carousel.getInstance(this).pause()
                });
                carousel.addEventListener('mouseleave', function() {
                    bootstrap.Carousel.getInstance(this).cycle()
                })
            })
        });
    </script>
@endsection
