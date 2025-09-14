@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Berita
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Berita</h5>
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
            
            <form action="{{ route('admin.berita.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Judul<span style="color: red">*</span></label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="source" class="form-label">Sumber<span style="color: red">*</span></label>
                        <input type="text" name="source" id="source" class="form-control" value="{{ old('source') }}">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="link" class="form-label">Link<span style="color: red">*</span></label>
                        <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Waktu<span style="color: red">*</span></label>
                        <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}" required>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection