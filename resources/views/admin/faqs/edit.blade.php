@extends('layouts.admin')

@section('title', 'Edit Tanya Jawab')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Tanya Jawab</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tanya-jawab.index') }}">Tanya Jawab</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Back Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('admin.tanya-jawab.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Tanya Jawab
                </a>
            </div>
        </div>

        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Form Edit Tanya Jawab</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('admin.tanya-jawab.update', $faq) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="category" class="font-weight-bold">Kategori<span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="" hidden>Pilih Kategori</option>
                            <option value="Hipertensi Kehamilan" {{ old('category', $faq->category) == 'Hipertensi Kehamilan' ? 'selected' : '' }}>Hipertensi Kehamilan</option>
                            <option value="Hipertensi Non-Kehamilan" {{ old('category', $faq->category) == 'Hipertensi Non-Kehamilan' ? 'selected' : '' }}>Hipertensi Non-Kehamilan</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="question" class="font-weight-bold">Pertanyaan<span class="text-danger">*</span></label>
                        <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="answer" class="font-weight-bold">Jawaban<span class="text-danger">*</span></label>
                        <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
                    </div>
                    
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
