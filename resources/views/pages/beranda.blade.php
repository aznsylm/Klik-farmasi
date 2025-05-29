@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Header-->
    <header class="py-5 position-relative d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #0b5e91 0%, #084b75 100%); height: 600px; ">
        <div class="container px-4 px-lg-5">
            <div class="row gx-5">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-3">Selamat Datang di Klik Farmasi</h1>
                        <p class="lead fw-normal text-white-80 mb-4" style="font-family: 'Open Sans', sans-serif;">Kami siap memberikan layanan informasi kesehatan dan pengingat obat yang terbaik untuk kebutuhan Anda</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-lg px-4 me-sm-3 rounded-pill shadow-sm" href="{{ url('/artikel') }}" 
                               style="padding: 10px 25px; font-size: 16px; background-color: #baa971; border: none; transition: all 0.3s ease;">
                                <i class="bi bi-journal-text me-2"></i> Lihat Artikel
                            </a>
                            <a class="btn btn-outline-light btn-lg px-4 rounded-pill" href="{{ url('/pengingat') }}" 
                               style="padding: 10px 25px; font-size: 16px; transition: all 0.3s ease;">
                                <i class="bi bi-bell me-2"></i> Pengingat Obat
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-5 col-xxl-6 text-center mb-4 mb-xl-0">
                    <div id="headerCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner" style="height: 380px;">
                            <div class="carousel-item active">
                                <img class="img-fluid w-100 h-100" src="{{ asset('assets/sample-1.webp') }}" alt="Gambar 1" style="object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="img-fluid w-100 h-100" src="{{ asset('assets/sample-2.webp') }}" alt="Gambar 2" style="object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="img-fluid w-100 h-100" src="{{ asset('assets/sample-3.webp') }}" alt="Gambar 3" style="object-fit: cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#headerCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#headerCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#headerCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#headerCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#headerCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features section-->
    <section class="py-5" id="features" style="background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
        <div class="container px-4 px-lg-5">
            <div class="row mb-5">
                <div class="col text-center" data-aos="zoom-in-up">
                    <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Kenapa Memilih Kami?</h2>
                    <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Alasan utama mengapa platform ini bisa jadi pilihan terbaik Anda.</p>
                    <div class="d-flex justify-content-center mt-3">
                        <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;"></div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                        <div class="feature-bg-pattern"></div>
                        <div class="position-relative">
                            <div class="d-flex align-items-start mb-4">
                                <div class="feature-icon bg-danger bg-gradient rounded-circle d-flex justify-content-center align-items-center me-4 flex-shrink-0" style="width: 70px; height: 70px; box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);">
                                    <i class="bi bi-alarm text-white" style="font-size: 28px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-3" style="font-family: 'Open Sans', sans-serif; color: #2c3e50;">Pengingat Minum Obat</h4>
                                    <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.7;">
                                        Fitur pengingat minum obat kami dirancang khusus untuk membantu penderita hipertensi agar tidak melewatkan jadwal minum obat yang penting untuk kesehatan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                        <div class="feature-bg-pattern"></div>
                        <div class="position-relative">
                            <div class="d-flex align-items-start mb-4">
                                <div class="feature-icon bg-info bg-gradient rounded-circle d-flex justify-content-center align-items-center me-4 flex-shrink-0" style="width: 70px; height: 70px; box-shadow: 0 8px 25px rgba(13, 202, 240, 0.3);">
                                    <i class="bi bi-info-circle text-white" style="font-size: 28px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-3" style="font-family: 'Open Sans', sans-serif; color: #2c3e50;">Informasi Kesehatan Terpercaya</h4>
                                    <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.7;">
                                        Kami menyediakan artikel dan berita kesehatan yang akurat dan terpercaya untuk membantu Anda menjalani hidup lebih sehat dan berkualitas.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card h-100 p-4 border-0 shadow-sm rounded-4 position-relative overflow-hidden">
                        <div class="feature-bg-pattern"></div>
                        <div class="position-relative">
                            <div class="d-flex align-items-start mb-4">
                                <div class="feature-icon bg-success bg-gradient rounded-circle d-flex justify-content-center align-items-center me-4 flex-shrink-0" style="width: 70px; height: 70px; box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);">
                                    <i class="bi bi-calendar-check text-white" style="font-size: 28px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-3" style="font-family: 'Open Sans', sans-serif; color: #2c3e50;">Manajemen Jadwal</h4>
                                    <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.7;">
                                        Atur jadwal minum obat Anda dengan mudah menggunakan fitur kalender yang terintegrasi di platform kami dengan interface yang user-friendly.
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
                                <div class="feature-icon bg-primary bg-gradient rounded-circle d-flex justify-content-center align-items-center me-4 flex-shrink-0" style="width: 70px; height: 70px; box-shadow: 0 8px 25px rgba(13, 110, 253, 0.3);">
                                    <i class="bi bi-people text-white" style="font-size: 28px;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h4 class="fw-bold mb-3" style="font-family: 'Open Sans', sans-serif; color: #2c3e50;">Komunitas Pendukung</h4>
                                    <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.7;">
                                        Bergabunglah dengan komunitas kami untuk berbagi pengalaman dan mendapatkan dukungan dari sesama penderita hipertensi dalam perjalanan hidup sehat.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <div class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6" data-aos="zoom-in-up">
                    <div class="text-center mb-5">
                        <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Apa Kata Mereka?</h2>
                        <p class="lead text-muted" style="font-family: 'Open Sans', sans-serif;">Pendapat pengguna tentang Klik Farmasi dari berbagai kalangan.</p>
                        <div class="d-flex justify-content-center mb-4">
                            <div style="width: 60px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop View - Auto-sliding Cards -->
            <div class="d-none d-lg-block">
                <div id="testimonialCarouselDesktop" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <!-- Indicators -->
                    <div class="carousel-indicators position-relative mb-4" style="position: relative; bottom: auto; margin-bottom: 2rem;">
                        @php
                            $totalSlides = ceil($testimonials->count() / 3);
                        @endphp
                        @for ($i = 0; $i < $totalSlides; $i++)
                            <button type="button" data-bs-target="#testimonialCarouselDesktop" data-bs-slide-to="{{ $i }}" 
                                    class="{{ $i === 0 ? 'active' : '' }}" 
                                    style="width: 12px; height: 12px; border-radius: 50%; background-color: #0b5e91; border: none; margin: 0 5px; opacity: {{ $i === 0 ? '1' : '0.5' }};"
                                    aria-current="{{ $i === 0 ? 'true' : '' }}" 
                                    aria-label="Slide {{ $i + 1 }}">
                            </button>
                        @endfor
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner p-5">
                        @php
                            $chunkedTestimonials = $testimonials->chunk(3);
                        @endphp
                        @foreach ($chunkedTestimonials as $slideIndex => $testimonialChunk)
                            <div class="carousel-item {{ $slideIndex === 0 ? 'active' : '' }}">
                                <div class="row g-4">
                                    @foreach ($testimonialChunk as $testimonial)
                                        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="testimonial-card-desktop h-100">
                                                <div class="card border-0 shadow-lg h-100" style="border-radius: 20px; overflow: hidden; transition: all 0.3s ease;">
                                                    <div class="card-body p-4 d-flex flex-column">
                                                        <!-- Quote Icon -->
                                                        <div class="text-center mb-3">
                                                            <div class="quote-icon mx-auto" style="width: 50px; height: 50px; background: linear-gradient(135deg, #0b5e91, #084b75); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                                <i class="bi bi-quote text-white fs-4"></i>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Testimonial Content -->
                                                        <div class="flex-grow-1 d-flex flex-column">
                                                            <p class="testimonial-text text-center mb-4 flex-grow-1" style="font-style: italic; color: #495057; line-height: 1.6; font-size: 15px;">"{{ $testimonial->quote }}"</p>
                                                            
                                                            <!-- User Info -->
                                                            <div class="text-center mt-auto">
                                                                <h6 class="fw-bold mb-1" style="color: #0b5e91; font-family: 'Open Sans', sans-serif;">{{ $testimonial->name }}</h6>
                                                                <small class="text-muted">Pengguna Klik Farmasi</small>
                                                                
                                                                <!-- Rating Stars -->
                                                                <div class="mt-2">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i class="bi bi-star-fill" style="color: #ffc107; font-size: 12px;"></i>
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
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarouselDesktop" data-bs-slide="prev" style="width: 5%; left: -5%;">
                        <div style="background-color: #0b5e91; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(11, 94, 145, 0.3);">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                        </div>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarouselDesktop" data-bs-slide="next" style="width: 5%; right: -5%;">
                        <div style="background-color: #0b5e91; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(11, 94, 145, 0.3);">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                        </div>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Mobile/Tablet View - Single Card Carousel -->
            <div class="d-lg-none">
                <div id="testimonialCarouselMobile" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <!-- Indicators -->
                    <div class="carousel-indicators" style="bottom: -50px;">
                        @foreach ($testimonials as $index => $testimonial)
                            <button type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index === 0 ? 'active' : '' }}" 
                                    style="width: 12px; height: 12px; border-radius: 50%; background-color: #0b5e91; border: none; margin: 0 5px; opacity: {{ $index === 0 ? '1' : '0.5' }};"
                                    aria-current="{{ $index === 0 ? 'true' : '' }}" 
                                    aria-label="Slide {{ $index + 1 }}">
                            </button>
                        @endforeach
                    </div>

                    <!-- Slides -->
                    <div class="carousel-inner pb-5 pt-4">
                        @foreach ($testimonials as $index => $testimonial)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="d-flex justify-content-center px-3">
                                    <div class="testimonial-card-mobile" style="max-width: 500px; width: 100%;">
                                        <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                                            <div class="card-body p-4 text-center">
                                                <!-- Quote Icon -->
                                                <div class="mb-3">
                                                    <div class="quote-icon mx-auto" style="width: 50px; height: 50px; background: linear-gradient(135deg, #0b5e91, #084b75); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                        <i class="bi bi-quote text-white fs-4"></i>
                                                    </div>
                                                </div>
                                                
                                                <!-- Testimonial Content -->
                                                <p class="fs-6 fst-italic mb-4" style="color: #495057; line-height: 1.6;">"{{ $testimonial->quote }}"</p>
                                                
                                                <!-- User Info -->
                                                <h6 class="fw-bold mb-1" style="color: #0b5e91; font-family: 'Open Sans', sans-serif;">{{ $testimonial->name }}</h6>
                                                <small class="text-muted">Pengguna Klik Farmasi</small>
                                                
                                                <!-- Rating Stars -->
                                                <div class="mt-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star-fill" style="color: #ffc107; font-size: 12px;"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide="prev" style="width: 5%; left: -5%;">
                        <div style="background-color: #0b5e91; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(11, 94, 145, 0.3);">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                        </div>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide="next" style="width: 5%; right: -5%;">
                        <div style="background-color: #0b5e91; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(11, 94, 145, 0.3);">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="width: 20px; height: 20px;"></span>
                        </div>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Preview Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5" data-aos="zoom-in-up">
                    <div class="text-center">
                        <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Artikel Hipertensi</h2>
                        <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
                        <div class="d-flex justify-content-center mt-4">
                            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;"></div>
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
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image">
                                @endif
                                <div class="article-category">
                                    <span>{{ $article->category }}</span>
                                </div>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">{{ $article->title }}</h3>
                                <div class="article-meta">
                                    <div class="meta-item">
                                        <i class="bi bi-person-circle me-1"></i>
                                        <span>{{ $article->author }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        <span>{{ $article->published_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <p class="article-excerpt">
                                    {{ Str::words($article->summary, 15, '...') }}
                                </p>
                                <a href="{{ route('artikel.detail', $article->slug) }}" class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info py-4">
                            <i class="bi bi-info-circle me-2 fs-4"></i>
                            <p class="mb-0" style="font-family: 'Open Sans', sans-serif;">Belum ada artikel yang tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>
    
            <!-- Link Artikel Lainnya -->
            <div class="text-center mt-5">
                <a href="{{ route('artikel') }}" class="btn btn-khusus rounded-pill px-4 py-2" style="font-family: 'Open Sans', sans-serif;">
                    Lihat Semua Artikel <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>
    
    <style>
        .feature-card {
            background: #ffffff;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0,0,0,0.05);
        }
    
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
        }
    
        .feature-bg-pattern {
            position: absolute;
            top: -50px;
            right: -50px;
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, rgba(11, 94, 145, 0.03), rgba(186, 169, 113, 0.03));
            border-radius: 50%;
        }
    
        .feature-icon {
            transition: all 0.3s ease;
        }
    
        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }
        .testimonial-card-desktop .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
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
        
        @media (max-width: 767px) {
            .carousel-control-prev,
            .carousel-control-next {
                opacity: 0.7;
            }
            
            .carousel-control-prev:hover,
            .carousel-control-next:hover {
                opacity: 1;
            }
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
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced indicator functionality for desktop carousel
            const desktopCarousel = document.getElementById('testimonialCarouselDesktop');
            const mobileCarousel = document.getElementById('testimonialCarouselMobile');
            
            if (desktopCarousel) {
                const desktopIndicators = desktopCarousel.querySelectorAll('.carousel-indicators button');
                const desktopCarouselInstance = new bootstrap.Carousel(desktopCarousel, {
                    interval: 4000,
                    wrap: true,
                    touch: true
                });
                
                // Update indicator opacity on slide change
                desktopCarousel.addEventListener('slide.bs.carousel', function(e) {
                    desktopIndicators.forEach((indicator, index) => {
                        indicator.style.opacity = index === e.to ? '1' : '0.5';
                        indicator.style.transform = index === e.to ? 'scale(1.3)' : 'scale(1)';
                    });
                });
            }
            
            if (mobileCarousel) {
                const mobileIndicators = mobileCarousel.querySelectorAll('.carousel-indicators button');
                const mobileCarouselInstance = new bootstrap.Carousel(mobileCarousel, {
                    interval: 4000,
                    wrap: true,
                    touch: true
                });
                
                // Update indicator opacity on slide change
                mobileCarousel.addEventListener('slide.bs.carousel', function(e) {
                    mobileIndicators.forEach((indicator, index) => {
                        indicator.style.opacity = index === e.to ? '1' : '0.5';
                        indicator.style.transform = index === e.to ? 'scale(1.3)' : 'scale(1)';
                    });
                });
            }
            
            // Pause carousel on hover
            const carousels = document.querySelectorAll('.carousel');
            carousels.forEach(carousel => {
                carousel.addEventListener('mouseenter', function() {
                    bootstrap.Carousel.getInstance(this).pause();
                });
                
                carousel.addEventListener('mouseleave', function() {
                    bootstrap.Carousel.getInstance(this).cycle();
                });
            });
        });
    </script>
@endsection
