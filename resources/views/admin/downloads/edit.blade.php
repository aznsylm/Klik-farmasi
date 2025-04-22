@extends('layouts.app')

@section('title', 'Edit Unduhan')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">Edit Unduhan</h1>
    <form action="{{ route('admin.downloads.update', $download->id) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $download->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $download->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="file_link" class="form-label fw-bold">Link File</label>
            <input type="url" name="file_link" id="file_link" class="form-control" value="{{ $download->file_link }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Gambar (WebP)</label>
            <input type="file" name="image" id="image" class="form-control" accept=".webp">
            @if ($download->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $download->image) }}" alt="{{ $download->title }}" style="width: 150px; height: auto;">
                    <p class="text-muted mt-1">Gambar saat ini</p>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection