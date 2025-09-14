@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Kelola Berita</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <!-- Tombol Tambah Berita -->
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">Tambah Berita</a>

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
                    <th>No</th>
                    <th>Judul</th>
                    <th>Sumber</th>
                    <th>Link</th>
                    <th>Waktu Publish</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $i => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->source }}</td>
                        <td>
                            <a href="{{ $item->link }}" target="_blank" class="text-decoration-underline">Lihat</a>
                        </td>
                        <td>{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y, H:i') : 'Belum dipublish' }}</td>
                        <td>
                            <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
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
        text-align: left;
    }
</style>
@endsection