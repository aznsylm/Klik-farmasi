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
    <!-- Mobile Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('css/mobile-responsive.css') }}">
@endpush

@section('content')

    <header class="revolutionary-hero-section position-relative overflow-hidden">
        <div class="hero-background-new">
            <div class="hero-overlay-new"></div>
        </div>
        <div class="container-fluid px-0 position-relative">
            <div class="hero-visual-section" data-aos="fade-down">
                <div class="container-fluid px-2 py-1 py-md-5 px-lg-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-6 order-2 order-lg-1 mt-2 mt-lg-0" data-aos="fade-right">
                            <div class="hero-content px-3">
                                <h1 class="h2 fw-bold mb-3 text-white">Tekanan Darah Tinggi Mengancam? Jangan Biarkan Obat Terlupakan!
                                </h1>
                                <p class="mb-4 text-light">Setiap 30 detik, seseorang meninggal karena hipertensi yang tidak
                                    terkontrol. Jangan jadi korban selanjutnya! Platform revolusioner ini akan memastikan
                                    Anda tidak pernah melewatkan obat lagi.</p>
                                <div
                                    class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                                    <a href="{{ route('pengingat') }}"
                                        class="btn btn-warning px-4 py-2 rounded-pill fw-bold">
                                        Mulai Pengingat Obat
                                    </a>
                                    <a href="{{ route('artikel.non-kehamilan') }}"
                                        class="btn btn-light px-4 py-2 rounded-pill fw-bold">
                                        Baca Artikel
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 order-1 order-lg-2">
                            <div class="clean-carousel-wrapper">
                                <div id="cleanCarousel" class="carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="6000">
                                    <div class="carousel-inner">
                                        <div class="carousel-item">
                                            <div class="ratio" style="--bs-aspect-ratio: 66.67%;">
                                                <img data-src="{{ asset('assets/prevalensi.webp') }}"
                                                    alt="Data prevalensi hipertensi di Indonesia dan statistik kesehatan"
                                                    class="object-fit-cover rounded carousel-img" loading="lazy"
                                                    decoding="async" width="800" height="533" style="cursor: pointer;">
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div class="ratio" style="--bs-aspect-ratio: 66.67%;">
                                                <img data-src="{{ asset('assets/pencegahan.webp') }}"
                                                    alt="Infografis pencegahan hipertensi dan tips kesehatan jantung"
                                                    class="object-fit-cover rounded carousel-img" loading="lazy"
                                                    decoding="async" width="800" height="533" style="cursor: pointer;">
                                            </div>
                                        </div>
                                        <div class="carousel-item active">
                                            <div class="ratio" style="--bs-aspect-ratio: 66.67%;">
                                                <img src="{{ asset('assets/welcome-hero.webp') }}"
                                                    alt="Selamat datang di platform Klik Farmasi untuk konsultasi kesehatan online"
                                                    class="object-fit-cover rounded carousel-img" loading="eager"
                                                    fetchpriority="high" decoding="async" width="800" height="533"
                                                    style="cursor: pointer;">
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

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0 text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal" style="z-index: 1050;"></button>
                    <img id="modalImage" src="" alt="" class="img-fluid rounded"
                        style="max-height: 90vh;">
                </div>
            </div>
        </div>
    </div>

    <section class="features-section py-5" id="features">
        <div class="container px-4 px-lg-5">
            <div class="features-header text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bolder mb-3 text-primary">Hidup Anda Berharga - Lindungi Sekarang!</h2>
                <p class="lead text-muted mx-auto">Setiap penderita hipertensi berhak mendapat perawatan terbaik. Saatnya
                    Anda mengambil kendali!</p>
                <div class="section-divider mx-auto"></div>
            </div>
            <div class="features-grid">
                <div class="row g-4">
                    <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card h-100 border-0 shadow-sm"
                            style="border-radius: 15px; background-color: #E3F2FD;">
                            <div class="card-body p-4 text-center">
                                <h4 class="card-title fw-bold text-primary mb-3">Pengingat Minum Obat</h4>
                                <p class="card-text text-muted text-center">
                                    Jangan biarkan obat terlewat! Dapatkan pengingat otomatis via WhatsApp setiap hari.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="card h-100 border-0 shadow-sm"
                            style="border-radius: 15px; background-color: #E3F2FD;">
                            <div class="card-body p-4 text-center">
                                <h4 class="card-title fw-bold text-primary mb-3">Monitoring Tekanan Darah</h4>
                                <p class="card-text text-muted text-center">
                                    Pantau tekanan darah harian Anda dengan grafik yang mudah dipahami.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="card h-100 border-0 shadow-sm"
                            style="border-radius: 15px; background-color: #E3F2FD;">
                            <div class="card-body p-4 text-center">
                                <h4 class="card-title fw-bold text-primary mb-3">Konsultasi Tenaga Kesehatan</h4>
                                <p class="card-text text-muted text-center">
                                    Tanyakan langsung kepada ahli kesehatan tentang kondisi hipertensi Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="card h-100 border-0 shadow-sm"
                            style="border-radius: 15px; background-color: #E3F2FD;">
                            <div class="card-body p-4 text-center">
                                <h4 class="card-title fw-bold text-primary mb-3">Edukasi Kesehatan Lengkap</h4>
                                <p class="card-text text-muted text-center">
                                    Akses artikel, berita terkini, FAQ, dan poster edukasi untuk hidup lebih sehat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 testimonial-section overflow-hidden">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5" data-aos="fade-up">
                    <h2 class="fw-bolder mb-3 text-primary">Mereka Sudah Merasakan Manfaatnya!</h2>
                    <p class="lead text-muted">Testimoni nyata dari sesama penderita hipertensi yang telah merasakan
                        perubahan positif</p>
                    <div class="section-divider mx-auto"></div>
                </div>
            </div>

            <!-- Multi-Row Marquee Testimonials -->
            <div class="testimonial-marquee-container">
                @php
                    $testimonialRows = $testimonials->chunk(ceil($testimonials->count() / 3));
                @endphp

                @foreach ($testimonialRows as $rowIndex => $row)
                    <div class="testimonial-marquee-row" data-direction="{{ $rowIndex % 2 === 0 ? 'left' : 'right' }}"
                        data-speed="{{ 50 }}">
                        <div class="testimonial-marquee-track">
                            @for ($i = 0; $i < 5; $i++)
                                @foreach ($row as $testimonial)
                                    <div class="testimonial-marquee-item" style="margin-right: 20px;">
                                        <div class="testimonial-bubble">
                                            <div class="testimonial-content">
                                                <div class="testimonial-quote">{!! $testimonial->quote !!}</div>
                                                <div class="testimonial-author">
                                                    <strong>{{ $testimonial->name }}</strong>
                                                    <div class="testimonial-stars">
                                                        @for ($j = 1; $j <= 5; $j++)
                                                            <i class="bi bi-star-fill"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endfor
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-5">
                <a href="{{ route('pengingat') }}" class="btn btn-primary btn-lg px-5 py-3">
                    Mulai Sekarang!
                </a>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5" data-aos="zoom-in-up">
                    <div class="text-center">
                        <h2 class="fw-bolder mb-3 text-primary">Rahasia Mengalahkan Hipertensi</h2>
                        <p class="lead text-muted mx-auto">Artikel eksklusif dari ahli kesehatan terpercaya. Pelajari cara
                            menurunkan tekanan darah tanpa efek samping!</p>
                        <div class="d-flex justify-content-center mt-4">
                            <div class="section-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-4 gy-4">
                @forelse ($articles as $article)
                    <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        loading="lazy" decoding="async" class="img-fluid">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image" loading="lazy"
                                        decoding="async" class="img-fluid">
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
                                    {{ Str::words(strip_tags($article->content), 30, '...') }}
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('cleanCarousel');
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');

            // Progressive image loading
            function loadImage(img) {
                if (img.dataset.src && !img.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
            }

            // Load images when carousel slides
            carousel.addEventListener('slide.bs.carousel', function(e) {
                const nextImg = e.relatedTarget.querySelector('img');
                if (nextImg) loadImage(nextImg);
            });

            // Image modal functionality
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('carousel-img') && e.target.src) {
                    modalImage.src = e.target.src;
                    modalImage.alt = e.target.alt;
                    modal.show();
                }
            });
        });
    </script>
@endpush
