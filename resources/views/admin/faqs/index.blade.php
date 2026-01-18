@extends('layouts.admin')

@section('title', 'Kelola Tanya Jawab')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Tanya Jawab</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tanya Jawab</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showToast('success', '{{ session('success') }}');
                    });
                </script>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar FAQ</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.tanya-jawab.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Tanya Jawab
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $faq->category }}</td>
                                        <td>{!! Str::limit(strip_tags($faq->question), 80) !!}</td>
                                        <td>{!! Str::limit(strip_tags($faq->answer), 100) !!}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.tanya-jawab.edit', $faq) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.tanya-jawab.destroy', $faq) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus FAQ ini?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($faqs->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $faqs->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('components.admin.modal-scripts')
@endsection
