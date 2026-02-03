@extends('layouts.medicio')
@section('title', 'Berita - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Berita terkini seputar kesehatan, hipertensi, dan perkembangan platform Klik Farmasi dari Universitas Alma Ata.">
    <meta name="keywords"
        content="berita, hipertensi, kesehatan, farmasi, universitas alma ata, perkembangan, informasi terkini">
    <meta name="author" content="Klik Farmasi - Universitas Alma Ata">
@endpush

@section('content')
    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1>Berita Klik Farmasi</h1>
                        <p class="mb-0">Informasi terkini seputar kesehatan, hipertensi, dan perkembangan platform Klik
                            Farmasi dari tim farmasi Universitas Alma Ata</p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ route('beranda') }}">Beranda</a></li>
                    <li class="current">Berita</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">

        <div class="container">
            <div class="row gy-4">
                @forelse($news as $berita)
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 + 100 }}">
                        <article class="position-relative h-100">
                            <div class="post-content d-flex flex-column">
                                <h3 class="post-title">{{ $berita->title }}</h3>

                                <div class="meta d-flex align-items-center flex-wrap gap-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-building"></i>
                                        <span>{{ $berita->source ?? 'Tim Farmasi UAA' }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-calendar3"></i>
                                        <span>{{ $berita->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <a href="{{ $berita->link ?? '#' }}" target="_blank" class="readmore">
                                    <span>Baca Selengkapnya</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-newspaper" style="font-size: 3rem; color: #ddd;"></i>
                            <h4 class="mt-3">Belum Ada Berita</h4>
                            <p class="text-muted">Berita akan segera hadir. Silakan kembali lagi nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($news->hasPages())
                <div class="pagination-wrapper text-center mt-5" data-aos="fade-up">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($news->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">
                                        <i class="bi bi-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $news->previousPageUrl() }}">
                                        <i class="bi bi-chevron-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($news->getUrlRange(1, $news->lastPage()) as $page => $url)
                                @if ($page == $news->currentPage())
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
                            @if ($news->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $news->nextPageUrl() }}">
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

    </section><!-- /Blog Posts Section -->

    <!-- Call to Action Section -->
    <section id="call-to-action" class="call-to-action section accent-background">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Mulai Kelola Hipertensi Anda Hari Ini</h3>
                        <p>Jangan biarkan hipertensi menguasai hidup Anda. Bergabunglah dengan pengguna yang telah
                            merasakan manfaat Klik Farmasi dalam mengelola tekanan darah tinggi.</p>
                        <a class="cta-btn" href="{{ route('pengingat') }}">Buat Pengingat Obat</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call to Action Section -->

@endsection

@push('scripts')
    <script>
        // Custom JavaScript untuk halaman berita medicio jika diperlukan
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Halaman Berita Medicio Template siap!');
        });
    </script>
@endpush

@push('head')
    <style>
        /* Medicio Blog Posts Style tanpa gambar */
        .blog-posts .post-content {
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 0 25px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-posts .post-title {
            font-size: 24px;
            font-weight: 700;
            padding: 0;
            margin: 0 0 20px 0;
            color: var(--heading-color);
        }

        .blog-posts .post-title:hover {
            color: var(--accent-color);
        }

        .blog-posts .meta {
            margin-bottom: 20px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            font-size: 14px;
        }

        .blog-posts .meta i {
            font-size: 16px;
            margin-right: 8px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
        }

        .blog-posts .readmore {
            margin-top: auto;
            background: var(--accent-color);
            color: var(--contrast-color);
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
            align-self: flex-start;
        }

        .blog-posts .readmore:hover {
            background: color-mix(in srgb, var(--accent-color), transparent 20%);
            color: var(--contrast-color);
        }

        .blog-posts .readmore i {
            font-size: 16px;
            margin-left: 5px;
        }
    </style>
@endpush
