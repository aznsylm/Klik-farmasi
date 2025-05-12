{{-- filepath: resources/views/admin/news/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Tambah Berita</h1>
    <form action="{{ route('admin.news.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="source" class="form-label">Sumber</label>
            <input type="text" name="source" id="source" class="form-control">
        </div>
        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" name="link" id="link" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Waktu</label>
            <input type="datetime-local" name="published_at" id="published_at" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection