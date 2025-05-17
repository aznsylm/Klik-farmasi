@extends('layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Tambah Artikel</h1>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Narasi Singkat</label>
            <textarea class="form-control" id="summary" name="summary" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Konten Lengkap</label>
            <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Waktu Publish</label>
            <input type="datetime-local" class="form-control" id="published_at" name="published_at">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image" accept=".webp">
            <small class="text-muted">Hanya file dengan format .webp yang diperbolehkan.</small>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection