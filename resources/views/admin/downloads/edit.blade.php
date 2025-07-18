@extends('layouts.admin')

@section('title', 'Edit Unduhan')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.downloads.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Unduhan
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Unduhan</h5>
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
            
            <form action="{{ route('admin.downloads.update', $download->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $download->title) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $download->description) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="file_link" class="form-label">Link File</label>
                    <input type="url" name="file_link" id="file_link" class="form-control" value="{{ old('file_link', $download->file_link) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <input type="file" name="image" id="image" class="form-control" accept=".webp">
                    @if ($download->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $download->image) }}" alt="{{ $download->title }}" class="img-fluid mt-2" style="max-width: 200px;">
                            <p class="text-muted">Gambar saat ini</p>
                        </div>
                    @endif
                    <small class="text-muted">Masukkan Gambar Dengan Format *WebP</small>
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