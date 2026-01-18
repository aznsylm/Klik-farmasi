@extends('layouts.admin')

@section('title', 'Kelola Testimoni')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Testimoni</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Testimoni</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Testimoni</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Testimoni
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                showToast('success', '{{ session('success') }}');
                            });
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kalimat</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testimonials as $testimonial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit($testimonial->quote, 100) }}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.testimoni.edit', $testimonial->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.testimoni.destroy', $testimonial->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus testimonial ini?')"
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
                @if ($testimonials->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $testimonials->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('components.admin.modal-scripts')
@endsection
