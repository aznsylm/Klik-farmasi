@extends('layouts.medicio')

@section('title', 'Artikel Hipertensi Non-Kehamilan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Artikel kesehatan tentang hipertensi umum dan tekanan darah tinggi. Tips pengelolaan hipertensi, obat-obatan, dan gaya hidup sehat dari ahli farmasi.">
    <meta name="keywords"
        content="hipertensi, tekanan darah tinggi, obat hipertensi, gaya hidup sehat, pencegahan hipertensi, farmasi">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    @if (isset($latestArticle) && $latestArticle->image)
        <!-- Preload featured article image for LCP optimization -->
        <link rel="preload" as="image" href="{{ asset('storage/' . $latestArticle->image) }}" fetchpriority="high">
    @endif

    <!-- Custom CSS for articles -->
    <style>
        .article-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 80px 0;
            color: white;
        }

        .article-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .article-image {
            position: relative;
            overflow: hidden;
            height: 250px;
        }

        .article-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .article-card:hover .article-image img {
            transform: scale(1.05);
        }

        .article-content {
            padding: 25px;
        }

        .article-category {
            background: #1e3c72;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
        }

        .article-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .article-title a {
            color: #2c3e50;
            text-decoration: none;
        }

        .article-title a:hover {
            color: #1e3c72;
        }

        .article-excerpt {
            color: #6c757d;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .article-meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .read-more {
            background: #1e3c72;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .read-more:hover {
            background: #163057;
            color: white;
            transform: translateY(-2px);
        }

        .featured-article {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
        }

        .featured-article .article-image {
            height: 500px;
            object-fit: cover;
            object-position: center;
        }

        .breadcrumb-style {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-style .breadcrumb-item a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb-style .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.8);
        }

        /* Pagination Styling */
        .pagination .page-link {
            color: #1e3c72;
            border-color: #e9ecef;
        }

        .pagination .page-item.active .page-link {
            background-color: #1e3c72;
            border-color: #1e3c72;
        }

        .pagination .page-link:hover {
            color: #163057;
            background-color: #e9ecef;
        }

        /* Pagination Styling */
        .pagination .page-link {
            color: #1e3c72;
            border-color: #e9ecef;
        }

        .pagination .page-item.active .page-link {
            background-color: #1e3c72;
            border-color: #1e3c72;
        }

        .pagination .page-link:hover {
            color: #163057;
            background-color: #e9ecef;
        }
    </style>
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Artikel Hipertensi Non-Kehamilan</h1>
                        <p class="mb-0">Informasi kesehatan terpercaya tentang hipertensi dan tekanan darah tinggi dari
                            tim farmasi Universitas Alma Ata</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Artikel Hipertensi Non-Kehamilan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Featured Article Section -->
    @if ($latestArticle)
        <section class="py-5">
            <div class="container">

                <div class="featured-article" data-aos="fade-up" data-aos-delay="100">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="article-image">
                                @if ($latestArticle->image)
                                    <img src="{{ asset('storage/' . $latestArticle->image) }}"
                                        alt="{{ $latestArticle->title }}" loading="eager" fetchpriority="high"
                                        decoding="async">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Artikel hipertensi" loading="eager"
                                        fetchpriority="high" decoding="async">
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="article-content p-4 p-lg-5">
                                <div class="article-category">{{ $latestArticle->category ?? 'Hipertensi' }}</div>
                                <h3 class="article-title">
                                    <a href="{{ route('artikel.detail.non-kehamilan', $latestArticle->slug) }}">
                                        {{ $latestArticle->title }}
                                    </a>
                                </h3>
                                <div class="article-excerpt">
                                    {!! Str::words($latestArticle->content, 30, '...') !!}
                                </div>
                                <div class="article-meta">
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i>
                                        {{ $latestArticle->author ?? 'Tim Farmasi UAA' }} |
                                        <i class="bi bi-clock ms-2 me-1"></i>
                                        {{ $latestArticle->published_at ? $latestArticle->published_at->format('d M Y') : $latestArticle->created_at->format('d M Y') }}
                                    </small>
                                </div>
                                <a href="{{ route('artikel.detail.non-kehamilan', $latestArticle->slug) }}"
                                    class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Articles Grid Section -->
    <section class="py-5 light-background">
        <div class="container">

            <div class="row gy-4">
                @forelse ($otherArticles as $article)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        loading="lazy" decoding="async">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Artikel hipertensi" loading="lazy"
                                        decoding="async">
                                @endif
                            </div>
                            <div class="article-content">
                                <div class="article-category">{{ $article->category ?? 'Hipertensi' }}</div>
                                <h4 class="article-title">
                                    <a href="{{ route('artikel.detail.non-kehamilan', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h4>
                                <div class="article-meta">
                                    <i class="bi bi-person me-1"></i>
                                    {{ $article->author ?? 'Tim Farmasi UAA' }} |
                                    <i class="bi bi-clock ms-2 me-1"></i>
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                </div>
                                <div class="article-excerpt">
                                    {!! Str::words($article->content, 20, '...') !!}
                                </div>
                                <a href="{{ route('artikel.detail.non-kehamilan', $article->slug) }}" class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center" data-aos="fade-up">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada artikel lainnya untuk hipertensi. Silakan kembali lagi nanti.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($otherArticles->hasPages())
                <div class="pagination-wrapper text-center mt-5" data-aos="fade-up">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($otherArticles->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="bi bi-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $otherArticles->previousPageUrl() }}">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($otherArticles->getUrlRange(1, $otherArticles->lastPage()) as $page => $url)
                                @if ($page == $otherArticles->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($otherArticles->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $otherArticles->nextPageUrl() }}">
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="bi bi-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });

            console.log('Halaman Artikel Hipertensi (Medicio) siap!');
        });
    </script>
@endpush
