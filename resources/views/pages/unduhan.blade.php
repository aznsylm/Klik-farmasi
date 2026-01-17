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
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="download-card h-100">
                            <!-- Image Section -->
                            <div class="download-image-container">
                                <img src="{{ asset('storage/' . $download->image) }}"
                                    alt="{{ $download->title }} - Materi edukasi hipertensi untuk download" 
                                    class="download-image" loading="lazy" decoding="async">
                                <div class="download-overlay">
                                    <div class="download-badge">
                                        <i class="bi bi-file-earmark-arrow-down me-2"></i>GRATIS
                                    </div>
                                    <a href="{{ route('download.track', $download->id) }}" target="_blank" class="quick-download-btn">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Content Section -->
                            <div class="download-content">
                                <div class="download-header">
                                    <span class="file-type-badge">
                                        <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                    </span>
                                </div>
                                
                                <h3 class="download-title">{{ $download->title }}</h3>
                                <p class="download-description">{{ $download->description }}</p>
                                
                                <!-- Download Button -->
                                <div class="download-footer">
                                    <a href="{{ route('download.track', $download->id) }}" target="_blank" class="download-btn-main">
                                        <i class="bi bi-cloud-download me-2"></i>
                                        <span>Download Sekarang</span>
                                        <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state text-center py-5">
                            <i class="bi bi-file-earmark-x display-1 text-muted"></i>
                            <p class="mt-3 text-muted">Belum ada file yang tersedia untuk diunduh.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Custom Styles -->
            <style>
            .download-card {
                background: #ffffff;
                border: 1px solid #e9ecef;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                transition: all 0.4s ease;
                cursor: pointer;
                overflow: hidden;
            }
            
            .download-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 12px 35px rgba(0,0,0,0.15);
            }
            
            .download-image-container {
                position: relative;
                height: 200px;
                overflow: hidden;
            }
            
            .download-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }
            
            .download-card:hover .download-image {
                transform: scale(1.1);
            }
            
            .download-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(11, 94, 145, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            
            .download-card:hover .download-overlay {
                opacity: 1;
            }
            
            .download-badge {
                position: absolute;
                top: 15px;
                left: 15px;
                background: #28a745;
                color: white;
                padding: 6px 12px;
                font-size: 0.8rem;
                font-weight: bold;
            }
            
            .quick-download-btn {
                background: white;
                color: #0B5E91;
                width: 60px;
                height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                text-decoration: none;
                transition: all 0.3s ease;
            }
            
            .quick-download-btn:hover {
                background: #0B5E91;
                color: white;
                transform: scale(1.1);
            }
            
            .download-content {
                padding: 25px 20px;
                display: flex;
                flex-direction: column;
                height: calc(100% - 200px);
            }
            
            .download-header {
                margin-bottom: 15px;
            }
            
            .file-type-badge {
                background: #0B5E91;
                color: white;
                padding: 4px 10px;
                font-size: 0.75rem;
                font-weight: 600;
            }
            
            .download-title {
                font-size: 1.2rem;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 12px;
                line-height: 1.3;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .download-description {
                color: #6c757d;
                font-size: 0.9rem;
                line-height: 1.5;
                margin-bottom: 15px;
                flex-grow: 1;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            

            .download-footer {
                margin-top: auto;
            }
            
            .download-btn-main {
                display: flex;
                align-items: center;
                justify-content: center;
                background: #0B5E91;
                color: white;
                padding: 12px 20px;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9rem;
                transition: all 0.3s ease;
                width: 100%;
            }
            
            .download-btn-main:hover {
                background: #083d5c;
                color: white;
                transform: translateY(-2px);
            }
            
            .download-btn-main i:last-child {
                transition: transform 0.3s ease;
            }
            
            .download-btn-main:hover i:last-child {
                transform: translateX(5px);
            }
            
            /* Responsive */
            @media (max-width: 768px) {
                .download-content {
                    padding: 20px 15px;
                }
                

                
                .download-btn-main {
                    padding: 10px 15px;
                    font-size: 0.85rem;
                }
            }
            </style>
            <div class="mt-5 d-flex justify-content-center">
                <div class="pagination-wrapper">
                    {{ $downloads->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection


