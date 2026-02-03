@extends('layouts.medicio')

@section('title', $article->title . ' - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ Str::limit(strip_tags($article->content), 160) }}">
    <meta name="keywords"
        content="hipertensi, {{ $article->article_type }}, kesehatan, farmasi, {{ $article->category ?? '' }}">
    <meta name="author" content="{{ $article->author ?? 'Tim Farmasi Universitas Alma Ata' }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($article->content), 160) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($article->image)
        <meta property="og:image" content="{{ asset('storage/' . $article->image) }}">
    @endif

    @if ($article->image)
        <!-- Preload article image for LCP optimization -->
        <link rel="preload" as="image" href="{{ asset('storage/' . $article->image) }}" fetchpriority="high">
    @endif

    <!-- Custom CSS for article detail -->
    <style>
        .article-detail {
            padding: 40px 0;
        }

        .article-sidebar {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 30px;
            height: fit-content;
        }

        .related-articles {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .related-articles li {
            border-bottom: 1px solid #e9ecef;
            padding: 15px 0;
        }

        .related-articles li:last-child {
            border-bottom: none;
        }

        .related-articles a {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 600;
            display: block;
            transition: color 0.3s ease;
        }

        .related-articles a:hover {
            color: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #333;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .article-content p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        .article-meta {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .article-meta-info {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .article-meta-item {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #6c757d;
            white-space: nowrap;
        }

        .article-meta-item i {
            margin-right: 5px;
            color: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
        }

        .reading-time {
            color: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Mobile Responsive */
        @media (max-width: 767.98px) {
            .article-meta {
                padding: 15px;
            }

            .article-meta-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .article-meta-item {
                font-size: 0.85rem;
            }

            .reading-time {
                align-self: flex-end;
                margin-top: 10px;
            }
        }

        .article-category {
            background: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .article-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .article-navigation {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;
        }

        .nav-article {
            text-decoration: none;
            color: #2c3e50;
            padding: 15px;
            border-radius: 10px;
            background: white;
            display: block;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .nav-article:hover {
            color: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            border-color: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-article .nav-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .nav-article .nav-title {
            font-weight: 600;
            font-size: 1rem;
        }

        .share-buttons {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .share-button {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            transition: transform 0.3s ease;
        }

        .share-button:hover {
            transform: translateY(-2px);
            color: white;
        }

        .share-facebook {
            background: #4267B2;
        }

        .share-twitter {
            background: #1DA1F2;
        }

        .share-whatsapp {
            background: #25D366;
        }

        .share-telegram {
            background: #0088cc;
        }

        .contact-admin {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
            text-align: center;
        }

        .contact-admin h5 {
            color: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            margin-bottom: 15px;
            font-weight: 700;
        }

        .admin-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            margin: 0 auto 15px;
            background: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .contact-button {
            background: {{ $article->article_type === 'kehamilan' ? '#e91e63' : '#1e3c72' }};
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            margin: 5px;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .contact-button:hover {
            background: {{ $article->article_type === 'kehamilan' ? '#c2185b' : '#163057' }};
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .contact-button i {
            margin-right: 5px;
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
                        <h1>{{ $article->title }}</h1>
                        <p class="mb-0">
                            Artikel
                            {{ $article->article_type === 'kehamilan' ? 'Hipertensi Kehamilan' : 'Hipertensi Non-Kehamilan' }}
                            dari Tim Farmasi Universitas Alma Ata
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li><a
                            href="{{ route('artikel.' . ($article->article_type === 'kehamilan' ? 'kehamilan' : 'non-kehamilan')) }}">
                            Artikel {{ $article->article_type === 'kehamilan' ? 'Kehamilan' : 'Non-Kehamilan' }}
                        </a></li>
                    <li class="current">{{ $article->title }}</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Article Detail Section -->
    <section id="article-details" class="article-detail section">
        <div class="container">
            <div class="row gy-4">

                <!-- Sidebar - Order 2 on mobile, 1 on desktop -->
                <div class="col-lg-4 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="article-sidebar">
                        <h4>Artikel Terkait</h4>
                        @if ($relatedArticles->count() > 0)
                            <ul class="related-articles">
                                @foreach ($relatedArticles->take(5) as $relatedArticle)
                                    <li>
                                        <a
                                            href="{{ route('artikel.detail.' . ($article->article_type === 'kehamilan' ? 'kehamilan' : 'non-kehamilan'), $relatedArticle->slug) }}">
                                            {{ $relatedArticle->title }}
                                        </a>
                                        <small class="text-muted d-block mt-1">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $relatedArticle->created_at->format('d M Y') }}
                                        </small>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Belum ada artikel terkait lainnya.</p>
                        @endif

                        <div class="mt-4">
                            <h5>Kategori</h5>
                            <div class="article-category">
                                {{ $article->category ?? ($article->article_type === 'kehamilan' ? 'Hipertensi Kehamilan' : 'Hipertensi') }}
                            </div>
                        </div>

                        <!-- Kontak Admin Section -->
                        <div class="contact-admin">
                            <div class="admin-avatar">
                                <i class="bi bi-person-badge"></i>
                            </div>
                            <h5>Butuh Bantuan?</h5>
                            <p class="text-muted mb-3">Tim farmasi kami siap membantu Anda dengan pertanyaan seputar artikel
                                ini.</p>

                            <div class="d-flex flex-column gap-2">
                                <a href="https://wa.me/6285280909235?text=Halo, saya ingin konsultasi terkait artikel: {{ urlencode($article->title) }}"
                                    class="contact-button" target="_blank">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                                <a href="mailto:klikfarmasi.official@gmail.com?subject=Konsultasi Artikel: {{ urlencode($article->title) }}"
                                    class="contact-button">
                                    <i class="bi bi-envelope"></i> Email
                                </a>
                                <a href="{{ route('tanya-jawab.' . ($article->article_type === 'kehamilan' ? 'kehamilan' : 'non-kehamilan')) }}"
                                    class="contact-button">
                                    <i class="bi bi-chat-dots"></i> Tanya Jawab
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Main Content - Order 1 on mobile, 2 on desktop -->
                <div class="col-lg-8 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">

                    <!-- Article Image -->
                    @if ($article->image)
                        <div class="article-image">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="img-fluid" loading="eager" fetchpriority="high">
                        </div>
                    @endif

                    <!-- Article Meta -->
                    <div class="article-meta">
                        <div class="article-meta-info">
                            <div class="article-meta-item">
                                <i class="bi bi-person"></i>
                                <span>{{ $article->author ?? 'Tim Farmasi UAA' }}</span>
                            </div>

                            <div class="article-meta-item">
                                <i class="bi bi-calendar-event"></i>
                                <span>
                                    {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <div class="article-meta-item">
                                <i class="bi bi-tag"></i>
                                <span>{{ $article->article_type === 'kehamilan' ? 'Kehamilan' : 'Non-Kehamilan' }}</span>
                            </div>

                            <div class="reading-time">
                                <i class="bi bi-clock"></i>
                                Waktu baca: {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} menit
                            </div>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons">
                        <h6 class="mb-3">Bagikan artikel ini:</h6>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            class="share-button share-facebook" target="_blank">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                            class="share-button share-twitter" target="_blank">
                            <i class="bi bi-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
                            class="share-button share-whatsapp" target="_blank">
                            <i class="bi bi-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
                            class="share-button share-telegram" target="_blank">
                            <i class="bi bi-telegram me-1"></i> Telegram
                        </a>
                    </div>

                    <!-- Article Navigation -->
                    <div class="article-navigation">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($previousArticle)
                                    <a href="{{ route('artikel.detail.' . ($article->article_type === 'kehamilan' ? 'kehamilan' : 'non-kehamilan'), $previousArticle->slug) }}"
                                        class="nav-article">
                                        <div class="nav-label">
                                            <i class="bi bi-arrow-left me-1"></i> Artikel Sebelumnya
                                        </div>
                                        <div class="nav-title">{{ $previousArticle->title }}</div>
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                @if ($nextArticle)
                                    <a href="{{ route('artikel.detail.' . ($article->article_type === 'kehamilan' ? 'kehamilan' : 'non-kehamilan'), $nextArticle->slug) }}"
                                        class="nav-article text-md-end">
                                        <div class="nav-label">
                                            Artikel Selanjutnya <i class="bi bi-arrow-right ms-1"></i>
                                        </div>
                                        <div class="nav-title">{{ $nextArticle->title }}</div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section><!-- /Article Detail Section -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });

            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            console.log('Halaman Detail Artikel (Medicio) siap!');
        });
    </script>
@endpush
