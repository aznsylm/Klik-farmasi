@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<section class="py-5 news-section">
    <div class="container px-4">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="fw-bolder" data-aos="fade-up">Semua Berita</h1>
            <p class="text-muted mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
                Temukan berita terbaru dan informasi terkini seputar kesehatan dan hipertensi di sini berdasarkan sumber-sumber terpercaya.
            </p>
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
            {{ $allNews->links() }}
        </div>
    </div>
</section>

<style>
    /* News Section Styling */
    .news-section {
        background-color: #f8f9fa;
        background-image: radial-gradient(#0d6efd10 1px, transparent 1px);
        background-size: 20px 20px;
    }
    
    /* News Card Styling */
    .news-card {
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        height: 100%;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        border-top: 4px solid #0b5e91;
    }
    
    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    
    .news-card-header {
        display: flex;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .news-source, .news-date {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .news-source i, .news-date i {
        margin-right: 0.5rem;
        font-size: 0.9rem;
    }
    
    .news-card-body {
        padding: 1.5rem;
        flex-grow: 1;
    }
    
    .news-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-summary {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .news-card-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid rgba(0,0,0,0.05);
        background-color: #f8f9fa;
    }
    
    .news-link {
        color: #0b5e91;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s ease;
    }
    
    .news-link i {
        transition: transform 0.2s ease;
    }
    
    .news-link:hover {
        color: #084c75;
    }
    
    .news-link:hover i {
        transform: translateX(4px);
    }
    
    /* Pagination Styling */
    .pagination {
        gap: 0.5rem;
    }
    
    .page-item.active .page-link {
        background-color: #0b5e91;
        border-color: #0b5e91;
    }
    
    .page-link {
        color: #0b5e91;
        border-radius: 6px;
        border: none;
        padding: 0.5rem 0.75rem;
        font-weight: 500;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .page-link:hover {
        background-color: #e9ecef;
        color: #084c75;
    }
    
    /* Empty State */
    .empty-state {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 3rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .news-card-header {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .news-title {
            font-size: 1.1rem;
        }
        
        .news-summary {
            -webkit-line-clamp: 2;
        }
    }
</style>
@endsection