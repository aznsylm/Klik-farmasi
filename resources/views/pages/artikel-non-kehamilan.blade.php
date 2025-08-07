@extends('layouts.app')

@section('title', 'Artikel Hipertensi Non-Kehamilan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Artikel kesehatan tentang hipertensi umum dan tekanan darah tinggi. Tips pengelolaan hipertensi, obat-obatan, dan gaya hidup sehat dari ahli farmasi.">
    <meta name="keywords" content="hipertensi, tekanan darah tinggi, obat hipertensi, gaya hidup sehat, pencegahan hipertensi, farmasi">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
    
    @if (isset($latestArticle) && $latestArticle->image)
        <!-- Preload featured article image for LCP optimization -->
        <link rel="preload" as="image" href="{{ asset('storage/' . $latestArticle->image) }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder mb-3 text-primary">Artikel Hipertensi Non-Kehamilan</h2>
            <p class="lead text-muted mx-auto">Informasi
                kesehatan terkini tentang hipertensi umum</p>
            <div class="d-flex mt-3 mb-5">
                <div class="section-divider"></div>
            </div>
            @if ($latestArticle)
                <div class="card border-0 shadow rounded-3 overflow-hidden mb-4">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5" data-aos="flip-left">
                            <div class="p-4 p-md-5">
                                <div class="article-category-new"><span>{{ $latestArticle->category }}</span></div>
                                <h1 class="article-title fs-2">{{ $latestArticle->title }}</h1>
                                <p class="article-excerpt">{{ Str::words($latestArticle->content, 30, '...') }}</p>
                                <a href="{{ route('artikel.detail.non-kehamilan', $latestArticle->slug) }}"
                                    class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="article-image-fixed">
                                @if ($latestArticle->image)
                                    <img src="{{ asset('storage/' . $latestArticle->image) }}" alt="{{ $latestArticle->title }} - Artikel hipertensi dan kesehatan"
                                        loading="eager" fetchpriority="high" decoding="async" width="800" height="600">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Artikel hipertensi - informasi kesehatan dan tips pengelolaan" loading="eager"
                                        fetchpriority="high" decoding="async" width="800" height="600">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i> Belum ada artikel terbaru untuk hipertensi non-kehamilan.
                </div>
            @endif
        </div>
    </section>

    <!-- Blog Preview Section (Artikel Lainnya) -->
    <section class="bg-light py-5">
        <div class="container px-5 my-5">
            <div style="display: flex; justify-content: center; margin-bottom: 3rem;">
                <div style="max-width: 700px; text-align: center;">
                    <h2 class="fw-bolder mb-3 text-primary">Artikel Lainnya</h2>
                    <p class="lead text-muted">Temukan informasi kesehatan
                        terbaru dan tips bermanfaat untuk hidup sehat.</p>
                    <div class="d-flex justify-content-center mt-3">
                        <div class="section-divider"></div>
                    </div>
                </div>
            </div>
            <div class="articles-grid">
                @forelse ($otherArticles as $article)
                    <div class="article-item">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }} - Artikel kesehatan hipertensi"
                                        loading="lazy" decoding="async" width="400" height="250" class="lazy-image">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Artikel hipertensi - tips kesehatan dan pencegahan" loading="lazy"
                                        decoding="async" width="400" height="250" class="lazy-image">
                                @endif
                                <div class="article-category">
                                    <span>{{ $article->category }}</span>
                                </div>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">{{ $article->title }}</h3>
                                <div class="article-meta">
                                    <div class="meta-item">
                                        <span>{{ $article->author }} -
                                            {{ $article->published_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <p class="article-excerpt">
                                    {{ Str::words($article->content, 30, '...') }}
                                </p>
                                <a href="{{ route('artikel.detail.non-kehamilan', $article->slug) }}" class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Belum ada artikel lainnya yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection


