@extends('layouts.app')
@section('title', 'Unduhan Materi Kesehatan - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Download gratis materi edukasi hipertensi, poster kesehatan, dan panduan pengelolaan tekanan darah tinggi dari ahli farmasi Universitas Alma Ata.">
    <meta name="keywords" content="download materi hipertensi, poster kesehatan, edukasi hipertensi, materi farmasi, panduan kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush
@section('content')
    <section class="py-5 download-section">
        <div class="container px-4">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h2 class="fw-bolder mb-3 text-primary">Unduhan Informasi Hipertensi</h2>
                <p class="lead text-muted mx-auto" style="max-width:700px;">
                    Dapatkan materi edukasi tentang hipertensi untuk meningkatkan kesadaran dan kesehatan Anda.
                </p>
                <div class="d-flex justify-content-center mt-3">
                    <div class="section-divider"></div>
                </div>
            </div>
            <!-- Download Cards -->
            <div class="row g-4 mb-5">
                @forelse ($downloads as $download)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="download-card">
                            <div class="download-card-image"><img src="{{ asset('storage/' . $download->image) }}"
                                    alt="{{ $download->title }} - Materi edukasi hipertensi untuk download" class="lazy-image" loading="lazy" decoding="async" width="400" height="240">
                                <div class="download-overlay"><a href="{{ $download->file_link }}" target="_blank"
                                        class="download-btn" aria-label="Download {{ $download->title }}"><i class="bi bi-download" aria-hidden="true"></i></a></div>
                            </div>
                            <div class="download-card-content">
                                <h3 class="download-title">{{ $download->title }}</h3>
                                <p class="download-description">{{ $download->description }}</p>
                                <div class="download-footer"><a href="{{ $download->file_link }}" target="_blank"
                                        class="btn-download"><span>Unduh</span><i class="bi bi-download"></i></a>
                            </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state text-center py-5"><i class="bi bi-file-earmark-x display-1 text-muted"></i>
                            <p class="mt-3 text-muted">Belum ada file yang tersedia untuk diunduh.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $downloads->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection


