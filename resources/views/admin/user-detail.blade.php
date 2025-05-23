@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Detail User</h1>
            <p class="text-muted">Informasi lengkap tentang pengguna.</p>
        </div>

        <!-- Card Detail User -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Informasi Pengguna</h5>
                        <p class="mb-2"><strong>Nama:</strong> {{ $user->name }}</p>
                        <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-2"><strong>Nomor HP:</strong> {{ $user->nomor_hp }}</p>
                        <p class="mb-2"><strong>Jenis Kelamin:</strong> {{ $user->jenis_kelamin }}</p>
                        <p class="mb-2"><strong>Usia:</strong> {{ $user->usia }}</p>
                        <p class="mb-2"><strong>Role:</strong> {{ $user->role }}</p>
                        <p class="mb-0"><strong>Dibuat pada:</strong> {{ $user->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar User
            </a>
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