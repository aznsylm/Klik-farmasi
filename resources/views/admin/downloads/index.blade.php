@extends('layouts.admin')

@section('title', 'Kelola Unduhan')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kelola Unduhan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Unduhan</li>
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
                    <h3 class="card-title">Daftar Unduhan</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.unduhan.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Unduhan
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
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Views</th>
                                    <th>Link</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($downloads as $download)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $download->title }}</td>
                                        <td>{!! Str::limit(strip_tags($download->description), 50) !!}</td>
                                        <td>
                                            @if ($download->image)
                                                <img src="{{ asset('storage/' . $download->image) }}"
                                                    alt="{{ $download->title }}" class="img-thumbnail"
                                                    style="width: 80px; height: auto;">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fas fa-eye mr-1"></i>{{ number_format($download->views) }}
                                            @if ($download->views > 0)
                                                <button class="btn btn-sm btn-info ml-2" data-toggle="modal"
                                                    data-target="#readersModal{{ $download->id }}">
                                                    Detail
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ $download->file_link }}" target="_blank"
                                                class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-external-link-alt"></i> Lihat File
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.unduhan.edit', $download->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.unduhan.destroy', $download->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus unduhan ini?')"
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
                @if ($downloads->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $downloads->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Modals for Download Readers -->
    @foreach ($downloads as $download)
        @if ($download->views > 0)
            <div class="modal fade" id="readersModal{{ $download->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white">Pembaca Unduhan</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="mb-3">{{ $download->title }}</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nama Pasien</th>
                                            <th>Puskesmas</th>
                                            <th>Jumlah Akses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $readers = $download->getReadersByPuskesmas();
                                        @endphp
                                        @forelse($readers as $read)
                                            <tr>
                                                <td>{{ $read->user->name }}</td>
                                                <td>
                                                    @if ($read->user->puskesmas == 'kalasan')
                                                        Puskesmas Kalasan
                                                    @elseif($read->user->puskesmas == 'godean_2')
                                                        Puskesmas Godean 2
                                                    @elseif($read->user->puskesmas == 'umbulharjo')
                                                        Puskesmas Umbulharjo
                                                    @else
                                                        {{ $read->user->puskesmas }}
                                                    @endif
                                                </td>
                                                <td>{{ $read->access_count }}x</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada yang mengakses
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    @include('components.admin.modal-scripts')
@endsection
