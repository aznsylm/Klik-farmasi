@extends('layouts.app')

@section('title', 'Daftar Unduhan')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Daftar Unduhan</h1>
        <p class="text-muted">Kelola data unduhan dengan mudah di halaman ini.</p>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Tombol Tambah Unduhan -->
        <a href="{{ route('admin.downloads.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Unduhan
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

    <!-- Tabel Daftar Unduhan -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Link</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($downloads as $download)
                    <tr>
                        <td>{{ $download->title }}</td>
                        <td>{{ $download->description }}</td>
                        <td>
                            @if ($download->image)
                                <img src="{{ asset('storage/' . $download->image) }}" alt="{{ $download->title }}" style="width: 100px; height: auto;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td><a href="{{ $download->file_link }}" target="_blank">Lihat File</a></td>
                        <td class="text-center">
                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.downloads.edit', $download->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.downloads.destroy', $download->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus unduhan ini?')">
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
@endsection