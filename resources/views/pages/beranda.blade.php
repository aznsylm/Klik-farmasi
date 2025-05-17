@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Header-->
    <header class="py-5 position-relative" style="background: linear-gradient(135deg, #0b5e91 0%, #084b75 100%);">
        <div class="container px-4 px-lg-5">
            <div class="row gx-5 align-items-center justify-content-center">
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
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <div id="headerCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner" style="height: 380px;">
                            <div class="carousel-item active">
                                <img class="img-fluid w-100 h-100" src="{{ asset('assets/sample-1.jpg') }}" alt="Gambar 1" style="object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="img-fluid w-100 h-100" src="{{ asset('assets/sample-2.jpg') }}" alt="Gambar 2" style="object-fit: cover;">
                            </div>
                            <div class="carousel-item">
                                <img class="img-fluid w-100 h-100" src="{{ asset('assets/sample-3.jpg') }}" alt="Gambar 3" style="object-fit: cover;">
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
    <section class="py-5" id="features">
        <div class="container px-4 px-lg-5">
            <div class="row mb-5">
                <div class="col text-center" data-aos="zoom-in-up">
                    <h2 class="fw-bolder mb-3">Kenapa Memilih Kami?</h2>
                    <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Alasan utama mengapa platform ini bisa jadi pilihan terbaik Anda.</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col" data-aos="fade-right">
                    <div class="card h-100 border-0 shadow-sm p-4 feature-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-danger text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 56px; height: 56px;">
                                <i class="bi bi-alarm fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Pengingat Minum Obat</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.6;">
                            Fitur pengingat minum obat kami dirancang khusus untuk membantu penderita hipertensi agar tidak melewatkan jadwal minum obat.
                        </p>
                    </div>
                </div>
                <div class="col" data-aos="fade-right">
                    <div class="card h-100 border-0 shadow-sm p-4 feature-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-info text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 56px; height: 56px;">
                                <i class="bi bi-info-circle fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Informasi Kesehatan Terpercaya</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.6;">
                            Kami menyediakan artikel dan berita kesehatan yang akurat dan terpercaya untuk membantu Anda menjalani hidup lebih sehat.
                        </p>
                    </div>
                </div>
                <div class="col" data-aos="fade-left">
                    <div class="card h-100 border-0 shadow-sm p-4 feature-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-success text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 56px; height: 56px;">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Manajemen Jadwal</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.6;">
                            Atur jadwal minum obat Anda dengan mudah menggunakan fitur kalender yang terintegrasi di platform kami.
                        </p>
                    </div>
                </div>
                <div class="col" data-aos="fade-left">
                    <div class="card h-100 border-0 shadow-sm p-4 feature-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 56px; height: 56px;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Komunitas Pendukung</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.6;">
                            Bergabunglah dengan komunitas kami untuk berbagi pengalaman dan mendapatkan dukungan dari sesama penderita hipertensi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <!-- Testimonial Section -->
    <div class="py-3" style="background-color: #f8f9fa;">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6" data-aos="zoom-in-up">
                    <div class="text-center mb-5">
                        <h2 class="fw-bolder mb-3">Apa Kata Mereka?</h2>
                        <p class="lead text-muted" style="font-family: 'Open Sans', sans-serif;">Pendapat pengguna tentang Klik Farmasi.</p>
                    </div>
                </div>
            </div>
    
            <!-- Carousel -->
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($testimonials as $index => $testimonial)
                        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
    
                <!-- Slides -->
                <div class="carousel-inner">
                    @foreach ($testimonials as $index => $testimonial)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="d-flex justify-content-center">
                                <div class="card border-0 shadow my-4 testimonial-card" style="max-width: 700px;">
                                    <div class="card-body p-4 p-md-5">
                                        <div class="text-center mb-3">
                                            <i class="bi bi-quote fs-1" style="color: #0b5e91;"></i>
                                        </div>
                                        <p class="fs-5 fst-italic text-center mb-4">"{{ $testimonial->quote }}"</p>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="avatar bg-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                                <span class="text-white fw-bold">{{ substr($testimonial->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-0" style="color: #0b5e91; font-family: 'Open Sans', sans-serif;">{{ $testimonial->name }}</h6>
                                                <small class="text-muted">Pengguna Klik Farmasi</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
    
                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Blog Preview Section -->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5" data-aos="zoom-in-up">
                    <div class="text-center">
                        <h2 class="fw-bolder mb-3">Artikel Hipertensi</h2>
                        <p class="lead text-muted" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
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
@endsection