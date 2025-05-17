@extends('layouts.app')

@section('title', 'Artikel')

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h1 class="fw-bolder mb-5">Artikel Terbaru</h1>
            @if ($latestArticle)
                <div class="card border-0 shadow rounded-3 overflow-hidden mb-4">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5" data-aos="flip-left">
                            <div class="p-4 p-md-5">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ $latestArticle->category }}</div>
                                <div class="h2 fw-bolder">{{ $latestArticle->title }}</div>
                                <p class="text-justify">{{ Str::words($latestArticle->summary, 20, '...') }}</p>
                                <a href="{{ route('artikel.detail', $latestArticle->slug) }}" class="btn btn-primary mt-auto">
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
                <div class="col-lg-8 col-xl-6 mb-5" data-aos="zoom-in-up">
                    <div class="text-center">
                        <h2 class="fw-bolder">Artikel Lainnya</h2>
                        <h4 class="text-muted" style="font-family: 'Open Sans', sans-serif; font-size: 15px;">Temukan informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</h4>
                    </div>
                </div>
            </div>
            <div class="row gx-5 gy-4">
                @forelse ($otherArticles as $article)
                    <div class="col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                @else
                                    <img src="{{ asset('assets/default-image.jpg') }}" alt="Default Image">
                                @endif
                                <div class="article-category">
                                    <span>{{ $article->category }}</span>
                                </div>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">{{ $article->title }}</h3>
                                <div class="article-meta">
                                    <div class="meta-item">
                                        <span>{{ $article->author }} - {{ $article->published_at->format('d M Y') }}</span>
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
        
        /* Styling untuk artikel terbaru */
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

        /* Styling untuk card artikel lainnya */
        .article-card {
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .article-image {
            position: relative;
            overflow: hidden;
            height: 200px;
        }
        
        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .article-card:hover .article-image img {
            transform: scale(1.05);
        }
        
        .article-category {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
        }
        
        .article-category span {
            background-color: #0b5e91;
            color: white;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .article-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        
        .article-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0b5e91;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .article-meta {
            display: flex;
            margin-bottom: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            margin-right: 1rem;
        }
        
        .meta-item i {
            margin-right: 0.35rem;
            font-size: 0.9rem;
        }
        
        .article-excerpt {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .read-more {
            color: #0b5e91;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            margin-top: auto;
            transition: all 0.2s ease;
        }
        
        .read-more i {
            margin-left: 0.5rem;
            transition: transform 0.2s ease;
        }
        
        .read-more:hover {
            color: #083e61;
        }
        
        .read-more:hover i {
            transform: translateX(4px);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .article-title {
                font-size: 1.1rem;
            }
            
            .article-excerpt {
                -webkit-line-clamp: 2;
            }
        }
    </style>
@endsection