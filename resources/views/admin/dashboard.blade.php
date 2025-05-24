@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Dashboard Admin</h1>
        <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
        <p class="text-muted fst-italic">"Semangat membantu orang lain untuk terus sembuh dan hidup lebih sehat."</p>
    </div>

    <!-- Cards -->
    <div class="row justify-content-center g-4">
        <!-- Card Kelola Data Pasien -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-primary">
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kelola Data Pasien</h5>
                    <p class="card-text text-muted">Lihat dan kelola data pengguna di sistem.</p>
                    <a href="{{ route('admin.users') }}" class="btn btn-primary w-100">
                        <i class="bi bi-people-fill me-2"></i> Kelola Data User
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Kelola Artikel -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-success">
                        <i class="bi bi-file-earmark-text fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kelola Artikel</h5>
                    <p class="card-text text-muted">Lihat, tambahkan, dan kelola artikel di sistem.</p>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-success w-100">
                        <i class="bi bi-file-earmark-text me-2"></i> Kelola Artikel
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Kelola Berita -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-info">
                        <i class="bi bi-newspaper fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kelola Berita</h5>
                    <p class="card-text text-muted">Lihat, tambahkan, dan kelola berita di sistem.</p>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-info w-100">
                        <i class="bi bi-newspaper me-2"></i> Kelola Berita
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Kelola Tanya Jawab -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-warning">
                        <i class="bi bi-question-circle fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kelola Tanya Jawab</h5>
                    <p class="card-text text-muted">Lihat, tambahkan, dan kelola tanya jawab di sistem.</p>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-warning w-100">
                        <i class="bi bi-question-circle me-2"></i> Kelola Tanya Jawab
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Kelola Unduhan -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-primary">
                        <i class="bi bi-cloud-arrow-down fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kelola Unduhan</h5>
                    <p class="card-text text-muted">Lihat, tambahkan, dan kelola file unduhan di sistem.</p>
                    <a href="{{ route('admin.downloads.index') }}" class="btn btn-primary w-100">
                        <i class="bi bi-cloud-arrow-down me-2"></i> Kelola Unduhan
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Kelola Testimoni -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-secondary">
                        <i class="bi bi-chat-left-quote fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Kelola Testimoni</h5>
                    <p class="card-text text-muted">Lihat, tambahkan, dan kelola testimoni pengguna.</p>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-chat-left-quote me-2"></i> Kelola Testimoni
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Logout -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-body text-center">
                    <div class="icon mb-3 text-danger">
                        <i class="bi bi-box-arrow-right fs-1"></i>
                    </div>
                    <h5 class="card-title fw-bold">Logout</h5>
                    <p class="card-text text-muted">Keluar dari sistem dengan aman.</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .icon {
        font-size: 2.5rem;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-info:hover {
        background-color: #117a8b;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }
</style>
@endsection