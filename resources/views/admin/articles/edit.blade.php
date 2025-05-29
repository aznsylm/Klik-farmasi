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

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Artikel</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $article->category) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="summary" class="form-label">Narasi Singkat</label>
                    <textarea class="form-control" id="summary" name="summary" rows="3" required>{{ old('summary', $article->summary) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Konten Lengkap</label>
                    <textarea class="form-control" id="content" name="content" rows="6" required>{{ old('content', $article->content) }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $article->author) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Waktu Publish</label>
                        <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\\TH:i') : '') }}">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="image" name="image" accept=".webp">
                    @if ($article->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="img-fluid mt-2" style="max-width: 200px;">
                            <p class="text-muted">Gambar saat ini</p>
                        </div>
                    @endif
                    <small class="text-muted">Hanya file dengan format .webp yang diperbolehkan.</small>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection