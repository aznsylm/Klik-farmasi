@extends('layouts.app')
@section('title', $article->title)

@push('head')
    <!-- External CSS for optimized performance -->
    <link rel="stylesheet" href="{{ asset('css/artikel-pages.css') }}" media="screen">

    @if ($article->image)
        <!-- Preload article featured image for LCP optimization -->
        <link rel="preload" as="image" href="{{ asset('storage/' . $article->image) }}" fetchpriority="high">
    @endif
@endpush

@section('content')
    <section class="py-3 py-md-5 article-section">
        <div class="container px-3 px-md-4">
            <div class="row gx-2 gx-lg-5">
                <!-- Breadcrumb -->
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="mb-3 mb-md-4">
                        <ol class="breadcrumb breadcrumb-mobile">
                            <li class="breadcrumb-item"><a href="{{ route('beranda') }}"
                                    class="text-decoration-none">Beranda</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route($article->article_type === 'kehamilan' ? 'artikel.kehamilan' : 'artikel.non-kehamilan') }}"
                                    class="text-decoration-none">Artikel
                                    {{ $article->article_type === 'kehamilan' ? 'Hipertensi Kehamilan' : 'Hipertensi Non-Kehamilan' }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($article->title, 30) }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- Konten Artikel -->
                <div class="col-lg-8">
                    <div class="article-container bg-white p-2 p-sm-3 p-md-4 rounded-3 rounded-md-4 shadow-sm mb-3 mb-md-4">
                        <!-- Article Header -->
                        <div class="article-header mb-3 mb-md-4">
                            <span
                                class="badge bg-secondary rounded-pill px-2 px-md-3 py-1 py-md-2 mb-2 fs-mobile-small">{{ $article->category }}</span>
                            <h1 class="fw-bold article-title-responsive mb-2 mb-md-3 text-primary">{{ $article->title }}
                            </h1>

                            <div class="article-meta d-flex flex-wrap align-items-center text-muted mb-3 mb-md-4">
                                <div class="meta-item me-2 me-md-4 d-flex align-items-center mb-1">
                                    <i class="bi bi-person-circle me-1 me-md-2"></i>
                                    <span class="fs-mobile-small">{{ $article->author }}</span>
                                </div>
                                <div class="meta-item me-2 me-md-4 d-flex align-items-center mb-1">
                                    <i class="bi bi-calendar3 me-1 me-md-2"></i>
                                    <span
                                        class="fs-mobile-small">{{ $article->published_at ? $article->published_at->format('d M Y') : 'Tanggal tidak tersedia' }}</span>
                                </div>
                                <div class="meta-item d-flex align-items-center mb-1">
                                    <i class="bi bi-clock me-1 me-md-2"></i>
                                    <span class="fs-mobile-small">{{ ceil(str_word_count($article->content) / 200) }} menit
                                        membaca</span>
                                </div>
                            </div>

                            <!-- Share Buttons -->
                            <div class="article-share d-flex flex-wrap align-items-center mb-3 mb-md-4">
                                <span class="me-2 me-md-3 fw-medium fs-mobile-small">Bagikan:</span>
                                <div class="d-flex gap-1 gap-md-2 share-buttons-mobile">
                                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . url()->current()) }}"
                                        target="_blank" class="btn btn-sm btn-outline-success rounded-circle">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank" class="btn btn-sm btn-outline-primary rounded-circle">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(url()->current()) }}"
                                        target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                    <a href="mailto:?subject={{ $article->title }}&body={{ urlencode('Baca artikel ini: ' . url()->current()) }}"
                                        class="btn btn-sm btn-outline-secondary rounded-circle">
                                        <i class="bi bi-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image with caption -->
                        <figure class="figure mb-4 mb-md-5 w-100">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                class="figure-img img-fluid rounded shadow-sm article-featured-image" loading="eager"
                                fetchpriority="high" decoding="async" width="800" height="500" data-bs-toggle="modal"
                                data-bs-target="#imageModal" style="cursor: pointer;" title="Klik untuk memperbesar gambar">
                            <figcaption class="figure-caption text-center mt-2 fs-mobile-small">{{ $article->title }}
                            </figcaption>
                        </figure>

                        <!-- Article Content -->
                        <div class="article-content">
                            <div class="content-text article-content-responsive">
                                {!! $article->content !!}
                            </div>

                            <!-- Tags if available -->
                            @if (isset($article->tags) && !empty($article->tags))
                                <div class="article-tags mt-5">
                                    <h5 class="fw-bold mb-3">Tags</h5>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach (explode(',', $article->tags) as $tag)
                                            <a href="#"
                                                class="badge bg-light text-dark text-decoration-none px-3 py-2 rounded-pill">{{ trim($tag) }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Author Bio if available -->
                    @if (isset($article->author_bio))
                        <div class="author-bio bg-white p-4 rounded-4 shadow-sm mb-4">
                            <div class="d-flex flex-wrap">
                                <div class="author-image me-4">
                                    <img src="{{ isset($article->author_image) ? asset('storage/' . $article->author_image) : asset('img/default-avatar.png') }}"
                                        alt="{{ $article->author }}" class="rounded-circle" width="80" height="80"
                                        loading="lazy" decoding="async">
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
                        @if (isset($previousArticle))
                            <a href="{{ route($previousArticle->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $previousArticle->slug) }}"
                                class="btn btn-outline-primary d-flex align-items-center">
                                <i class="bi bi-arrow-left me-2"></i> Artikel Sebelumnya
                            </a>
                        @else
                            <div></div>
                        @endif

                        @if (isset($nextArticle))
                            <a href="{{ route($nextArticle->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $nextArticle->slug) }}"
                                class="btn btn-outline-primary d-flex align-items-center">
                                Artikel Selanjutnya <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <div></div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar-content">
                        <!-- Desktop Sticky Container -->
                        <div class="d-none d-lg-block position-sticky" style="top: 2rem; z-index: 1000;">
                            <!-- Artikel Terkait -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-primary">
                                    <h6 class="mb-0 text-white">Artikel Terkait</h6>
                                </div>
                                <div class="card-body p-3">
                                    @if (isset($relatedArticles) && count($relatedArticles) > 0)
                                        @foreach ($relatedArticles as $relatedArticle)
                                            <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                                <a href="{{ route($relatedArticle->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $relatedArticle->slug) }}"
                                                    class="text-decoration-none">
                                                    <h6 class="text-primary mb-1">
                                                        {{ Str::limit($relatedArticle->title, 50) }}</h6>
                                                    <small
                                                        class="text-muted">{{ $relatedArticle->published_at ? $relatedArticle->published_at->format('d M Y') : '' }}</small>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">Belum ada artikel terkait.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Card -->
                            <div class="card border-0 rounded-3 rounded-md-4 shadow-sm mb-3 mb-md-4">
                                <div class="card-body p-3 p-md-4">
                                    <div class="mb-3 mb-md-4">
                                        <h5 class="fw-bold text-success contact-title-mobile">Butuh Bantuan Cepat?</h5>
                                        <p class="text-muted mb-0 fs-mobile-small">Tim farmasi kami siap membantu Anda
                                            24/7! Pilih kontak yang tersedia:</p>
                                    </div>

                                    <!-- WhatsApp Contacts -->
                                    <div class="contact-list">
                                        <a href="https://wa.me/+6281292936247"
                                            class="contact-item d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Abdi Sugeng Pangestu</h6>
                                                <small class="text-muted">+62 812-9293-6247</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>

                                        <a href="https://wa.me/+6281243983318"
                                            class="contact-item d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Adinda Putri Ibdaniya</h6>
                                                <small class="text-muted">+62 812-4398-3318</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>

                                        <a href="https://wa.me/+6281271954082"
                                            class="contact-item d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Enzelika</h6>
                                                <small class="text-muted">+62 812-7195-4082</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>

                                        <a href="https://wa.me/+6282286438701"
                                            class="contact-item d-flex align-items-center p-2 mb-3 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Febby Trianingsih</h6>
                                                <small class="text-muted">+62 822-8643-8701</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>
                                    </div>

                                    <div class="text-center">
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>Respon cepat dalam 1-24
                                            jam</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div class="card border-0 rounded-4 shadow-sm">
                                <div class="card-body p-4 p-sm-3 p-md-4">
                                    <h5 class="fw-bold mb-3 text-center">Ikuti Kami</h5>
                                    <p class="text-muted text-center mb-4">Tetap terhubung dengan kami melalui media sosial
                                        untuk mendapatkan informasi terbaru.</p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a class="social-icon" href="https://wa.me/+6281292936247" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                        <a class="social-icon" href="https://www.instagram.com/klikfarmasi.official/"
                                            target="_blank">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                        <a class="social-icon" href="https://www.tiktok.com/@klikfarmasi.official"
                                            target="_blank">
                                            <i class="bi bi-tiktok"></i>
                                        </a>
                                        <a class="social-icon" href="mailto:klikfarmasi.official@gmail.com">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mobile Container -->
                        <div class="d-block d-lg-none mt-4">
                            <!-- Artikel Terkait -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-primary">
                                    <h6 class="mb-0 text-white">Artikel Terkait</h6>
                                </div>
                                <div class="card-body p-3">
                                    @if (isset($relatedArticles) && count($relatedArticles) > 0)
                                        @foreach ($relatedArticles as $relatedArticle)
                                            <div class="mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                                                <a href="{{ route($relatedArticle->article_type === 'kehamilan' ? 'artikel.detail.kehamilan' : 'artikel.detail.non-kehamilan', $relatedArticle->slug) }}"
                                                    class="text-decoration-none">
                                                    <h6 class="text-primary mb-1">
                                                        {{ Str::limit($relatedArticle->title, 50) }}</h6>
                                                    <small
                                                        class="text-muted">{{ $relatedArticle->published_at ? $relatedArticle->published_at->format('d M Y') : '' }}</small>
                                                </a>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted mb-0">Belum ada artikel terkait.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Card -->
                            <div class="card border-0 rounded-3 rounded-md-4 shadow-sm mb-3 mb-md-4">
                                <div class="card-body p-3 p-md-4">
                                    <div class="mb-3 mb-md-4">
                                        <h5 class="fw-bold text-success contact-title-mobile">Butuh Bantuan Cepat?</h5>
                                        <p class="text-muted mb-0 fs-mobile-small">Tim farmasi kami siap membantu Anda
                                            24/7! Pilih kontak yang tersedia:</p>
                                    </div>

                                    <!-- WhatsApp Contacts -->
                                    <div class="contact-list">
                                        <a href="https://wa.me/+6281292936247"
                                            class="contact-item d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Abdi Sugeng Pangestu</h6>
                                                <small class="text-muted">+62 812-9293-6247</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>

                                        <a href="https://wa.me/+6281243983318"
                                            class="contact-item d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Adinda Putri Ibdaniya</h6>
                                                <small class="text-muted">+62 812-4398-3318</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>

                                        <a href="https://wa.me/+6281271954082"
                                            class="contact-item d-flex align-items-center p-2 mb-2 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Enzelika</h6>
                                                <small class="text-muted">+62 812-7195-4082</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>

                                        <a href="https://wa.me/+6282286438701"
                                            class="contact-item d-flex align-items-center p-2 mb-3 text-decoration-none border rounded hover-effect">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 35px; height: 35px;">
                                                    <i class="bi bi-whatsapp text-white"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0 text-dark">Febby Trianingsih</h6>
                                                <small class="text-muted">+62 822-8643-8701</small>
                                            </div>
                                            <i class="bi bi-chevron-right text-muted"></i>
                                        </a>
                                    </div>

                                    <div class="text-center">
                                        <small class="text-muted"><i class="bi bi-clock me-1"></i>Respon cepat dalam 1-24
                                            jam</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div class="card border-0 rounded-4 shadow-sm">
                                <div class="card-body p-4 p-sm-3 p-md-4">
                                    <h5 class="fw-bold mb-3 text-center">Ikuti Kami</h5>
                                    <p class="text-muted text-center mb-4">Tetap terhubung dengan kami melalui media sosial
                                        untuk mendapatkan informasi terbaru.</p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <a class="social-icon" href="https://wa.me/+6281292936247" target="_blank">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                        <a class="social-icon" href="https://www.instagram.com/klikfarmasi.official/"
                                            target="_blank">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                        <a class="social-icon" href="https://www.tiktok.com/@klikfarmasi.official"
                                            target="_blank">
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
        </div>
    </section>

    <!-- Simple Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-1">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2" data-bs-dismiss="modal"
                        style="z-index: 1051;"></button>
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                        class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <!-- External JS for optimized performance -->
    <script src="{{ asset('js/artikel-pages.js') }}" defer></script>

@endsection
