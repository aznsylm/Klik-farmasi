@extends('layouts.admin')

@section('title', 'Tambah Artikel')

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
            <h5 class="mb-0">Tambah Artikel</h5>
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
            
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="category" class="form-label">Kategori<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="article_type" class="form-label">Tipe Artikel<span style="color: red">*</span></label>
                        <select class="form-select" id="article_type" name="article_type" required>
                            <option value="" disabled selected>Pilih Tipe Artikel</option>
                            <option value="kehamilan" {{ old('article_type') == 'kehamilan' ? 'selected' : '' }}>Hipertensi Kehamilan</option>
                            <option value="non-kehamilan" {{ old('article_type') == 'non-kehamilan' ? 'selected' : '' }}>Hipertensi Non-Kehamilan</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul<span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Narasi Lengkap<span style="color: red">*</span></label>
                    <textarea class="form-control" id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="author" class="form-label">Penulis<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Waktu Publish<span style="color: red">*</span></label>
                        <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar<span style="color: red">*</span></label>
                    <input type="file" class="form-control" id="image" name="image" accept=".webp">
                    <small class="text-muted">Hanya file dengan format .webp yang diperbolehkan.</small>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
                
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const titleInput = document.getElementById('title');
                    const slugInput = document.getElementById('slug');
                    
                    titleInput.addEventListener('input', function() {
                        slugInput.value = slugify(titleInput.value);
                    });
                    
                    function slugify(text) {
                        return text.toString().toLowerCase()
                            .replace(/\s+/g, '-')           // Replace spaces with -
                            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                            .replace(/^-+/, '')             // Trim - from start of text
                            .replace(/-+$/, '');            // Trim - from end of text
                    }
                });
                </script>
            </form>
        </div>
    </div>
</div>
@endsection