@extends('layouts.app')

@section('title', 'Berita')

@section('content')
<section class="py-5 bg-light">
    <div class="container px-5">
        <!-- Judul dan Narasi -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Halaman Berita</h1>
            <p class="text-muted">Temukan berita terbaru dan informasi terkini seputar kesehatan dan hipertensi di sini.</p>
        </div>

        <!-- Button Kembali -->
        <div class="mb-4">
            <a href="{{ route('artikel') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Artikel
            </a>
        </div>

        <!-- Daftar Berita -->
        <h2 class="fw-bolder fs-5 mb-4">Semua Berita</h2>
        <div class="row gx-5">
            <div class="col-12">
                @forelse ($allNews as $berita)
                    <div class="mb-4">
                        <div class="small text-muted">{{ $berita->published_at->format('d M Y') }}</div>
                        <a class="link-dark" href="{{ $berita->link }}" target="_blank">
                            <h3>{{ $berita->title }}</h3>
                        </a>
                        <div class="small text-muted"><i>{{ $berita->source }}</i></div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada berita yang tersedia.</p>
                @endforelse
                <div class="mt-4">
                    {{ $allNews->links() }} <!-- Pagination -->
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Button Styling */
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Section Styling */
    .text-center h1 {
        font-size: 2.5rem;
        color: #333;
    }

    .text-center p {
        font-size: 1rem;
        color: #6c757d;
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
</style>
@endsection