@extends('layouts.admin')

@section('title', 'Tambah Testimonial')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Testimonial</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.testimoni.index') }}">Testimonial</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                    <h3 class="card-title"><i class="fas fa-plus mr-1"></i> Form Tambah Testimonial</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary btn-sm">
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

                    <form action="{{ route('admin.testimoni.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="quote" class="font-weight-bold">Kalimat<span class="text-danger">*</span></label>
                            <x-ckeditor id="quote" name="quote" :value="old('quote')" config="light" :required="true" />
                        </div>

                        <div class="form-group">
                            <label for="name" class="font-weight-bold">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" required>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('components.admin.modal-scripts')
@endsection
