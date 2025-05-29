@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar FAQ
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit FAQ</h5>
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
            
            <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select name="category" id="category" class="form-select" required>
                        <option value="" disabled>Pilih Kategori</option>
                        <option value="Tentang Hipertensi" {{ old('category', $faq->category) == 'Tentang Hipertensi' ? 'selected' : '' }}>Tentang Hipertensi</option>
                        <option value="Pentingnya Minum Obat" {{ old('category', $faq->category) == 'Pentingnya Minum Obat' ? 'selected' : '' }}>Pentingnya Minum Obat</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="question" class="form-label">Pertanyaan</label>
                    <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="answer" class="form-label">Jawaban</label>
                    <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
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