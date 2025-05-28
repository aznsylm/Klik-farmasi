@extends('layouts.app')

@section('title', 'Unduhan Modul')

@section('content')
<section class="py-4 download-section">
    <div class="container px-4">
        <!-- Breadcrumb -->
        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb custom-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}">
                            <i class="bi bi-house-door-fill me-1"></i> Beranda
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('unduhan.modul') }}">
                            <i class="bi bi-folder-symlink me-1"></i> Unduhan
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bi bi-file-earmark-text me-1"></i> Modul
                    </li>
                </ol>
            </nav>
        </div>
        <!-- End Breadcrumb -->

        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="fw-bold">Modul Informasi Hipertensi</h1>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Dapatkan materi edukasi modul tentang hipertensi untuk meningkatkan kesadaran dan kesehatan Anda.
            </p>
        </div>

        <!-- Download Cards -->
        <div class="row g-4 mb-5">
            @forelse ($downloads as $download)
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="download-card">
                        <div class="download-card-image">
                            <img src="{{ asset('storage/' . $download->image) }}" alt="{{ $download->title }}">
                            <div class="download-overlay">
                                <a href="{{ $download->file_link }}" target="_blank" class="download-btn">
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                            <div class="download-badge">Modul</div>
                        </div>
                        <div class="download-card-content">
                            <h3 class="download-title">{{ $download->title }}</h3>
                            <p class="download-description">{{ $download->description }}</p>
                            <div class="download-footer">
                                <div class="download-info">
                                    <span class="download-type">
                                        <i class="bi bi-file-earmark-pdf"></i> PDF
                                    </span>
                                    <span class="download-size">
                                        <i class="bi bi-hdd"></i> {{ rand(1, 5) }} MB
                                    </span>
                                </div>
                                <a href="{{ $download->file_link }}" target="_blank" class="btn-download">
                                    <span>Unduh</span>
                                    <i class="bi bi-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <i class="bi bi-file-earmark-x display-1 text-muted"></i>
                        <p class="mt-3 text-muted">Belum ada file modul yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection