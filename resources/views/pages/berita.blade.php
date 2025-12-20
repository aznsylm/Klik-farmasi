@extends('layouts.app')

@section('title', 'Berita Kesehatan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Berita kesehatan terkini tentang hipertensi dan penyakit tidak menular. Informasi terpercaya dari sumber kesehatan nasional dan internasional.">
    <meta name="keywords" content="berita kesehatan, berita hipertensi, informasi kesehatan terkini, news kesehatan, farmasi">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

@section('content')
    <section class="py-5 news-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bolder mb-3 text-primary" data-aos="fade-up">Semua Berita</h2>
                <p class="lead text-muted mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Temukan berita terbaru dan informasi terkini terkait Hipertensi maupun Kesehatan berdasarkan sumber
                    terpercaya
                </p>
                <div class="d-flex justify-content-center mt-3" data-aos="fade-up" data-aos-delay="150">
                    <div class="section-divider mx-auto"></div>
                </div>
            </div>

            <!-- News Cards -->
            <div class="row g-4">
                @forelse ($allNews as $news)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="news-card h-100">
                            <!-- Card Header -->
                            <div class="news-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="source-badge">
                                        <i class="bi bi-newspaper me-1"></i>{{ $news->source }}
                                    </span>
                                    <span class="date-badge">
                                        <i class="bi bi-clock me-1"></i>{{ $news->published_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="news-body">
                                <h5 class="news-title">{{ $news->title }}</h5>
                                
                                <!-- Read More Button -->
                                <div class="news-footer">
                                    <a href="{{ $news->link }}" target="_blank" class="read-more-btn">
                                        <span>Baca Selengkapnya</span>
                                        <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                                    </a>
                                </div>
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
            
            <!-- Custom Styles -->
            <style>
            .news-card {
                background: #ffffff;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                transition: all 0.3s ease;
                border: 1px solid #e9ecef;
                cursor: pointer;
            }
            
            .news-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            }
            
            .news-header {
                padding: 20px 20px 15px;
                background: #0B5E91;
                color: white;
            }
            
            .source-badge, .date-badge {
                font-size: 0.8rem;
                font-weight: 600;
            }
            
            .news-body {
                padding: 25px 20px 20px;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }
            
            .news-title {
                font-size: 1.1rem;
                font-weight: 700;
                line-height: 1.4;
                color: #2c3e50;
                margin-bottom: 20px;
                flex-grow: 1;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .news-footer {
                margin-top: auto;
            }
            
            .read-more-btn {
                display: inline-flex;
                align-items: center;
                color: #0B5E91;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9rem;
                transition: all 0.3s ease;
                padding: 8px 0;
            }
            
            .read-more-btn:hover {
                color: #083d5c;
                transform: translateX(5px);
            }
            
            .read-more-btn i {
                transition: transform 0.3s ease;
            }
            
            .read-more-btn:hover i {
                transform: translateX(3px);
            }
            
            /* Responsive adjustments */
            @media (max-width: 768px) {
                .news-header {
                    padding: 15px 15px 10px;
                }
                
                .news-body {
                    padding: 20px 15px 15px;
                }
            }
            </style>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $allNews->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection


