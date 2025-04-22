{{-- filepath: resources/views/admin/faqs/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit FAQ</h1>
    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" id="category" class="form-control" required>
                <option value="Tentang Hipertensi" {{ $faq->category == 'Tentang Hipertensi' ? 'selected' : '' }}>Tentang Hipertensi</option>
                <option value="Pentingnya Minum Obat" {{ $faq->category == 'Pentingnya Minum Obat' ? 'selected' : '' }}>Pentingnya Minum Obat</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="question" class="form-label">Pertanyaan</label>
            <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}" required>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">Jawaban</label>
            <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ $faq->answer }}</textarea>
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