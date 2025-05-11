@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <!-- Header-->
    <header class="py-5" style="background: #0b5e91;">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">Selamat Datang di Klik Farmasi</h1>
                        <h4 class="fw-normal  mb-4" style="font-family: 'Open Sans', sans-serif; color: #fff;">Platform untuk informasi kesehatan dan pengingat obat Anda.</h4>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-khusus btn-lg px-4 me-sm-2" href="{{ url('/artikel') }}" style="background: #baa971; color: #ffffff; border-color: #ffffff; transition: all 0.3s ease;">
                                Lihat Artikel
                            </a>
                            <a class="btn btn-khusus btn-lg px-4" href="{{ url('/pengingat') }}" style="background: #baa971; color: #ffffff; border-color: #ffffff; transition: all 0.3s ease;">
                                Pengingat Obat
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <img class="img-fluid rounded-3 my-5" src="{{ asset('assets/sample-1.jpg') }}" alt="..." style="width: 600px; height: 400px; object-fit: cover;" />
                </div>
            </div>
        </div>
    </header>

    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-4 px-lg-5">
            <div class="row mb-5">
                <div class="col text-center">
                    <h2 class="fw-bolder">Kenapa Memilih Kami?</h2>
                    <p class="text-muted" style="font-family: 'Open Sans', sans-serif; font-size: 15px;">Alasan utama mengapa platform ini bisa jadi pilihan terbaik Anda.</p>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col" data-aos="fade-up">
                    <div class="card bg-light h-100 border-0 shadow-sm p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-danger text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-alarm fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Pengingat Minum Obat</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 14.5px;">
                            Fitur pengingat minum obat kami dirancang khusus untuk membantu penderita hipertensi agar tidak melewatkan jadwal minum obat.
                        </p>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card bg-light h-100 border-0 shadow-sm p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-info text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-info-circle fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Informasi Kesehatan Terpercaya</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 14.5px;">
                            Kami menyediakan artikel dan berita kesehatan yang akurat dan terpercaya untuk membantu Anda menjalani hidup lebih sehat.
                        </p>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card bg-light h-100 border-0 shadow-sm p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-success text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-calendar-check fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Manajemen Jadwal</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 14.5px;">
                            Atur jadwal minum obat Anda dengan mudah menggunakan fitur kalender yang terintegrasi di platform kami.
                        </p>
                    </div>
                </div>
                <div class="col" data-aos="fade-up">
                    <div class="card bg-light h-100 border-0 shadow-sm p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-wrapper bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                                <i class="bi bi-people fs-4"></i>
                            </div>
                            <h5 class="mb-0" style="font-family: 'Open Sans', sans-serif; font-weight: 700;">Komunitas Pendukung</h5>
                        </div>
                        <p class="text-muted mb-0" style="font-family: 'Open Sans', sans-serif; font-size: 14.5px;">
                            Bergabunglah dengan komunitas kami untuk berbagi pengalaman dan mendapatkan dukungan dari sesama penderita hipertensi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <!-- Testimonial Section -->
    <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Apa Kata Mereka?</h2>
                        <p class="text-muted">Pendapat pengguna tentang Klik Farmasi.</p>
                    </div>
                </div>
            </div>
    
            <!-- Carousel -->
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
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
                                <div class="card border-0 shadow-sm my-3" style="max-width: 600px;">
                                    <div class="card-body">
                                        <p class="fs-5 fst-italic text-center">"{{ $testimonial->quote }}"</p>
                                        <div class="text-end fw-bold" style="color: #0b5e91; font-family: 'Open Sans', sans-serif;">{{ $testimonial->name }}</div>
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
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5">
                    <div class="text-center">
                        <h2 class="fw-bolder">Artikel Hipertensi</h2>
                        <h4 class="text-muted" style="font-family: 'Open Sans', sans-serif; font-size: 15px;">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</h4>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @forelse ($articles as $article)
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0 bg-light article-card">
                            <!-- Gambar Artikel -->
                            @if ($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/default-image.jpg') }}" alt="Default Image" class="card-img-top" style="height: 200px; object-fit: cover;">
                            @endif
    
                            <div class="card-body p-4">
                                <!-- Kategori -->
                                <div class="badge bg-secondary bg-gradient rounded-pill mb-2" style="font-family: 'Open Sans', sans-serif;">
                                    {{ $article->category }}
                                </div>
    
                                <!-- Judul -->
                                <h5 class="card-title mb-3" style="font-family: 'Open Sans', sans-serif; color: #0b5e91; font-weight: bold;">
                                    {{ $article->title }}
                                </h5>
    
                                <!-- Narasi Singkat -->
                                <p class="card-text mb-3" style="font-family: 'Open Sans', sans-serif; color: #6c757d;">
                                    {{ Str::words($article->summary, 20, '...') }}
                                </p>
    
                                <!-- Penulis -->
                                <p class="text-muted small mb-3" style="font-family: 'Open Sans', sans-serif; font-style: italic;">
                                    Oleh {{ $article->author }} - {{ $article->published_at->format('d M Y') }}
                                </p>
    
                                <!-- Tombol Baca Selengkapnya -->
                                <a href="{{ route('artikel.detail', $article->id) }}" class="btn btn-khusus baca-selengkapnya-btn">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted" style="font-family: 'Open Sans', sans-serif;">Belum ada artikel yang tersedia.</p>
                @endforelse
            </div>
    
            <!-- Link Artikel Lainnya -->
            <div class="text-end mt-4">
                <a href="{{ route('artikel') }}" class="btn btn-link text-decoration-none" style="font-family: 'Open Sans', sans-serif; color: #0b5e91;">
                    Artikel Lainnya <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

<style>
    .carousel-indicators button {
        background-color: #0b5e91;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: none;
    }
    
    .carousel-indicators .active {
        background-color: #baa971;
    }
</style>
