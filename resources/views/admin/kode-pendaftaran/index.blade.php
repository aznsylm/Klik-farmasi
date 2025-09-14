@extends('layouts.admin')

@section('title', 'Kelola Kode Pendaftaran')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Kelola Kode Pendaftaran</h1>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.kode-pendaftaran.create') }}" class="btn btn-primary">
                Buat Kode Baru
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
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
                                <span class="badge bg-success">Aktif</span>
                            @elseif($kode->status == 'terpakai')
                                <span class="badge bg-info">Terpakai</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>{{ $kode->pembuatKode->name }}</td>
                        <td>{{ $kode->penggunaKode->name ?? '-' }}</td>
                        <td>{{ $kode->created_at->format('d M Y, H:i') }}</td>
                        <td>{{ $kode->digunakan_pada ? $kode->digunakan_pada->format('d M Y, H:i') : '-' }}</td>
                        <td>
                            @if($kode->status != 'terpakai')
                                <form action="{{ route('admin.kode-pendaftaran.update-status', $kode->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="{{ $kode->status == 'aktif' ? 'nonaktif' : 'aktif' }}">
                                    <button type="submit" class="btn btn-sm btn-{{ $kode->status == 'aktif' ? 'warning' : 'success' }}">
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

    {{ $kodeList->links() }}
</div>
@endsection