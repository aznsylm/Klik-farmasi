@extends('layouts.app')

@section('title', 'Tambah Unduhan')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">Tambah Unduhan</h1>
    <form action="{{ route('admin.downloads.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="file_link" class="form-label fw-bold">Link File</label>
            <input type="url" name="file_link" id="file_link" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Gambar (Masukkan Gambar Dengan Format *WebP)</label>
            <input type="file" name="image" id="image" class="form-control" accept=".webp">
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>
        </div>
    </form>
</div>
@endsection