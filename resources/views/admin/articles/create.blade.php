@extends('layouts.admin')

@section('title', 'Tambah Artikel')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Artikel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Back Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Artikel
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-plus mr-1"></i> Form Tambah Artikel</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            
            <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="category" class="font-weight-bold">Kategori<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="article_type" class="font-weight-bold">Tipe Artikel<span class="text-danger">*</span></label>
                        <select class="form-control" id="article_type" name="article_type" required>
                            <option value="" disabled selected>Pilih Tipe Artikel</option>
                            <option value="kehamilan" {{ old('article_type') == 'kehamilan' ? 'selected' : '' }}>Hipertensi Kehamilan</option>
                            <option value="non-kehamilan" {{ old('article_type') == 'non-kehamilan' ? 'selected' : '' }}>Hipertensi Non-Kehamilan</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="title" class="font-weight-bold">Judul<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="content" class="font-weight-bold">Narasi Lengkap<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="author" class="font-weight-bold">Penulis<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="published_at" class="font-weight-bold">Waktu Publish<span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="image" class="font-weight-bold">Gambar</label>
                    <input type="file" class="form-control" id="image" name="image" accept=".webp">
                    <small class="text-muted">Hanya file dengan format .webp yang diperbolehkan.</small>
                </div>
                
                <div class="text-right mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    
    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
            slugInput.value = slugify(titleInput.value);
        });
    }
    
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
@endsection