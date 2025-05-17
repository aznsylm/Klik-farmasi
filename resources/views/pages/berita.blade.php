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
@endsection