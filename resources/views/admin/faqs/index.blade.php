{{-- filepath: resources/views/admin/faqs/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola FAQ')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Kelola FAQ</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Tombol Tambah FAQ -->
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">Tambah FAQ</a>
        
            <!-- Tombol Kembali ke Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{ $faq->id }}</td>
                        <td>{{ $faq->category }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus FAQ ini?')">Hapus</button>
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
        border-radius: 10px;
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
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e0a800;
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
