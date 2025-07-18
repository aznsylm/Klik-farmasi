@extends('layouts.app')

@section('title', 'Tim Pengelola')

@section('content')
<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bolder mb-3" style="color: #0b5e91;">Tim Pengelola Klik Farmasi</h2>
        <p class="lead text-muted mx-auto" style="font-family: 'Open Sans', sans-serif; max-width: 700px; margin: 0 auto;">Kenali tim mahasiswa Farmasi Universitas Alma Ata yang mengelola platform ini</p>
        <div class="d-flex justify-content-center mt-3">
            <div style="width: 80px; height: 4px; background: linear-gradient(90deg, #0b5e91, #baa971); border-radius: 2px;"></div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="row g-4 mb-5">
        <!-- Team Member 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px; border: 5px solid #f8f9fa;">
                            <img src="{{ asset('assets/ProfilePerson.png') }}" alt="Team Member" class="img-fluid">
                        </div>
                        <h4 class="fw-bold" style="color: #0b5e91;">Nama Mahasiswa 1</h4>
                        <p class="text-muted mb-0">Ketua Tim</p>
                    </div>
                    <p class="text-muted">Mahasiswa Farmasi Universitas Alma Ata yang fokus pada pengembangan platform edukasi kesehatan.</p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Member 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px; border: 5px solid #f8f9fa;">
                            <img src="{{ asset('assets/ProfilePerson.png') }}" alt="Team Member" class="img-fluid">
                        </div>
                        <h4 class="fw-bold" style="color: #0b5e91;">Nama Mahasiswa 2</h4>
                        <p class="text-muted mb-0">Anggota Tim</p>
                    </div>
                    <p class="text-muted">Mahasiswa Farmasi Universitas Alma Ata yang fokus pada konten edukasi hipertensi.</p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Member 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="mb-4">
                        <div class="rounded-circle overflow-hidden mx-auto mb-3" style="width: 150px; height: 150px; border: 5px solid #f8f9fa;">
                            <img src="{{ asset('assets/ProfilePerson.png') }}" alt="Team Member" class="img-fluid">
                        </div>
                        <h4 class="fw-bold" style="color: #0b5e91;">Nama Mahasiswa 3</h4>
                        <p class="text-muted mb-0">Anggota Tim</p>
                    </div>
                    <p class="text-muted">Mahasiswa Farmasi Universitas Alma Ata yang fokus pada pengembangan fitur pengingat obat.</p>
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-linkedin"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-circle">
                            <i class="bi bi-envelope"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Supervisor Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4" style="color: #0b5e91;">Dosen Pembimbing</h3>
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-4 mb-md-0">
                            <div class="rounded-circle overflow-hidden mx-auto" style="width: 150px; height: 150px; border: 5px solid #f8f9fa;">
                                <img src="{{ asset('assets/ProfilePerson.png') }}" alt="Supervisor" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h4 class="fw-bold">Nama Dosen Pembimbing</h4>
                            <p class="text-muted mb-3">Dosen Fakultas Farmasi Universitas Alma Ata</p>
                            <p>Dosen pembimbing yang memberikan arahan dan bimbingan dalam pengembangan platform Klik Farmasi sebagai media edukasi hipertensi dan pengingat obat.</p>
                            <div class="d-flex gap-2 mt-3">
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-linkedin me-1"></i> LinkedIn
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-envelope me-1"></i> Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Project Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4" style="color: #0b5e91;">Tentang Proyek</h3>
                    <p>Klik Farmasi adalah platform edukasi kesehatan yang dikembangkan oleh mahasiswa Farmasi Universitas Alma Ata. Platform ini berfokus pada edukasi hipertensi dan menyediakan fitur pengingat minum obat untuk membantu pasien hipertensi mengelola pengobatan mereka.</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-lightbulb text-white fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold">Visi</h5>
                                    <p class="text-muted mb-0">Menjadi platform edukasi kesehatan terdepan yang membantu masyarakat dalam mengelola hipertensi dan meningkatkan kualitas hidup.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-bullseye text-white fs-4"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fw-bold">Misi</h5>
                                    <p class="text-muted mb-0">Menyediakan informasi kesehatan yang akurat, mudah dipahami, dan dapat diakses oleh semua kalangan masyarakat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.3s ease;
    border-radius: 15px;
}

.card:hover {
    transform: translateY(-5px);
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
</style>
@endsection