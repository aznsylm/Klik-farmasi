@extends('layouts.app')
@section('title', 'Beranda - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Platform kesehatan digital untuk manajemen hipertensi. Dapatkan pengingat minum obat, artikel kesehatan terpercaya, dan konsultasi gratis dari Universitas Alma Ata.">
    <meta name="keywords"
        content="hipertensi, pengingat obat, kesehatan, farmasi, universitas alma ata, manajemen hipertensi, artikel kesehatan">
    <meta name="author" content="Klik Farmasi - Universitas Alma Ata">

    <!-- Preload critical carousel image for LCP optimization -->
    <link rel="preload" as="image" href="{{ asset('assets/Slideketiga.webp') }}" fetchpriority="high">
    <!-- Preload critical CSS -->
    <link rel="preload" as="style" href="{{ asset('css/main.css') }}">
@endpush

@section('content')

    <header class="revolutionary-hero-section position-relative overflow-hidden">
        <div class="hero-background-new">
            <div class="hero-overlay-new"></div>
        </div>
        <div class="container-fluid px-0 position-relative">
            <div class="hero-visual-section" data-aos="fade-down">
                <div class="container-fluid px-2 py-5 px-lg-4">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-4" data-aos="fade-up">
                            <h1 class="display-4 text-white mb-3 fw-bold">Selamat Datang di Klik-Farmasi</h1>
                            <p class="lead text-white">Kami siap memberikan layanan informasi kesehatan dan pengingat
                                minum obat terbaik untuk kebutuhan anda</p>
                            <div class="section-divider mx-auto" style="background: white;"></div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-11 col-xl-10">
                            <div class="clean-carousel-wrapper">
                                <div id="cleanCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="6000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="ratio ratio-21x9">
                                                <img src="{{ asset('assets/pencegahan.webp') }}"
                                                    alt="Infografis pencegahan hipertensi dan tips kesehatan jantung"
                                                    class="object-fit-cover rounded" loading="eager" fetchpriority="high"
                                                    decoding="async" width="1200" height="600">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="ratio ratio-21x9">
                                                <img src="{{ asset('assets/prevalensi.webp') }}"
                                                    alt="Data prevalensi hipertensi di Indonesia dan statistik kesehatan"
                                                    class="object-fit-cover rounded" loading="lazy" decoding="async"
                                                    width="1200" height="600">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="ratio ratio-21x9">
                                                <img src="{{ asset('assets/welcome-hero.webp') }}"
                                                    alt="Selamat datang di platform Klik Farmasi untuk konsultasi kesehatan online"
                                                    class="object-fit-cover rounded" loading="lazy" decoding="async"
                                                    width="1200" height="600">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clean-carousel-controls"><button
                                            class="carousel-control-prev btn btn-primary" type="button"
                                            data-bs-target="#cleanCarousel" data-bs-slide="prev"
                                            aria-label="Slide sebelumnya"><span class="carousel-control-prev-icon"
                                                aria-hidden="true"></span></button><button
                                            class="carousel-control-next btn btn-primary" type="button"
                                            data-bs-target="#cleanCarousel" data-bs-slide="next"
                                            aria-label="Slide selanjutnya"><span class="carousel-control-next-icon"
                                                aria-hidden="true"></span></button>
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
                <h2 class="fw-bolder mb-3 text-primary">Kenapa Memilih Kami?</h2>
                <p class="lead text-muted mx-auto">Alasan utama mengapa platform ini bisa jadi pilihan terbaik Anda untuk
                    kesehatan yang lebih baik</p>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="features-grid">
                <div class="row g-4 g-md-4 g-sm-3">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="enhanced-feature-card reminder-card">
                            <div>
                                <div class="feature-icon-wrapper">
                                    <div
                                        class="feature-icon reminder-icon bg-success bg-gradient rounded-circle d-flex mb-3">
                                        <i class="bi bi-alarm-fill"></i>
                                    </div>
                                    <div class="icon-glow"></div>
                                </div>
                            </div>
                            <div class="feature-card-body">
                                <h4 class="feature-title">Pengingat Minum Obat (In Progress)</h4>
                                <p class="feature-description">
                                    Fitur Pengingat Minum Obat ini dirancang khusus untuk membantu anda rutin dalam minum
                                    obat, terutama bagi penderita hipertensi agar tidak melewatkan jadwal minum obat yang
                                    penting untuk Kesehatan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="enhanced-feature-card info-card">
                            <div>
                                <div class="feature-icon-wrapper">
                                    <div class="feature-icon info-icon bg-success bg-gradient rounded-circle d-flex mb-3">
                                        <i class="bi bi-journal-medical"></i>
                                    </div>
                                    <div class="icon-glow"></div>
                                </div>
                            </div>
                            <div class="feature-card-body">
                                <h4 class="feature-title">Informasi Kesehatan Terpercaya</h4>
                                <p class="feature-description">
                                    Kami menyediakan artikel dan berita kesehatan terkini yang akurat serta informasi
                                    langsung dari sumber terpercaya untuk membantu anda menjalani hidup lebih sehat.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="enhanced-feature-card info-card">
                            <div>
                                <div class="feature-icon-wrapper">
                                    <div class="feature-icon info-icon bg-success bg-gradient rounded-circle d-flex mb-3">
                                        <i class="bi bi-calendar-check text-white" style="font-size:28px;"></i>
                                    </div>
                                    <div class="icon-glow"></div>
                                </div>
                            </div>
                            <div class="feature-card-body">
                                <h4 class="feature-title">Jadwal pengingat minum obat</h4>
                                <p class="feature-description">
                                    Kelola jadwal minum obat anda dengan mudah! Cukup input waktu minum obat sekali dan kami
                                    akan mengingatkan anda secara otomatis. Dapatkan informasi pengingat tepat waktu dan
                                    pantau semua jadwal obat anda, membuat hidup sehat jadi lebih mudah dan menyenangkan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="enhanced-feature-card info-card">
                            <div>
                                <div class="feature-icon-wrapper">
                                    <div class="feature-icon info-icon bg-success bg-gradient rounded-circle d-flex mb-3">
                                        <i class="bi bi-people text-white" style="font-size:28px;"></i>
                                    </div>
                                    <div class="icon-glow"></div>
                                </div>
                            </div>
                            <div class="feature-card-body">
                                <h4 class="feature-title">Komunitas Pendukung</h4>
                                <p class="feature-description">
                                    Tidak harus menghadapi semua sendiri. Bergabunglah dengan komunitas ini, Anda bisa
                                    terhubung dengan sesama pengguna untuk saling berbagi pengalaman, motivasi, dan dukungan
                                    positif selama menjalani pengobatan. Bersama, kita wujudkan hidup yang lebih sehat dan
                                    penuh semangat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <section class="py-5 testimonial-section">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6" data-aos="zoom-in-up">
                    <div class="text-center mb-5">
                        <h2 class="fw-bolder mb-3 text-primary">Apa Kata Mereka?</h2>
                        <p class="lead text-muted mx-auto">Pendapat pengguna tentang Klik Farmasi dari berbagai kalangan.</p>
                        <div class="section-divider mx-auto"></div>
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block">
                <div id="testimonialCarouselDesktop" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="4000">
                    <div class="carousel-indicators testimonial-indicators position-relative mb-4" style="position:relative;bottom:auto;margin-bottom:2rem;">
                        @php
                            $totalSlides = ceil($testimonials->count() / 3);
                        @endphp
                        @for ($i = 0; $i < $totalSlides; $i++)
                            <button type="button" data-bs-target="#testimonialCarouselDesktop" data-bs-slide-to="{{ $i }}" 
                                class="{{ $i === 0 ? 'active' : '' }}" aria-current="{{ $i === 0 ? 'true' : '' }}" 
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
                                                            <div class="quote-icon">
                                                                <i class="bi bi-quote text-white fs-4"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 d-flex flex-column">
                                                            <p class="testimonial-text">"{{ $testimonial->quote }}"</p>
                                                            <div class="text-center mt-auto">
                                                                <h6 class="testimonial-author">{{ $testimonial->name }}</h6>
                                                                <small class="testimonial-role">Pengguna Klik Farmasi</small>
                                                                <div class="testimonial-stars">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <i class="bi bi-star-fill"></i>
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
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarouselDesktop" data-bs-slide="prev" style="width:5%;left:-5%;">
                        <div class="testimonial-carousel-controls">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </div>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarouselDesktop" data-bs-slide="next" style="width:5%;right:-5%;">
                        <div class="testimonial-carousel-controls">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </div>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="d-lg-none">
                <div id="testimonialCarouselMobile" class="carousel slide" data-bs-ride="carousel"
                    data-bs-interval="4000">
                    <div class="carousel-indicators testimonial-indicators" style="bottom:-50px;">
                        @foreach ($testimonials as $index => $testimonial)
                            <button type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide-to="{{ $index }}" 
                                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : '' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner pb-5 pt-4">
                        @foreach ($testimonials as $index => $testimonial)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <div class="d-flex justify-content-center px-3">
                                    <div class="testimonial-card-mobile" style="max-width:500px;width:100%;">
                                        <div class="card border-0 shadow-lg">
                                            <div class="card-body p-4 text-center">
                                                <div class="mb-3">
                                                    <div class="quote-icon">
                                                        <i class="bi bi-quote text-white fs-4"></i>
                                                    </div>
                                                </div>
                                                <p class="testimonial-text">"{{ $testimonial->quote }}"</p>
                                                <h6 class="testimonial-author">{{ $testimonial->name }}</h6>
                                                <small class="testimonial-role">Pengguna Klik Farmasi</small>
                                                <div class="testimonial-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star-fill"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-4 mb-2">
                        <button class="carousel-control-mobile me-3" type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide="prev">
                            <div class="testimonial-carousel-controls" style="width:40px;height:40px;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </div>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-mobile" type="button" data-bs-target="#testimonialCarouselMobile" data-bs-slide="next">
                            <div class="testimonial-carousel-controls" style="width:40px;height:40px;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </div>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5" data-aos="zoom-in-up">
                    <div class="text-center">
                        <h2 class="fw-bolder mb-3 text-primary">Artikel Hipertensi</h2>
                        <p class="lead text-muted mx-auto">Temukan
                            informasi
                            kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
                        <div class="d-flex justify-content-center mt-4">
                            <div class="section-divider"></div>
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
                                        loading="lazy" decoding="async" width="400" height="220">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image" loading="lazy"
                                        decoding="async" width="400" height="220">
                                @endif
                                <div class="article-category"><span>{{ $article->category }}</span></div>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">{{ $article->title }}</h3>
                                <div class="article-meta">
                                    <div class="meta-item"><i
                                            class="bi bi-person-circle me-1"></i><span>{{ $article->author }}</span>
                                    </div>
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
                    class="btn btn-khusus rounded-pill px-4 py-2">
                    Lihat Semua Artikel <i class="bi bi-arrow-right ms-2"></i></a></div>
        </div>
    </section>

@endsection


