@extends('layouts.app')

@section('title', 'Kelola Artikel')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Kelola Artikel</h1>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Tambah Artikel</a>
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
                    <th>Judul</th>
                    <th>Link</th>
                    <th>Waktu Ditambahkan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->category }}</td>
                        <td>{{ $article->title }}</td>
                        <td><a href="{{ $article->link }}" target="_blank">Lihat Artikel</a></td>
                        <td>{{ $article->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tombol Kembali ke Halaman Sebelumnya -->
    <div class="text-center mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>

<style>
    /* Font Family */
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Tabel */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background-color: #343a40;
        color: #fff;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    /* Tombol */
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