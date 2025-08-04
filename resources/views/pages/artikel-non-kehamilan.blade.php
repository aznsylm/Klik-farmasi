@extends('layouts.app')

@section('title', 'Artikel Hipertensi Non-Kehamilan')

@section('content')
    <!-- Artikel Terbaru -->
    <section class="py-5">
        <div class="container px-5">
            <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Artikel Hipertensi Non-Kehamilan</h2>
            <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; margin: 0 auto;">Informasi
                kesehatan terkini tentang hipertensi umum</p>
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
                                <a href="{{ route('artikel.detail.non-kehamilan', $latestArticle->slug) }}"
                                    class="read-more">
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
                    <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Artikel Lainnya</h2>
                    <p class="lead text-muted" style="font-family: 'Open Sans', sans-serif;">Temukan informasi kesehatan
                        terbaru dan tips bermanfaat untuk hidup sehat.</p>
                    <div style="display: flex; justify-content: center; margin-top: 1rem;">
                        <div
                            style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="articles-grid">
                @forelse ($otherArticles as $article)
                    <div class="article-item">
                        <div class="article-card">
                            <div class="article-image">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
                                @else
                                    <img src="{{ asset('assets/sample-1.jpg') }}" alt="Default Image">
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

<style>
    .article-category-new {
        padding-bottom: 10px;
        z-index: 2;
    }

    .article-category-new span {
        background-color: #0b5e91;
        color: white;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .article-image {
        position: relative;
        height: 200px;
        overflow: hidden;
        background-color: #f8f9fa;
        display: block;
    }

    .article-image-fixed {
        width: 100%;
        height: 500px;
        overflow: hidden;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .article-image-fixed img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .article-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        border-radius: 0;
    }

    .article-card {
        display: flex;
        flex-direction: column;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: white;
        border: none;
        height: 100%;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .article-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .article-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #0b5e91;
    }

    .article-excerpt {
        color: #6c757d;
        margin-bottom: 1rem;
        flex-grow: 1;
    }

    .read-more {
        color: #0b5e91;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        margin-top: auto;
    }

    .read-more i {
        margin-left: 0.5rem;
        transition: transform 0.2s ease;
    }

    .read-more:hover i {
        transform: translateX(3px);
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
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .article-meta {
        margin-bottom: 0.75rem;
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Articles Grid Layout */
    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 1rem;
    }

    .article-item {
        display: flex;
        flex-direction: column;
    }

    @media (max-width: 768px) {
        .articles-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>
