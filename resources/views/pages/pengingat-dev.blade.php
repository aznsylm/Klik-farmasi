@extends('layouts.app')

@section('title', 'Pengingat - Sedang Proses Pengembangan')

@section('content')
<section class="py-5" style="background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%); min-height: 100vh;">
    <div class="container px-4">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-lg-8 col-xl-6">
                <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-5 text-center">
                        <!-- Icon Animation -->
                        <div class="mb-4 position-relative">
                            <div class="development-icon-bg"></div>
                            <i class="bi bi-gear-fill development-icon" style="font-size: 4rem; color: #0b5e91;"></i>
                        </div>
                        
                        <div class="alert alert-info border-0 mb-4" style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill text-primary me-3" style="font-size: 1.5rem;"></i>
                                <div class="text-start">
                                    <h6 class="mb-1 text-primary fw-bold">Informasi Pengembangan</h6>
                                    <p class="mb-0 text-primary">Tim developer kami sedang bekerja keras untuk menghadirkan fitur pengingat minum obat yang canggih dan mudah digunakan.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Timeline -->
                        <div class="timeline mb-4">
                            <div class="timeline-item completed">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Desain UI/UX ✓</span>
                            </div>
                            <div class="timeline-item completed">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Database Design ✓</span>
                            </div>
                            <div class="timeline-item active">
                                <i class="bi bi-gear-fill"></i>
                                <span>Backend Development 🔄</span>
                            </div>
                            <div class="timeline-item">
                                <i class="bi bi-circle"></i>
                                <span>Testing & Launch</span>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="{{ route('artikel.non-kehamilan') }}" class="btn btn-outline-primary px-4 py-2 rounded-pill">
                                <i class="bi bi-journal-text me-2"></i> Baca Artikel Kesehatan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Development Page Styles */
.development-icon {
    position: relative;
    z-index: 2;
    animation: rotate 3s linear infinite;
}

.development-icon-bg {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, rgba(11, 94, 145, 0.1), rgba(186, 169, 113, 0.1));
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes pulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.7; }
    50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.3; }
}

.timeline {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    margin: 2rem 0;
}

.timeline::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 2px;
    background: #e9ecef;
    z-index: 1;
}

.timeline-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    z-index: 2;
    background: white;
    padding: 0 10px;
    font-size: 0.85rem;
}

.timeline-item.completed i {
    color: #28a745;
}

.timeline-item.active i {
    color: #baa971
    animation: spin 2s linear infinite;
}

.timeline-item i {
    font-size: 1.2rem;
    color: #6c757d;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .timeline {
        flex-direction: column;
        gap: 1rem;
    }
    
    .timeline::before {
        display: none;
    }
}
</style>
@endsection