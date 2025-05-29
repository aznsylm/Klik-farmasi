@extends('layouts.app')

@section('title', $article->title)

@section('content')
<section class="py-5 article-section">
    <div class="container px-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('artikel') }}" class="text-decoration-none">Artikel</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 30) }}</li>
            </ol>
        </nav>

        <div class="row gx-5">
            <!-- Konten Artikel -->
            <div class="col-lg-8">
                <div class="article-container bg-white p-4 p-md-5 rounded-4 shadow-sm mb-4">
                    <!-- Article Header -->
                    <div class="article-header mb-4">
                        <span class="badge bg-secondary rounded-pill px-3 py-2 mb-2">{{ $article->category }}</span>
                        <h1 class="fw-bold display-5 mb-3" style="color: #0b5e91">{{ $article->title }}</h1>
                        
                        <div class="d-flex flex-wrap align-items-center text-muted mb-4">
                            <div class="me-4 d-flex align-items-center">
                                <i class="bi bi-person-circle me-2"></i>
                                <span>{{ $article->author }}</span>
                            </div>
                            <div class="me-4 d-flex align-items-center">
                                <i class="bi bi-calendar3 me-2"></i>
                                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : 'Tanggal tidak tersedia' }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock me-2"></i>
                                <span>{{ ceil(str_word_count($article->content) / 200) }} menit membaca</span>
                            </div>
                        </div>
                        
                        <!-- Share Buttons -->
                        <div class="article-share d-flex align-items-center mb-4">
                            <span class="me-3 fw-medium">Bagikan:</span>
                            <div class="d-flex gap-2">
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-success rounded-circle">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://www.instagram.com/klikfarmasi" target="_blank" class="btn btn-sm btn-outline-danger rounded-circle">
                                    <i class="bi bi-instagram"></i>
                                </a>                                
                                <a href="mailto:?subject={{ $article->title }}&body={{ urlencode('Baca artikel ini: ' . url()->current()) }}" class="btn btn-sm btn-outline-secondary rounded-circle">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image with caption -->
                    <figure class="figure mb-5 w-100">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="figure-img img-fluid rounded shadow-sm w-100" style="max-height: 500px; object-fit: cover;">
                        <figcaption class="figure-caption text-center mt-2">{{ $article->title }}</figcaption>
                    </figure>

                    <!-- Article Content -->
                    <div class="article-content">
                        <div class="content-text fs-6" style="line-height: 1.8;">
                            {!! nl2br(e($article->content)) !!}
                        </div>
                        
                        <!-- Tags if available -->
                        @if(isset($article->tags) && !empty($article->tags))
                        <div class="article-tags mt-5">
                            <h5 class="fw-bold mb-3">Tags</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach(explode(',', $article->tags) as $tag)
                                    <a href="#" class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">{{ trim($tag) }}</a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Author Bio if available -->
                @if(isset($article->author_bio))
                <div class="author-bio bg-white p-4 rounded-4 shadow-sm mb-4">
                    <div class="d-flex flex-wrap">
                        <div class="author-image me-4">
                            <img src="{{ isset($article->author_image) ? asset('storage/' . $article->author_image) : asset('img/default-avatar.png') }}" alt="{{ $article->author }}" class="rounded-circle" width="80" height="80">
                        </div>
                        <div class="author-info flex-grow-1">
                            <h5 class="fw-bold mb-2">{{ $article->author }}</h5>
                            <p class="text-muted mb-3">{{ $article->author_title ?? 'Penulis' }}</p>
                            <p class="mb-0">{{ $article->author_bio }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Navigation between articles -->
                <div class="article-navigation d-flex justify-content-between mt-5">
                    @if(isset($previousArticle))
                    <a href="{{ route('artikel.detail', $previousArticle->slug) }}" class="btn btn-outline-primary d-flex align-items-center">
                        <i class="bi bi-arrow-left me-2"></i> Artikel Sebelumnya
                    </a>
                    @else
                    <div></div>
                    @endif
                    
                    @if(isset($nextArticle))
                    <a href="{{ route('artikel.detail', $nextArticle->slug) }}" class="btn btn-outline-primary d-flex align-items-center">
                        Artikel Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    @else
                    <div></div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem; z-index: 1000;">
                    <!-- Artikel Terkait -->
                    @if(isset($relatedArticles) && count($relatedArticles) > 0)
                    <div class="card border-0 rounded-4 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white py-3 border-0">
                            <h5 class="mb-0 fw-bold"><i class="bi bi-journals me-2"></i> Artikel Terkait</h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush">
                                @foreach($relatedArticles as $relatedArticle)
                                <li class="list-group-item border-0 py-3">
                                    <a href="{{ route('artikel.detail', $relatedArticle->slug) }}" class="text-decoration-none">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/' . $relatedArticle->image) }}" alt="{{ $relatedArticle->title }}" class="rounded" width="60" height="60" style="object-fit: cover;">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1 text-primary">{{ Str::limit($relatedArticle->title, 50) }}</h6>
                                                <small class="text-muted">{{ $relatedArticle->published_at ? $relatedArticle->published_at->format('d M Y') : '' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <!-- Contact Card -->
                    <div class="card border-0 rounded-4 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <div class="icon-circle text-white mx-auto mb-3" style="background-color: #0b5e91">
                                    <i class="bi bi-chat-dots-fill"></i>
                                </div>
                                <h5 class="fw-bold">Punya Pertanyaan?</h5>
                                <p class="text-muted mb-0">Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau membutuhkan bantuan.</p>
                            </div>
                            <a href="mailto:klikfarmasi.official@gmail.com" class="btn btn-khusus w-100 mb-3">
                                <i class="bi bi-envelope me-2"></i> Email Kami
                            </a>
                            <a href="https://wa.me/1234567890" class="btn btn-success w-100">
                                <i class="bi bi-whatsapp me-2"></i> WhatsApp
                            </a>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="card border-0 rounded-4 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3 text-center">Ikuti Kami</h5>
                            <p class="text-muted text-center mb-4">Tetap terhubung dengan kami melalui media sosial untuk mendapatkan informasi terbaru.</p>
                            <div class="d-flex justify-content-center gap-3">
                                <a class="social-icon" href="https://wa.me/1234567890" target="_blank">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a class="social-icon" href="https://www.instagram.com/klikfarmasi.official/" target="_blank">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a class="social-icon" href="https://www.tiktok.com/@klikfarmasi.official" target="_blank">
                                    <i class="bi bi-tiktok"></i>
                                </a>
                                <a class="social-icon" href="mailto:klikfarmasi.official@gmail.com">
                                    <i class="bi bi-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection