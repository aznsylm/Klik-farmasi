@extends('layouts.admin')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Testimonial
        </a>
    </div>

    <h1 class="fw-bold mb-4">Tambah Testimonial</h1>

    <form action="{{ route('admin.testimonials.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="quote" class="form-label">Quote</label>
            <textarea class="form-control" id="quote" name="quote" rows="3" required>{{ old('quote') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection