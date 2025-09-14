@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Testimonial
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Testimonial</h5>
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
            
            <form action="{{ route('admin.testimoni.update', $testimonial->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="quote" class="form-label">Kalimat<span style="color: red">*</span></label>
                    <textarea class="form-control" id="quote" name="quote" rows="4" required>{{ old('quote', $testimonial->quote) }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama<span style="color: red">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $testimonial->name) }}" required>
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
