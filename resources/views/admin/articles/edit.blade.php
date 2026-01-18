@extends('layouts.admin')

@section('title', 'Edit Artikel')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Artikel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.artikel.index') }}">Artikel</a></li>
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
                    <h3 class="card-title"><i class="fas fa-edit mr-1"></i> Form Edit Artikel</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.artikel.index') }}" class="btn btn-secondary btn-sm">
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

                    <form action="{{ route('admin.artikel.update', $article->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category" class="font-weight-bold">Kategori<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="category" name="category"
                                        value="{{ old('category', $article->category) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="article_type" class="font-weight-bold">Tipe Artikel<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="article_type" name="article_type" required>
                                        <option value="" disabled>Pilih Tipe Artikel</option>
                                        <option value="kehamilan"
                                            {{ old('article_type', $article->article_type) == 'kehamilan' ? 'selected' : '' }}>
                                            Hipertensi Kehamilan</option>
                                        <option value="non-kehamilan"
                                            {{ old('article_type', $article->article_type) == 'non-kehamilan' ? 'selected' : '' }}>
                                            Hipertensi Non-Kehamilan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="font-weight-bold">Judul<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $article->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="content" class="font-weight-bold">Narasi Lengkap<span
                                    class="text-danger">*</span></label>
                            <x-ckeditor id="content" name="content" :value="old('content', $article->content)" config="full" :required="true" />
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="author" class="font-weight-bold">Penulis<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        value="{{ old('author', $article->author) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="published_at" class="font-weight-bold">Waktu Publish<span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                        value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\\TH:i') : '') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="font-weight-bold">Gambar<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="image" name="image" accept=".webp">
                            @if ($article->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        class="img-fluid" style="max-width: 200px;">
                                    <p class="text-muted mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <small class="text-muted">Hanya file dengan format .webp yang diperbolehkan.</small>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            if (titleInput && slugInput) {
                titleInput.addEventListener('input', function() {
                    slugInput.value = slugify(titleInput.value);
                });
            }

            function slugify(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-') // Replace spaces with -
                    .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                    .replace(/\-\-+/g, '-') // Replace multiple - with single -
                    .replace(/^-+/, '') // Trim - from start of text
                    .replace(/-+$/, ''); // Trim - from end of text
            }
        });
    </script>

    @include('components.admin.modal-scripts')
@endsection
