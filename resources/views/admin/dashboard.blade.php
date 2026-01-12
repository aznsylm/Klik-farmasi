@extends('layouts.admin')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
<!-- Dashboard Statistics -->
<div class="row">
    <!-- Statistik Tekanan Darah -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Statistik Tekanan Darah Pasien</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="small-box bg-success" style="cursor: pointer;" data-toggle="modal" data-target="#modalNormal">
                            <div class="inner">
                                <h3>{{ $tdStats['normal']['count'] ?? 0 }}</h3>
                                <p>Normal</p>
                                <small>&lt; 120/80 mmHg</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-info" style="cursor: pointer;" data-toggle="modal" data-target="#modalTinggi">
                            <div class="inner">
                                <h3>{{ $tdStats['tinggi']['count'] ?? 0 }}</h3>
                                <p>Pre Hipertensi</p>
                                <small>120-129/80-90 mmHg</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-warning" style="cursor: pointer;" data-toggle="modal" data-target="#modalSangatTinggi">
                            <div class="inner">
                                <h3>{{ $tdStats['sangat_tinggi']['count'] ?? 0 }}</h3>
                                <p>Hipertensi Stage 1</p>
                                <small>140-159/90-99 mmHg</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-danger" style="cursor: pointer;" data-toggle="modal" data-target="#modalStage2">
                            <div class="inner">
                                <h3>0</h3>
                                <p>Hipertensi Stage 2</p>
                                <small>≥ 160/100 mmHg</small>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chart -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Distribusi TD</h3>
            </div>
            <div class="card-body">
                <div style="height: 250px; position: relative;">
                    <canvas id="tdChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Grid -->
<div class="row">
    <!-- Kelola Data Pasien -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary rounded p-3 mr-3">
                        <i class="fas fa-users text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Data Pasien</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalPasien }} pasien</small>
                <p class="card-text">Akses dan kelola data pasien dengan mudah. Pantau informasi personal, riwayat medis, dan status kesehatan secara terintegrasi.</p>
                <a href="{{ route('admin.pasien') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Data Pasien
                </a>
            </div>
        </div>
    </div>

    <!-- Kelola Kode Pendaftaran -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-success rounded p-3 mr-3">
                        <i class="fas fa-key text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Kode Pendaftaran</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalKodePendaftaran }} kode</small>
                <p class="card-text">Buat dan kelola kode pendaftaran untuk pasien baru. Kontrol akses registrasi dengan sistem kode yang aman dan terorganisir.</p>
                <a href="{{ route('admin.kode-pendaftaran.index') }}" class="btn btn-success btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Kode Pendaftaran
                </a>
            </div>
        </div>
    </div>

    <!-- Kelola Artikel -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-info rounded p-3 mr-3">
                        <i class="fas fa-file-alt text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Artikel</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalArtikel }} artikel</small>
                <p class="card-text">Buat dan publikasikan artikel kesehatan berkualitas. Berikan edukasi dan informasi terkini tentang hipertensi kepada pasien.</p>
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-info btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Artikel
                </a>
            </div>
        </div>
    </div>

    <!-- Kelola Berita -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-warning rounded p-3 mr-3">
                        <i class="fas fa-newspaper text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Berita</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalBerita }} berita</small>
                <p class="card-text">Update berita terkini seputar kesehatan dan hipertensi. Bagikan informasi penting dari sumber terpercaya kepada pengguna.</p>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-warning btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Berita
                </a>
            </div>
        </div>
    </div>

    <!-- Kelola Tanya Jawab -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-secondary rounded p-3 mr-3">
                        <i class="fas fa-question-circle text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Tanya Jawab</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalFaq }} FAQ</small>
                <p class="card-text">Sediakan jawaban untuk pertanyaan umum tentang hipertensi. Bantu pasien mendapatkan informasi yang mereka butuhkan dengan cepat.</p>
                <a href="{{ route('admin.tanya-jawab.index') }}" class="btn btn-secondary btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Tanya Jawab
                </a>
            </div>
        </div>
    </div>

    <!-- Kelola Unduhan -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-dark rounded p-3 mr-3">
                        <i class="fas fa-download text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Unduhan</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalUnduhan }} file</small>
                <p class="card-text">Sediakan materi edukasi dan panduan kesehatan yang dapat diunduh. Berikan akses mudah ke sumber informasi penting bagi pasien.</p>
                <a href="{{ route('admin.unduhan.index') }}" class="btn btn-dark btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Unduhan
                </a>
            </div>
        </div>
    </div>

    <!-- Kelola Testimoni -->
    <div class="col-lg-4 col-md-6">
        <div class="card feature-card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="bg-primary rounded p-3 mr-3">
                        <i class="fas fa-quote-left text-white fa-2x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Kelola Testimoni</h5>
                    </div>
                </div>
                <small class="text-muted d-block mb-2">{{ $totalTestimoni }} testimoni</small>
                <p class="card-text">Tampilkan pengalaman positif dari pengguna layanan. Bangun kepercayaan dan kredibilitas melalui cerita sukses pasien.</p>
                <a href="{{ route('admin.testimoni.index') }}" class="btn btn-primary btn-block">
                    <i class="fas fa-arrow-right mr-1"></i> Kelola Testimoni
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Modal Normal -->
<div class="modal fade" id="modalNormal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title text-white">Pasien dengan Tekanan Darah Normal</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($tdStats['normal']['patients']) && count($tdStats['normal']['patients']) > 0)
                    @foreach($tdStats['normal']['patients'] as $patient)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div class="d-flex align-items-center">
                            <a href="https://wa.me/{{ $patient['nomor_hp'] }}" target="_blank" class="text-success mr-2" title="Chat WhatsApp">
                                <i class="fab fa-whatsapp fa-lg"></i>
                            </a>
                            <span>{{ $patient['name'] }}</span>
                        </div>
                        <span>{{ $patient['sistol'] }}/{{ $patient['diastol'] }} mmHg</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Pre Hipertensi -->
<div class="modal fade" id="modalTinggi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-white">Pasien dengan Pre Hipertensi</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($tdStats['tinggi']['patients']) && count($tdStats['tinggi']['patients']) > 0)
                    @foreach($tdStats['tinggi']['patients'] as $patient)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div class="d-flex align-items-center">
                            <a href="https://wa.me/{{ $patient['nomor_hp'] }}" target="_blank" class="text-success mr-2" title="Chat WhatsApp">
                                <i class="fab fa-whatsapp fa-lg"></i>
                            </a>
                            <span>{{ $patient['name'] }}</span>
                        </div>
                        <span>{{ $patient['sistol'] }}/{{ $patient['diastol'] }} mmHg</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Hipertensi Stage 1 -->
<div class="modal fade" id="modalSangatTinggi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h4 class="modal-title text-white">Pasien dengan Hipertensi Stage 1</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($tdStats['sangat_tinggi']['patients']) && count($tdStats['sangat_tinggi']['patients']) > 0)
                    @foreach($tdStats['sangat_tinggi']['patients'] as $patient)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div class="d-flex align-items-center">
                            <a href="https://wa.me/{{ $patient['nomor_hp'] }}" target="_blank" class="text-success mr-2" title="Chat WhatsApp">
                                <i class="fab fa-whatsapp fa-lg"></i>
                            </a>
                            <span>{{ $patient['name'] }}</span>
                        </div>
                        <span>{{ $patient['sistol'] }}/{{ $patient['diastol'] }} mmHg</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Hipertensi Stage 2 -->
<div class="modal fade" id="modalStage2" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title text-white">Pasien dengan Hipertensi Stage 2</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted text-center">Tidak ada data</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('tdChart');
    if (ctx) {
        const data = {
            labels: ['Normal', 'Pre Hipertensi', 'Stage 1', 'Stage 2'],
            datasets: [{
                data: [
                    {{ $tdStats['normal']['count'] ?? 0 }},
                    {{ $tdStats['tinggi']['count'] ?? 0 }},
                    {{ $tdStats['sangat_tinggi']['count'] ?? 0 }},
                    0
                ],
                backgroundColor: [
                    '#28a745',
                    '#17a2b8',
                    '#ffc107', 
                    '#dc3545'
                ],
                borderWidth: 0
            }]
        };
        
        new Chart(ctx, {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }
});
</script>
    </div>
</section>
@endsection