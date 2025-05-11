@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder mb-5">Artikel Terbaru</h2>
            @if ($latestArticle)
                <div class="card border-0 shadow rounded-3 overflow-hidden mb-4">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5">
                            <div class="p-4 p-md-5">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $latestArticle->category }}</div>
                                <div class="h2 fw-bolder">{{ $latestArticle->title }}</div>
                                <p class="text-justify">{{ Str::words($latestArticle->summary, 20, '...') }}</p>
                                <a href="{{ route('artikel.detail', $latestArticle->id) }}" class="btn btn-primary mt-auto">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <img src="{{ asset('storage/' . $latestArticle->image) }}" alt="Gambar Artikel" class="img-fluid h-100 w-100 object-fit-cover">
                        </div>
                    </div>
                </div>
            @else
                <p class="text-muted">Belum ada artikel terbaru.</p>
            @endif
        </div>
    </section>

    <!-- Blog Preview Section (Artikel Lainnya) -->
    <section class="bg-light py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 mb-5">
                    <div class="text-center">
                        <h2 class="fw-bolder">Artikel Lainnya</h2>
                        <h4 class="text-muted" style="font-family: 'Open Sans', sans-serif; font-size: 15px;">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</h4>
                    </div>
                </div>
            </div>
            <div class="row gx-5 gy-4">
                @forelse ($otherArticles as $article)
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
                    <p class="text-muted">Belum ada artikel yang tersedia.</p>
                @endforelse
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

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
@endsection