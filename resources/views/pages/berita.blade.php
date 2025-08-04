@extends('layouts.app')

@section('title', 'Berita')

@section('content')
    <section class="py-5 news-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bolder mb-3" style="color: #0b5e91;" data-aos="fade-up">Semua Berita</h2>
                <p class="lead text-muted mx-auto"
                    style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;" data-aos="fade-up"
                    data-aos-delay="100">
                    Temukan berita terbaru dan informasi terkini seputar kesehatan dan hipertensi di sini berdasarkan
                    sumber-sumber terpercaya.
                </p>
                <div class="d-flex justify-content-center mt-3" data-aos="fade-up" data-aos-delay="150">
                    <div
                        style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;">
                    </div>
                </div>
            </div>

            <!-- News Cards -->
            <div class="row g-4">
                @forelse ($allNews as $berita)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="news-card">
                            <div class="news-card-header">
                                <div class="news-source">
                                    <i class="bi bi-newspaper"></i>
                                    <span>{{ $berita->source }}</span>
                                </div>
                                <div class="news-date">
                                    <i class="bi bi-calendar3"></i>
                                    <span>{{ $berita->published_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="news-card-body">
                                <h3 class="news-title">{{ $berita->title }}</h3>
                                <p class="news-summary">{{ Str::words($berita->summary, 20, '...') }}</p>
                            </div>
                            <div class="news-card-footer">
                                <a href="{{ $berita->link }}" target="_blank" class="news-link">
                                    <span>Baca Selengkapnya</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state text-center py-5">
                            <i class="bi bi-newspaper display-1 text-muted"></i>
                            <p class="mt-3 text-muted">Belum ada berita yang tersedia.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $allNews->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

    <style>
        /* News Card Styling */
        .news-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .news-card-header {
            padding: 1.5rem 1.5rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .news-source,
        .news-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .news-source i,
        .news-date i {
            color: #0b5e91;
        }

        .news-card-body {
            padding: 1.5rem;
            flex-grow: 1;
        }

        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0b5e91;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .news-summary {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .news-card-footer {
            padding: 0 1.5rem 1.5rem;
            margin-top: auto;
        }

        .news-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #0b5e91;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .news-link:hover {
            color: #baa971;
        }

        .news-link i {
            transition: transform 0.3s ease;
        }

        .news-link:hover i {
            transform: translateX(3px);
        }

        /* Pagination Styling */
        .pagination-wrapper {
            margin: 2rem 0;
        }

        .pagination-wrapper .pagination {
            margin: 0;
            gap: 0.25rem;
        }

        .pagination-wrapper .page-link {
            border: 2px solid #e9ecef;
            color: #0b5e91;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .pagination-wrapper .page-link:hover {
            background-color: #0b5e91;
            border-color: #0b5e91;
            color: white;
            transform: translateY(-2px);
        }

        .pagination-wrapper .page-item.active .page-link {
            background-color: #0b5e91;
            border-color: #0b5e91;
            color: white;
            box-shadow: 0 4px 15px rgba(11, 94, 145, 0.3);
        }

        .pagination-wrapper .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #f8f9fa;
            border-color: #e9ecef;
            cursor: not-allowed;
        }

        .pagination-wrapper .page-item.disabled .page-link:hover {
            transform: none;
            background-color: #f8f9fa;
            border-color: #e9ecef;
            color: #6c757d;
        }

        /* Empty State */
        .empty-state {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .news-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .pagination-wrapper .page-link {
                padding: 0.5rem 0.75rem;
                font-size: 0.9rem;
            }
        }
    </style>
@endsection
