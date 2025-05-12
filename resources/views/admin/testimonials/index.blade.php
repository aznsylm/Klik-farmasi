{{-- resources/views/admin/testimonials/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Testimonial')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Kelola Testimonial</h1>
        <p class="text-muted">Kelola testimonial dari pasien atau pengguna layanan.</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Tombol Tambah Testimonial -->
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Testimonial
        </a>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Testimonial -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Quote</th>
                    <th>Nama</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($testimonials as $testimonial)
                    <tr>
                        <td>{{ $testimonial->id }}</td>
                        <td>{{ $testimonial->quote }}</td>
                        <td>{{ $testimonial->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus testimonial ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .table {
        border-radius: 12px;
        overflow: hidden;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        transition: 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        transition: 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }
</style>
@endsection
