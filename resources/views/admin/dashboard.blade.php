@extends('layouts.admin')

@section('content')
    
    <!-- Dashboard Statistics -->
    <div class="row mb-4">
        <!-- Statistik Tekanan Darah -->
        <div class="col-lg-8">
            <h5 class="mb-3">Statistik Tekanan Darah Pasien</h5>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card bg-primary text-white h-100" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalNormal">
                        <div class="card-body text-center">
                            <h3 class="mb-1">{{ $tdStats['normal']['count'] ?? 0 }}</h3>
                            <p class="mb-0">TD Normal</p>
                            <small>&lt; 140/90 mmHg</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-info text-white h-100" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalTinggi">
                        <div class="card-body text-center">
                            <h3 class="mb-1">{{ $tdStats['tinggi']['count'] ?? 0 }}</h3>
                            <p class="mb-0">TD Tinggi</p>
                            <small>140-179/90-109 mmHg</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-white h-100" style="background-color: #0d6efd; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalSangatTinggi">
                        <div class="card-body text-center">
                            <h3 class="mb-1">{{ $tdStats['sangat_tinggi']['count'] ?? 0 }}</h3>
                            <p class="mb-0">TD Sangat Tinggi</p>
                            <small>≥ 180/110 mmHg</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Chart -->
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="card-title">Distribusi TD</h6>
                    <div style="height: 250px; position: relative;">
                        <canvas id="tdChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="features-grid">
        <!-- Kelola Data Pasien -->
        <div class="feature-card users">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h3 class="feature-title">Kelola Data Pasien</h3>
            </div>
            <p class="feature-description">
                Akses dan kelola data pasien dengan mudah. Pantau informasi personal, riwayat medis, dan status kesehatan secara terintegrasi.
            </p>
            <a href="{{ route('admin.pasien') }}" class="feature-action">
                Kelola Data Pasien
            </a>
        </div>

        <!-- Kelola Kode Pendaftaran -->
        <div class="feature-card codes">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-key-fill"></i>
                </div>
                <h3 class="feature-title">Kelola Kode Pendaftaran</h3>
            </div>
            <p class="feature-description">
                Buat dan kelola kode pendaftaran untuk pasien baru. Kontrol akses registrasi dengan sistem kode yang aman dan terorganisir.
            </p>
            <a href="{{ route('admin.kode-pendaftaran.index') }}" class="feature-action">
                Kelola Kode Pendaftaran
            </a>
        </div>

        <!-- Kelola Artikel -->
        <div class="feature-card articles">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <h3 class="feature-title">Kelola Artikel</h3>
            </div>
            <p class="feature-description">
                Buat dan publikasikan artikel kesehatan berkualitas. Berikan edukasi dan informasi terkini tentang hipertensi kepada pasien.
            </p>
            <a href="{{ route('admin.artikel.index') }}" class="feature-action">
                Kelola Artikel
            </a>
        </div>

        <!-- Kelola Berita -->
        <div class="feature-card news">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h3 class="feature-title">Kelola Berita</h3>
            </div>
            <p class="feature-description">
                Update berita terkini seputar kesehatan dan hipertensi. Bagikan informasi penting dari sumber terpercaya kepada pengguna.
            </p>
            <a href="{{ route('admin.berita.index') }}" class="feature-action">
                Kelola Berita
            </a>
        </div>

        <!-- Kelola Tanya Jawab -->
        <div class="feature-card faqs">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-question-circle"></i>
                </div>
                <h3 class="feature-title">Kelola Tanya Jawab</h3>
            </div>
            <p class="feature-description">
                Sediakan jawaban untuk pertanyaan umum tentang hipertensi. Bantu pasien mendapatkan informasi yang mereka butuhkan dengan cepat.
            </p>
            <a href="{{ route('admin.tanya-jawab.index') }}" class="feature-action">
                Kelola Tanya Jawab
            </a>
        </div>

        <!-- Kelola Unduhan -->
        <div class="feature-card downloads">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-cloud-arrow-down"></i>
                </div>
                <h3 class="feature-title">Kelola Unduhan</h3>
            </div>
            <p class="feature-description">
                Sediakan materi edukasi dan panduan kesehatan yang dapat diunduh. Berikan akses mudah ke sumber informasi penting bagi pasien.
            </p>
            <a href="{{ route('admin.unduhan.index') }}" class="feature-action">
                Kelola Unduhan
            </a>
        </div>

        <!-- Kelola Testimoni -->
        <div class="feature-card testimonials">
            <div class="feature-header">
                <div class="feature-icon">
                    <i class="bi bi-chat-left-quote"></i>
                </div>
                <h3 class="feature-title">Kelola Testimoni</h3>
            </div>
            <p class="feature-description">
                Tampilkan pengalaman positif dari pengguna layanan. Bangun kepercayaan dan kredibilitas melalui cerita sukses pasien.
            </p>
            <a href="{{ route('admin.testimoni.index') }}" class="feature-action">
                Kelola Testimoni
            </a>
        </div>
    </div>

    <!-- Modals -->
<!-- Modal TD Normal -->
<div class="modal fade" id="modalNormal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Pasien dengan TD Normal</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if(isset($tdStats['normal']['patients']) && count($tdStats['normal']['patients']) > 0)
                    @foreach($tdStats['normal']['patients'] as $patient)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>{{ $patient['name'] }}</span>
                        <span class="badge bg-success">{{ $patient['sistol'] }}/{{ $patient['diastol'] }} mmHg</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal TD Tinggi -->
<div class="modal fade" id="modalTinggi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Pasien dengan TD Tinggi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if(isset($tdStats['tinggi']['patients']) && count($tdStats['tinggi']['patients']) > 0)
                    @foreach($tdStats['tinggi']['patients'] as $patient)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>{{ $patient['name'] }}</span>
                        <span class="badge bg-warning">{{ $patient['sistol'] }}/{{ $patient['diastol'] }} mmHg</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal TD Sangat Tinggi -->
<div class="modal fade" id="modalSangatTinggi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: #0d6efd;">
                <h5 class="modal-title">Pasien dengan TD Sangat Tinggi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if(isset($tdStats['sangat_tinggi']['patients']) && count($tdStats['sangat_tinggi']['patients']) > 0)
                    @foreach($tdStats['sangat_tinggi']['patients'] as $patient)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <span>{{ $patient['name'] }}</span>
                        <span class="badge bg-danger">{{ $patient['sistol'] }}/{{ $patient['diastol'] }} mmHg</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted text-center">Tidak ada data</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('tdChart');
    if (ctx) {
        const data = {
            labels: ['Normal', 'Tinggi', 'Sangat Tinggi'],
            datasets: [{
                data: [
                    {{ $tdStats['normal']['count'] ?? 0 }},
                    {{ $tdStats['tinggi']['count'] ?? 0 }},
                    {{ $tdStats['sangat_tinggi']['count'] ?? 0 }}
                ],
                backgroundColor: [
                    '#007bff',
                    '#17a2b8', 
                    '#0d6efd'
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
@endsection