@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h1 class="fw-bolder fs-5 mb-4">Artikel Terbaru</h1>
            @if ($latestArticle)
                <div class="card border-0 shadow rounded-3 overflow-hidden mb-4">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5">
                            <div class="p-4 p-md-5">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $latestArticle->category }}</div>
                                <div class="h2 fw-bolder">{{ $latestArticle->title }}</div>
                                <p class="text-justify">{{ Str::words($latestArticle->summary, 20, '...') }}</p>
                                <a class="stretched-link text-decoration-none" href="{{ $latestArticle->link }}" target="_blank">
                                    Baca Selengkapnya
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <img src="{{ asset('assets/sample-6.jpg') }}" alt="Gambar Artikel" class="img-fluid h-100 w-100 object-fit-cover">
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted">Belum ada artikel terbaru.</p>
            @endif
        </div>
    </section>

    <!-- Blog Preview Section (Slider) -->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Artikel Terbaru</h2>
                        <p class="lead fw-normal text-muted mb-5">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5 gy-4">
                @forelse ($otherArticles as $article)
                    <div class="col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <!-- Konten Artikel -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark">{{ $article->title }}</h5>
                                <p class="card-text text-muted mb-4">{{ Str::words($article->summary, 20, '...') }}</p>
                                <a href="{{ $article->link }}" target="_blank" class="btn btn-outline-primary mt-auto">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada artikel yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="py-5 bg-light">
        <div class="container px-5">
            <div class="row gx-5">
                <div class="col-xl-8">
                    <h2 class="fw-bolder fs-5 mb-4">Berita</h2>
                    <!-- News Item -->
                    @forelse ($news as $berita)
                        <div class="mb-4">
                            <div class="small text-muted">{{ $berita->published_at->format('d M Y') }}</div>
                            <a class="link-dark" href="{{ $berita->link }}" target="_blank">
                                <h3>{{ $berita->title }}</h3>
                            </a>
                            <div class="small text-muted"><i>{{ $berita->source }}</i></div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada berita yang tersedia.</p>
                    @endforelse
                    <div class="text-end mb-5 mb-xl-0">
                        <a class="text-decoration-none" href="{{ route('pages.berita') }}" target="_self">
                            Berita Lainnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex h-100 align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="h6 fw-bolder">Kontak</div>
                                    <p class="text-muted mb-4">
                                        Untuk pertanyaan pers, email kami di
                                        <br />
                                        <a href="mailto:klikfarmasi@gmail.com">klikfarmasi@gmail.com</a>
                                    </p>
                                    <div class="h6 fw-bolder">Ikuti Kami</div>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                    <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .object-fit-cover {
            object-fit: cover; /* Gambar akan menyesuaikan tanpa distorsi */
            height: 100%; /* Tinggi gambar mengikuti tinggi container */
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .badge {
            font-size: 0.8rem;
            font-weight: 600;
        }

        .card-title {
            font-size: 1.1rem;
            color: #333;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: justify;
        }

        .btn-sm {
            align-self: flex-start; /* Pastikan tombol berada di bagian bawah */
        }

        /* Carousel Controls */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: #007bff; /* Warna tombol navigasi */
            border-radius: 50%;
            padding: 10px;
        }
        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .carousel-inner .row {
                display: none; /* Sembunyikan grid untuk tampilan mobile */
            }
        }
    </style>
@endsection