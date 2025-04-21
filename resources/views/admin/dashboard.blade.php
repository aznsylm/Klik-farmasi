@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Dashboard Admin</h1>
            <p class="text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Kelola data dengan mudah di sini.</p>
        </div>

        <div class="row justify-content-center">
            <!-- Card Kelola Data User -->
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Kelola Data User</h5>
                        <p class="card-text text-muted">Lihat dan kelola data pengguna di sistem.</p>
                        <a href="{{ route('admin.users') }}" class="btn btn-primary w-100">
                            <i class="bi bi-people-fill me-2"></i> Kelola Data User
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Logout -->
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
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
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #a71d2a;
        }
    </style>
@endsection