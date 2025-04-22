{{-- filepath: resources/views/admin/news/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Berita</h1>
    <form action="{{ route('admin.news.update', $news) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}" required>
        </div>
        <div class="mb-3">
            <label for="source" class="form-label">Sumber</label>
            <input type="text" name="source" id="source" class="form-control" value="{{ $news->source }}">
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ $news->link }}" required>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Waktu</label>
            <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ $news->published_at->format('Y-m-d\TH:i') }}" required>
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
@endsection