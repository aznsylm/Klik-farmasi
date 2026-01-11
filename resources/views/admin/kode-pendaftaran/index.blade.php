@extends('layouts.admin')

@section('title', 'Kelola Kode Pendaftaran')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kelola Kode Pendaftaran</h1>
            </div>
            <div class="col-sm-6">
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
                    <a href="{{ route('admin.kode-pendaftaran.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Kode Baru
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
                                                    {{ $kode->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">Sudah Digunakan</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    {{ $kodeList->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection