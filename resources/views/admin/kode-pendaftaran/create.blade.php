@extends('layouts.admin')

@section('title', 'Buat Kode Pendaftaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header btn-primary text-white text-center py-4">
                    <h2 class="mb-0 fw-bold">Buat Kode Pendaftaran Baru</h2>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('admin.kode-pendaftaran.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="jumlah_kode" class="form-label fw-bold">Jumlah Kode yang Dibuat</label>
                            <input type="number" class="form-control @error('jumlah_kode') is-invalid @enderror" 
                                   id="jumlah_kode" name="jumlah_kode" value="{{ old('jumlah_kode', 1) }}" 
                                   min="1" max="50" required>
                            <div class="form-text">Maksimal 50 kode dalam sekali buat</div>
                            @error('jumlah_kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Buat Kode Pendaftaran
                            </button>
                            <a href="{{ route('admin.kode-pendaftaran.index') }}" class="btn btn-outline-secondary">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection