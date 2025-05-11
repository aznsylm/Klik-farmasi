<!-- filepath: resources/views/admin/testimonials/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Testimonial')

@section('content')
<div class="container py-5">
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
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection