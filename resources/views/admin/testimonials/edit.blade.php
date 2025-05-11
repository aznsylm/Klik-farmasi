@extends('layouts.app')

@section('title', isset($testimonial) ? 'Edit Testimonial' : 'Tambah Testimonial')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">{{ isset($testimonial) ? 'Edit Testimonial' : 'Tambah Testimonial' }}</h1>

    <form action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="POST">
        @csrf
        @if (isset($testimonial))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="quote" class="form-label">Quote</label>
            <textarea class="form-control" id="quote" name="quote" rows="3" required>{{ old('quote', $testimonial->quote ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection