@extends('layouts.admin')

@section('title', 'Daftar Pasien')

@section('content')
    <div class="container py-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Daftar Pasien</h1>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
            <!-- Tombol Tambah Pasien -->
            <a href="{{ route('admin.pasienCreate') }}" class="btn btn-primary mb-2">Tambah Pasien
            </a>
            <!-- Fitur Pencarian -->
            <form method="GET" action="{{ route('admin.pasien') }}" class="d-flex gap-2 mb-2 flex-grow-1" style="max-width:400px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari ..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
            </form>
            <!-- Tombol Kembali ke Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Tabel Daftar User -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $i => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nomor_hp }}</td>
                            <td>{{ $user->jenis_kelamin }}</td>
                            <td>{{ $user->usia }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.pasienDetail', $user->id) }}" class="btn btn-info btn-sm me-1">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.pasienEdit', $user->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.deletePasien', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pasien.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <style>
        /* Tabel */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #343a40;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }

        /* Pagination Style */
        .pagination {
            justify-content: center;
        }
        .pagination .page-item .page-link {
            color: #0b5e91;
            border-radius: 6px;
            margin: 0 2px;
            border: 1px solid #e2e8f0;
            transition: background 0.2s, color 0.2s;
        }
        .pagination .page-item.active .page-link {
            background: #0b5e91;
            color: #fff;
            border-color: #0b5e91;
        }
        .pagination .page-item .page-link:hover {
            background: #e6f2fa;
            color: #0b5e91;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }
            .btn {
                font-size: 0.7rem;
                padding: 5px 10px;
            }
        }
    </style>
@endsection