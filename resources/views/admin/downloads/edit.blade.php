@extends('layouts.admin')

@section('title', 'Edit Unduhan')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Unduhan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.unduhan.index') }}">Unduhan</a></li>
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
                    <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Form Edit Unduhan</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.unduhan.index') }}" class="btn btn-secondary btn-sm">
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

                    <form action="{{ route('admin.unduhan.update', $download->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Judul<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="{{ old('title', $download->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description" class="font-weight-bold">Deskripsi<span
                                    class="text-danger">*</span></label>
                            <x-ckeditor id="description" name="description" :value="old('description', $download->description)" config="medium"
                                :required="true" />
                        </div>

                        <div class="form-group">
                            <label for="file_link" class="font-weight-bold">Link File<span
                                    class="text-danger">*</span></label>
                            <input type="url" name="file_link" id="file_link" class="form-control"
                                value="{{ old('file_link', $download->file_link) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image" class="font-weight-bold">Gambar<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" accept=".webp">
                            @if ($download->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $download->image) }}" alt="{{ $download->title }}"
                                        class="img-fluid" style="max-width: 200px;">
                                    <p class="text-muted mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <small class="text-muted">Masukkan Gambar Dengan Format *WebP</small>
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
