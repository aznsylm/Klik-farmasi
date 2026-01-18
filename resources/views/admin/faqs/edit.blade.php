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
            <!-- Form Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Form Edit Tanya Jawab</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.tanya-jawab.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                @foreach ($errors->all() as $error)
                                    showToast('error', '{{ $error }}');
                                @endforeach
                            });
                        </script>
                    @endif

                    <form action="{{ route('admin.tanya-jawab.update', $faq) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="category" class="font-weight-bold">Kategori<span
                                    class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="" hidden>Pilih Kategori</option>
                                <option value="Hipertensi Kehamilan"
                                    {{ old('category', $faq->category) == 'Hipertensi Kehamilan' ? 'selected' : '' }}>
                                    Hipertensi Kehamilan</option>
                                <option value="Hipertensi Non-Kehamilan"
                                    {{ old('category', $faq->category) == 'Hipertensi Non-Kehamilan' ? 'selected' : '' }}>
                                    Hipertensi Non-Kehamilan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="question" class="font-weight-bold">Pertanyaan<span
                                    class="text-danger">*</span></label>
                            <x-ckeditor id="question" name="question" :value="old('question', $faq->question)" config="light" :required="true" />
                        </div>

                        <div class="form-group">
                            <label for="answer" class="font-weight-bold">Jawaban<span class="text-danger">*</span></label>
                            <x-ckeditor id="answer" name="answer" :value="old('answer', $faq->answer)" config="full" :required="true" />
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

    @include('components.admin.modal-scripts')
@endsection
