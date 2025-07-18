@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);
    }
    
    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .bg-success-soft { background-color: rgba(40, 167, 69, 0.1); }
    .bg-info-soft { background-color: rgba(23, 162, 184, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
    .bg-primary-soft { background-color: rgba(11, 94, 145, 0.1); }
    
    .card {
        border-radius: 15px;
        transition: transform 0.2s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    .data-card {
        background: #f8f9fa;
        border-left: 4px solid #0b5e91;
    }
</style>

<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 bg-gradient-primary text-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2 fw-bold">Selamat datang kembali, {{ Auth::user()->name }}!</h2>
                            <p class="mb-0">Pantau kesehatan Anda hari ini dan jaga tekanan darah tetap terkontrol</p>
                            <small class="opacity-75">Terakhir login: {{ Auth::user()->updated_at->format('d M Y, H:i') }} WIB</small>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="me-3">
                                    <h6 class="mb-1">Status Akun</h6>
                                    <span class="badge bg-success">Aktif</span>
                                </div>
                                <div class="icon-circle" style="background: rgba(255,255,255,0.2);">
                                    <i class="bi bi-person-check text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row mb-4">
        <!-- Tekanan Darah Card -->
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
                            <h4 class="mb-0 fw-bold">{{ $latestPengingat->tekanan_darah ?? 'Belum ada data' }}</h4>
                            <small class="text-success">
                                @if($latestPengingat && $latestPengingat->tekanan_darah)
                                    @php
                                        $tekananDarah = $latestPengingat->tekanan_darah;
                                        if (preg_match('/(\d+)\/(\d+)/', $tekananDarah, $matches)) {
                                            $sistol = intval($matches[1]);
                                            $diastol = intval($matches[2]);
                                            if ($sistol < 120 && $diastol < 80) echo "Normal";
                                            elseif ($sistol < 130 && $diastol < 85) echo "Pre-hipertensi";
                                            else echo "Hipertensi";
                                        }
                                    @endphp
                                @else
                                    Belum diukur
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Total Obat -->
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
                            <h6 class="text-muted mb-1">Total Jenis Obat</h6>
                            @php
                                $totalObat = $latestPengingat ? $latestPengingat->detailObat->count() : 0;
                            @endphp
                            <h4 class="mb-0 fw-bold">{{ $totalObat }}</h4>
                            <small class="text-warning">Jenis obat berbeda</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Status Pengingat -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="icon-circle bg-info-soft">
                                <i class="bi bi-bell-fill text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Status Pengingat</h6>
                            <h4 class="mb-0 fw-bold">{{ $latestPengingat ? 'Aktif' : 'Belum Ada' }}</h4>
                            <small class="text-info">{{ $latestPengingat ? 'Pengingat berjalan' : 'Buat pengingat' }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Diagnosa Card -->
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
                            <h4 class="mb-0 fw-bold" style="font-size: 1rem;">
                                {{ $latestPengingat ? str_replace('-', ' ', $latestPengingat->diagnosa) : 'Belum ada' }}
                            </h4>
                            <small class="text-primary">
                                {{ $latestPengingat ? \Carbon\Carbon::parse($latestPengingat->tanggal_mulai)->format('d M Y') : 'Tanggal tidak ada' }}
                            </small>
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
            
            <!-- Data Pengingat Obat -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-transparent border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-clipboard2-data text-primary me-2"></i>
                        Data Pengingat Obat
                    </h5>
                </div>
                <div class="card-body">
                    @if($latestPengingat)
                        <div class="p-3 data-card rounded">
                            <!-- Header Pengingat -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h6 class="mb-1 fw-bold text-primary">
                                        <i class="bi bi-file-medical me-1"></i>
                                        Pengingat Obat Aktif
                                    </h6>
                                    <small class="text-muted">
                                        Dibuat: {{ \Carbon\Carbon::parse($latestPengingat->created_at)->format('d M Y, H:i') }} WIB
                                    </small>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <span class="badge bg-success">Aktif</span>
                                </div>
                            </div>

                            <!-- Data Medis -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-clipboard2-pulse text-info me-2"></i>
                                        <strong>Diagnosa:</strong>
                                        <span class="ms-2">{{ str_replace('-', ' ', $latestPengingat->diagnosa) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-activity text-danger me-2"></i>
                                        <strong>Tekanan Darah:</strong>
                                        <span class="ms-2 fw-bold">{{ $latestPengingat->tekanan_darah }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal & Catatan -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-calendar-event text-success me-2"></i>
                                        <strong>Tanggal Mulai:</strong>
                                        <span class="ms-2">{{ \Carbon\Carbon::parse($latestPengingat->tanggal_mulai)->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($latestPengingat->catatan)
                                        <div class="d-flex align-items-start mb-2">
                                            <i class="bi bi-chat-left-text text-warning me-2 mt-1"></i>
                                            <div>
                                                <strong>Catatan:</strong>
                                                <p class="mb-0 ms-2 small">{{ $latestPengingat->catatan }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Daftar Obat -->
                            <div class="mb-3">
                                <h6 class="mb-3 fw-bold">
                                    <i class="bi bi-capsule text-primary me-2"></i>
                                    Daftar Obat ({{ $latestPengingat->detailObat->count() }} jenis)
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Nama Obat</th>
                                                <th width="15%">Jumlah</th>
                                                <th width="20%">Waktu Minum</th>
                                                <th width="20%">Suplemen</th>
                                                <th width="10%">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($latestPengingat->detailObat as $key => $obat)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="fw-medium">{{ $obat->nama_obat }}</td>
                                                <td>
                                                    <span class="badge bg-info">{{ $obat->jumlah_obat }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark">
                                                        <i class="bi bi-clock me-1"></i>
                                                        {{ $obat->waktu_minum }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($obat->suplemen)
                                                        <span class="badge bg-success">{{ $obat->suplemen }}</span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $obat->status_obat == 'aktif' ? 'success' : ($obat->status_obat == 'habis' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($obat->status_obat) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            Belum ada data pengingat obat. 
                            <a href="{{ route('pengingat') }}" class="alert-link">Buat pengingat pertama Anda</a>
                        </div>
                    @endif
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
                        Profil Pasien
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="icon-circle mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 100%);">
                            <i class="bi bi-person-fill text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="fw-bold">{{ $user->name }}</h5>
                        <p class="text-muted mb-0">Pasien Hipertensi</p>
                    </div>
                    
                    <div class="row g-2">
                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="bi bi-person text-primary me-2"></i>Nama
                                </span>
                                <span class="fw-medium">{{ $user->name }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="bi bi-calendar text-primary me-2"></i>Usia
                                </span>
                                <span class="fw-medium">{{ $user->usia }} tahun</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="bi bi-gender-ambiguous text-primary me-2"></i>Jenis Kelamin
                                </span>
                                <span class="fw-medium">{{ $user->jenis_kelamin }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="bi bi-whatsapp text-primary me-2"></i>WhatsApp
                                </span>
                                <span class="fw-medium">{{ $user->nomor_hp }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">
                                    <i class="bi bi-envelope text-primary me-2"></i>Email
                                </span>
                                <span class="fw-medium">{{ $user->email }}</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between py-2">
                                <span class="text-muted">
                                    <i class="bi bi-calendar-check text-primary me-2"></i>Bergabung
                                </span>
                                <span class="fw-medium">{{ $user->created_at->format('M Y') }}</span>
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
                        Tips Kesehatan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="bg-light rounded p-3">
                        <h6 class="text-primary mb-2">
                            <i class="bi bi-droplet-fill me-2"></i>
                            Minum Air yang Cukup
                        </h6>
                        <p class="mb-0 small">Konsumsi 8-10 gelas air putih setiap hari untuk menjaga tekanan darah stabil dan mendukung fungsi ginjal yang optimal.</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('logout') }}" method="POST" class="mb-0">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple hover effect for cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    console.log('Dashboard loaded successfully!');
});
</script>
@endsection