@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<section class="py-5 bg-light">
    <div class="container px-5">
        <!-- Judul dan Narasi -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Halaman Berita</h1>
            <p class="text-muted">Temukan berita terbaru dan informasi terkini seputar kesehatan dan hipertensi di sini berdasarkan sumber-sumber terpercaya.</p>
        </div>

        <!-- Daftar Berita -->
        <h2 class="fw-bold mb-4">Semua Berita</h2>
        <div class="row gx-5 gy-4">
            @forelse ($allNews as $berita)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Konten Berita -->
                        <div class="card-body d-flex flex-column">
                            <div class="small text-muted mb-1">{{ $berita->published_at->format('d M Y') }}</div>
                            <div class="small fst-italic text-secondary mb-2">
                                <i class="bi bi-link-45deg me-1"></i>{{ $berita->source }}
                            </div>
                            <h5 class="card-title fw-bold text-dark">{{ $berita->title }}</h5>
                            <p class="card-text text-muted">{{ Str::words($berita->summary, 20, '...') }}</p>
                            <a href="{{ $berita->link }}" target="_blank" class="btn btn-primary mt-auto">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted text-center">Belum ada berita yang tersedia.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $allNews->links() }}
        </div>
    </div>
</section>

<style>
    /* Card Styling */
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #ffffff;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .card-text {
        font-size: 0.9rem;
        color: #6c757d;
        text-align: justify;
        margin-bottom: 1rem;
    }

    .card-body {
        padding: 20px;
    }

    /* Pagination Styling */
    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        color: #007bff;
    }

    .pagination .page-link:hover {
        background-color: #f8f9fa;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #0b5e91;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #084c75;
    }
</style>
@endsection