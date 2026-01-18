@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Berita</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Berita</li>
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
                    <h3 class="card-title">Daftar Berita</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Berita
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
                                    <th>Judul</th>
                                    <th>Sumber</th>
                                    <th>Link</th>
                                    <th>Waktu Publish</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $i => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->source }}</td>
                                        <td>
                                            <a href="{{ $item->link }}" target="_blank"
                                                class="btn btn-outline-info btn-xs">
                                                <i class="fas fa-external-link-alt"></i> Lihat
                                            </a>
                                        </td>
                                        <td>{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M Y, H:i') : 'Belum dipublish' }}
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.berita.edit', $item) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.berita.destroy', $item) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus berita ini?')"
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
                @if ($news->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $news->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('components.admin.modal-scripts')
@endsection
