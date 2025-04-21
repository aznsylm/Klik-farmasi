@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Dashboard Pasien</h1>
            <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Kelola informasi Anda di sini.</p>
        </div>

        <!-- Narasi Motivasi -->
        <div class="text-center mb-5">
            <p class="fs-5 text-muted">
                "Semangat untuk hidup lebih sehat! Hipertensi bukan akhir dari segalanya. Dengan pola hidup yang baik dan pengelolaan yang tepat, Anda bisa menjalani hidup dengan penuh semangat dan kebahagiaan."
            </p>
        </div>

        <!-- Card Dashboard -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Kembali ke Beranda</h5>
                        <p class="card-text text-muted">Akses informasi dan layanan utama kami di halaman beranda.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <i class="bi bi-house-door me-2"></i> Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Logout -->
        <div class="text-center mt-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <style>
        .card {
            border-radius: 15px;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
@endsection