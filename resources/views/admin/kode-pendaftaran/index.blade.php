@extends('layouts.admin')

@section('title', 'Kelola Kode Pendaftaran')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6">
                <h1 class="m-0">Kelola Kode Pendaftaran</h1>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kode Pendaftaran</li>
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
                <h3 class="card-title">Daftar Kode Pendaftaran</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahKodeModal">
                        <i class="fas fa-plus"></i> Buat Kode Baru
                    </button>
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
                                <th>Kode</th>
                                <th>Status</th>
                                <th>Dibuat Oleh</th>
                                <th>Digunakan Oleh</th>
                                <th>Tanggal Dibuat</th>
                                <th>Tanggal Digunakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kodeList as $kode)
                                <tr>
                                    <td>{{ $loop->iteration + ($kodeList->currentPage() - 1) * $kodeList->perPage() }}</td>
                                    <td><strong>{{ $kode->kode }}</strong></td>
                                    <td>
                                        @if($kode->status == 'aktif')
                                            Aktif
                                        @elseif($kode->status == 'terpakai')
                                            Terpakai
                                        @else
                                            Nonaktif
                                        @endif
                                    </td>
                                    <td>{{ $kode->pembuatKode->name }}</td>
                                    <td>{{ $kode->penggunaKode->name ?? '-' }}</td>
                                    <td>{{ $kode->created_at->format('d M Y, H:i') }}</td>
                                    <td>{{ $kode->status == 'terpakai' && $kode->updated_at ? $kode->updated_at->format('d M Y, H:i') : '-' }}</td>
                                    <td>
                                        @if($kode->status != 'terpakai')
                                            <form action="{{ route('admin.kode-pendaftaran.update-status', $kode->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="{{ $kode->status == 'aktif' ? 'nonaktif' : 'aktif' }}">
                                                <button type="submit" class="btn btn-sm btn-{{ $kode->status == 'aktif' ? 'warning' : 'success' }}" title="{{ $kode->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    <i class="fas fa-{{ $kode->status == 'aktif' ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if($kodeList->hasPages())
            <div class="card-footer">
                <div class="d-flex justify-content-center flex-wrap">
                    {{ $kodeList->onEachSide(0)->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Modal Tambah Kode -->
<div class="modal fade" id="tambahKodeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Buat Kode Pendaftaran Baru</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.kode-pendaftaran.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jumlah_kode">Jumlah Kode yang Dibuat</label>
                        <input type="number" class="form-control" id="jumlah_kode" name="jumlah_kode" 
                               value="1" min="1" max="50" required>
                        <small class="form-text text-muted">Maksimal 50 kode dalam sekali buat</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Kode</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection