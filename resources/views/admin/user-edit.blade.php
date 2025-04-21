@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Edit User</h1>
            <p class="text-muted">Perbarui informasi pengguna di sini.</p>
        </div>

        <!-- Form Edit User -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <form action="{{ route('admin.userUpdate', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama:</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save me-2"></i> Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.users') }}" class="btn btn-primary">
                                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar User
                                </a>
                            </div>
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

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }
    </style>
@endsection