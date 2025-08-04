@extends('layouts.app')

@section('title', 'Artikel Hipertensi Kehamilan')

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Artikel Hipertensi Kehamilan</h2>
            <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; margin: 0 auto;">Informasi
                kesehatan terkini tentang hipertensi pada kehamilan</p>
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
                                <p class="article-excerpt">{{ Str::words($latestArticle->content, 30, '...') }}</p>
                                <a href="{{ route('artikel.detail.kehamilan', $latestArticle->slug) }}" class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7">
                            <div class="article-image-fixed">
                                @if ($latestArticle->image)
                                    <img src="{{ asset('storage/' . $latestArticle->image) }}" alt="Gambar Artikel">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center"><i class="bi bi-info-circle me-2"></i> Belum ada artikel terbaru
                    untuk hipertensi kehamilan.
                </div>
            @endif
        </div>
    </section>
    <!-- Blog Preview Section (Artikel Lainnya) -->
    <section class="py-5 bg-light">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Artikel Lainnya</h2>
                        <p class="lead fw-normal text-muted mb-5">Temukan lebih banyak artikel kesehatan tentang hipertensi
                            kehamilan</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @forelse ($otherArticles as $article)
                    <div class="col-lg-4 mb-5">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image">
                                @endif
                            </div>
                            <div class="article-content">
                                <div class="article-category-new"><span>{{ $article->category }}</span></div>
                                <h3 class="article-title">{{ $article->title }}</h3>
                                <p class="article-excerpt">{{ Str::words($article->content, 20, '...') }}</p>
                                <a href="{{ route('artikel.detail.kehamilan', $article->slug) }}" class="read-more">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle me-2"></i> Belum ada artikel lainnya untuk hipertensi kehamilan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
