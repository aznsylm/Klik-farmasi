@extends('layouts.app')

@section('title', 'Edit Artikel')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4 text-center">Edit Artikel</h1>
    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" class="shadow p-4 rounded bg-light">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category" class="form-label fw-bold">Kategori</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ $article->category }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $article->title }}" required>
        </div>
        <div class="mb-3">
            <label for="summary" class="form-label fw-bold">Narasi Singkat</label>
            <textarea name="summary" id="summary" class="form-control" rows="3" required>{{ $article->summary }}</textarea>
        </div>
        <div class="mb-3">
            <label for="link" class="form-label fw-bold">Link</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ $article->link }}" required>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<style>
    /* Form Styling */
    .form-label {
        font-size: 1rem;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Button Styling */
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Container Styling */
    .shadow {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rounded {
        border-radius: 10px;
    }
</style>
@endsection