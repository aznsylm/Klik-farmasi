@extends('layouts.app')

@section('title', 'Artikel')

@push('head')
    @if (isset($latestArticle) && $latestArticle->image)
        <!-- Preload featured article image for LCP optimization -->
        <link rel="preload" as="image" href="{{ asset('storage/' . $latestArticle->image) }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Artikel Terbaru</h2>
            <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; margin: 0 auto;">Informasi
                kesehatan terkini untuk Anda</p>
            <div class="d-flex mt-3 mb-5">
                <div
                    style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;">
                </div>
            </div>
            @if ($latestArticle)
                <div class="card border-0 shadow rounded-3 overflow-hidden mb-4">
                    <div class="row gx-0">
                        <div class="col-lg-6 col-xl-5 py-lg-5" data-aos="flip-left">
                            <div class="p-4 p-md-5">
                                <div class="article-category-new"><span>{{ $latestArticle->category }}</span></div>
                                <h1 class="article-title fs-2">{{ $latestArticle->title }}</h1>
                                <p class="article-excerpt">{{ Str::words($article->content, 30, '...') }}</p>
                                <a href="{{ route($latestArticle->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $latestArticle->slug) }}"
                                    class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="article-image h-100">
                                <img src="{{ asset('storage/' . $latestArticle->image) }}" alt="Gambar Artikel"
                                    class="img-fluid h-100 w-100 object-fit-cover" loading="eager" fetchpriority="high"
                                    decoding="async" width="800" height="600">
                            </div>
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
                        <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Artikel Lainnya</h2>
                        <p class="lead text-muted mx-auto"
                            style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Temukan
                            informasi kesehatan terbaru dan tips bermanfaat untuk hidup sehat.</p>
                        <div class="d-flex justify-content-center mt-3">
                            <div
                                style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-5 gy-4">
                @forelse ($otherArticles as $article)
                    <div class="col-lg-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        loading="lazy" decoding="async" width="400" height="250">
                                @else
                                    <img src="{{ asset('assets/default-image.jpg') }}" alt="Default Image" loading="lazy"
                                        decoding="async" width="400" height="250">
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
                                <a href="{{ route($article->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $article->slug) }}"
                                    class="read-more">
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
@endsection


