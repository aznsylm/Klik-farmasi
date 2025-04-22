@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah FAQ</h1>
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select name="category" id="category" class="form-control" required>
                <option value="Tentang Hipertensi">Tentang Hipertensi</option>
                <option value="Pentingnya Minum Obat">Pentingnya Minum Obat</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="question" class="form-label">Pertanyaan</label>
            <input type="text" name="question" id="question" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="answer" class="form-label">Jawaban</label>
            <textarea name="answer" id="answer" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection