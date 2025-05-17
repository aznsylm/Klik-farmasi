@extends('layouts.app')

@section('title', 'Unduhan Flayer')

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
                        <a href="{{ route('unduhan.flayer') }}">
                            <i class="bi bi-folder-symlink me-1"></i> Unduhan
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="bi bi-file-earmark-image me-1"></i> Flyer
                    </li>
                </ol>
            </nav>
        </div>
        <!-- End Breadcrumb -->

        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="fw-bolder">Flyer Informasi Hipertensi</h1>
            <p class="text-muted mx-auto" style="max-width: 700px;">
                Dapatkan flyer edukasi tentang hipertensi untuk meningkatkan kesadaran dan kesehatan Anda.
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
                            <div class="download-badge">Flyer</div>
                        </div>
                        <div class="download-card-content">
                            <h3 class="download-title">{{ $download->title }}</h3>
                            <p class="download-description">{{ $download->description }}</p>
                            <div class="download-footer">
                                <div class="download-info">
                                    <span class="download-type">
                                        <i class="bi bi-file-earmark-image"></i> JPG/PNG
                                    </span>
                                    <span class="download-size">
                                        <i class="bi bi-hdd"></i> {{ rand(1, 3) }} MB
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
                        <p class="mt-3 text-muted">Belum ada file flyer yang tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    /* Download Section Styling */
    .download-section {
        background-color: #f8f9fa;
        background-image: radial-gradient(#0d6efd10 1px, transparent 1px);
        background-size: 20px 20px;
    }
    
    /* Header Icon */
    .download-icon {
        width: 80px;
        height: 80px;
        background-color: #0b5e91;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 2.5rem;
    }
    
    /* Custom Breadcrumb */
    .custom-breadcrumb {
        background-color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 0;
    }
    
    .custom-breadcrumb .breadcrumb-item a {
        color: #0b5e91;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .custom-breadcrumb .breadcrumb-item a:hover {
        color: #084c75;
    }
    
    .custom-breadcrumb .breadcrumb-item.active {
        color: #6c757d;
    }
    
    .custom-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        color: #6c757d;
    }
    
    /* Download Card Styling */
    .download-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        height: 100%;
        transition: all 0.3s ease;
    }
    
    .download-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .download-card-image {
        position: relative;
        overflow: hidden;
        height: 240px;
    }
    
    .download-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .download-card:hover .download-card-image img {
        transform: scale(1.05);
    }
    
    .download-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(11, 94, 145, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .download-card:hover .download-overlay {
        opacity: 1;
    }
    
    .download-btn {
        width: 60px;
        height: 60px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0b5e91;
        font-size: 1.5rem;
        transform: scale(0.8);
        opacity: 0;
        transition: all 0.3s ease 0.1s;
    }
    
    .download-card:hover .download-btn {
        transform: scale(1);
        opacity: 1;
    }
    
    .download-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background-color: #0b5e91;
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
    }
    
    .download-card-content {
        padding: 1.5rem;
    }
    
    .download-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }
    
    .download-description {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .download-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
    }
    
    .download-info {
        display: flex;
        gap: 1rem;
    }
    
    .download-type, .download-size {
        display: flex;
        align-items: center;
        color: #6c757d;
        font-size: 0.85rem;
    }
    
    .download-type i, .download-size i {
        margin-right: 0.35rem;
    }
    
    .btn-download {
        display: flex;
        align-items: center;
        background-color: #0b5e91;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    
    .btn-download:hover {
        background-color: #084c75;
        color: white;
    }
    
    .btn-download i {
        margin-left: 0.5rem;
        transition: transform 0.2s ease;
    }
    
    .btn-download:hover i {
        transform: translateY(2px);
    }
    
    /* Empty State */
    .empty-state {
        background-color: white;
        border-radius: 12px;
        padding: 3rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .download-card-image {
            height: 180px;
        }
        
        .download-title {
            font-size: 1.1rem;
        }
        
        .download-footer {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .btn-download {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection