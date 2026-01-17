@extends('layouts.admin')

@section('title', 'Kelola Artikel')

@section('content')
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Artikel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Artikel</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('admin.artikel.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Artikel
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary float-right">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <!-- Articles Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-file-alt mr-1"></i> Daftar Artikel</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Kategori</th>
                                    <th>Tipe Artikel</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Views</th>
                                    <th>Waktu Publish</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articles as $article)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if ($article->image)
                                                <img src="{{ asset('storage/' . $article->image) }}"
                                                    alt="{{ $article->title }}" class="img-thumbnail"
                                                    style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-white"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $article->category }}</td>
                                        <td>
                                            @if ($article->article_type == 'kehamilan')
                                                Hipertensi Kehamilan
                                            @else
                                                Hipertensi Non-Kehamilan
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;"
                                                title="{{ $article->title }}">
                                                {{ $article->title }}
                                            </div>
                                        </td>
                                        <td>{{ $article->author }}</td>
                                        <td>
                                            <i class="fas fa-eye mr-1"></i>{{ number_format($article->views) }}
                                            @if ($article->views > 0)
                                                <button class="btn btn-sm btn-info ml-2" data-toggle="modal"
                                                    data-target="#readersModal{{ $article->id }}">
                                                    Detail
                                                </button>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($article->published_at)
                                                <small
                                                    class="text-muted">{{ $article->published_at->format('d M Y, H:i') }}</small>
                                            @else
                                                <span class="badge badge-warning">Belum dipublish</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.artikel.edit', $article->id) }}"
                                                    class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.artikel.destroy', $article->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                                                        title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-file-alt fa-3x mb-3"></i>
                                                <p class="mb-0">Belum ada artikel yang dibuat.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($articles->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Modals for Article Readers -->
    @foreach ($articles as $article)
        @if ($article->views > 0)
            <div class="modal fade" id="readersModal{{ $article->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title text-white">Pembaca Artikel</h4>
                            <button type="button" class="close text-white" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6 class="mb-3">{{ $article->title }}</h6>
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
                                            $readers = $article->getReadersByPuskesmas();
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
                                                <td colspan="3" class="text-center text-muted">Belum ada yang membaca
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
@endsection
