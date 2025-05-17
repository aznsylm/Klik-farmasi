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
@endsection