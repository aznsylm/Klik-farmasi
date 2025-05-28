@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Artikel
        </a>
    </div>

    <h1 class="fw-bold mb-4">Edit Artikel</h1>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $article->category }}" required>
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $article->slug }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label">Narasi Singkat</label>
            <textarea class="form-control" id="summary" name="summary" rows="3" required>{{ $article->summary }}</textarea>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Konten Lengkap</label>
            <textarea class="form-control" id="content" name="content" rows="6" required>{{ $article->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $article->author }}" required>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Waktu Publish</label>
            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ $article->published_at ? $article->published_at->format('Y-m-d\\TH:i') : '' }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid mt-3" style="max-width: 200px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection