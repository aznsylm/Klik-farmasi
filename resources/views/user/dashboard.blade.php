@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4 position-relative bg-gradient-primary text-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2 fw-bold">Selamat datang kembali, {{ Auth::user()->name }}!</h2>
                            <p class="mb-0 opacity-90">Pantau kesehatan Anda hari ini dan jaga tekanan darah tetap terkontrol</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-circle bg-success-soft">
                                <i class="bi bi-heart-fill text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Tekanan Darah Terakhir</h6>
                            <h4 class="mb-0 fw-bold">120/80 mmHg</h4>
                            <small class="text-success">Normal</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-circle bg-info-soft">
                                <i class="bi bi-calendar-check-fill text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Konsultasi Berikutnya</h6>
                            <h4 class="mb-0 fw-bold">3 Hari</h4>
                            <small class="text-info">15 Jun 2024</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-circle bg-warning-soft">
                                <i class="bi bi-capsule-pill text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Obat Hari Ini</h6>
                            <h4 class="mb-0 fw-bold">2/3</h4>
                            <small class="text-warning">1 terlewat</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-circle bg-primary-soft">
                                <i class="bi bi-clipboard2-pulse text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Diagnosa</h6>
                            <h4 class="mb-0 fw-bold">Hipertensi</h4>
                            <small class="text-primary">Non-Komplikasi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Quick Actions -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-lightning-charge-fill text-primary me-2"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-primary w-100 py-3 text-start">
                                <i class="bi bi-plus-circle-fill me-3"></i>
                                <div>
                                    <strong>Catat Tekanan Darah</strong>
                                    <br><small class="text-muted">Input pengukuran terbaru</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-success w-100 py-3 text-start">
                                <i class="bi bi-calendar-plus-fill me-3"></i>
                                <div>
                                    <strong>Jadwalkan Konsultasi</strong>
                                    <br><small class="text-muted">Buat janji dengan dokter</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-info w-100 py-3 text-start">
                                <i class="bi bi-journal-medical me-3"></i>
                                <div>
                                    <strong>Riwayat Medis</strong>
                                    <br><small class="text-muted">Lihat catatan kesehatan</small>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-outline-warning w-100 py-3 text-start">
                                <i class="bi bi-bell-fill me-3"></i>
                                <div>
                                    <strong>Pengingat Obat</strong>
                                    <br><small class="text-muted">Atur alarm minum obat</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Daftar Obat -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-capsule text-primary me-2"></i>
                        Daftar Obat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Dosis</th>
                                    <th>Frekuensi</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Amlodipine</td>
                                    <td>5mg</td>
                                    <td>1x sehari</td>
                                    <td>Pagi</td>
                                    <td><span class="badge bg-success">Diminum</span></td>
                                </tr>
                                <tr>
                                    <td>Captopril</td>
                                    <td>25mg</td>
                                    <td>2x sehari</td>
                                    <td>Siang</td>
                                    <td><span class="badge bg-warning">Belum</span></td>
                                </tr>
                                <tr>
                                    <td>Hydrochlorothiazide</td>
                                    <td>12.5mg</td>
                                    <td>1x sehari</td>
                                    <td>Malam</td>
                                    <td><span class="badge bg-danger">Terlewat</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Tekanan Darah Dicatat</h6>
                                <p class="text-muted mb-1">120/80 mmHg - Normal</p>
                                <small class="text-muted">2 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Obat Diminum</h6>
                                <p class="text-muted mb-1">Amlodipine 5mg</p>
                                <small class="text-muted">5 jam yang lalu</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Konsultasi Selesai</h6>
                                <p class="text-muted mb-1">Dr. Sarah - Kontrol rutin</p>
                                <small class="text-muted">2 hari yang lalu</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Data Pasien -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-person-badge text-primary me-2"></i>
                        Data Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Nama</span>
                            <span class="fw-medium">Ahmad Fauzi</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Usia</span>
                            <span class="fw-medium">45 tahun</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Jenis Kelamin</span>
                            <span class="fw-medium">Laki-laki</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span class="text-muted">Nomor WhatsApp</span>
                            <span class="fw-medium">+62 812-3456-7890</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Pengingat -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-alarm-fill text-danger me-2"></i>
                        Pengingat Obat Hari Ini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning border-0 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-capsule-pill fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Captopril 25mg</h6>
                                <p class="mb-0 small">Siang - 13:00</p>
                            </div>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info border-0 mb-0">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-capsule-pill fs-4"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Hydrochlorothiazide 12.5mg</h6>
                                <p class="mb-0 small">Malam - 19:00</p>
                            </div>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Kesehatan -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                        Tips Hari Ini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="bg-light rounded p-3">
                        <h6 class="text-primary mb-2"><i class="bi bi-droplet-fill me-2"></i> Minum Air yang Cukup</h6>
                        <p class="mb-0 small">Konsumsi 8-10 gelas air putih setiap hari membantu menjaga tekanan darah tetap stabil dan mendukung fungsi ginjal yang optimal.</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="bi bi-house-door-fill me-2"></i> Kembali ke Beranda
                        </a>
                        <form action="#" method="POST" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Poppins', sans-serif;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0b5e91 0%, #1a8ad2 100%);
    }

    .card {
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.1) !important;
    }

    .btn {
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* Icon circles */
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .bg-primary-soft {
        background-color: rgba(11, 94, 145, 0.15);
    }
    
    .bg-success-soft {
        background-color: rgba(56, 176, 0, 0.15);
    }
    
    .bg-info-soft {
        background-color: rgba(0, 180, 216, 0.15);
    }
    
    .bg-warning-soft {
        background-color: rgba(255, 183, 3, 0.15);
    }
    
    .bg-danger-soft {
        background-color: rgba(217, 4, 41, 0.15);
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        height: 100%;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }

    .timeline-marker {
        position: absolute;
        left: -25px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 2px #e9ecef;
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border-left: 3px solid #dee2e6;
    }
    
    .alert {
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    /* Health theme colors */
    .text-primary {
        color: #0b5e91 !important;
    }
    
    .btn-outline-primary {
        color: #0b5e91;
        border-color: #0b5e91;
    }
    
    .btn-outline-primary:hover {
        background-color: #0b5e91;
        border-color: #0b5e91;
    }
    
    .bg-primary {
        background-color: #0b5e91 !important;
    }
    
    .text-success {
        color: #38b000 !important;
    }
    
    .text-info {
        color: #00b4d8 !important;
    }
    
    .text-warning {
        color: #ffb703 !important;
    }
    
    .text-danger {
        color: #d90429 !important;
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .card-body .row .col-md-6 {
            margin-bottom: 10px;
        }
    }
</style>
@endsection