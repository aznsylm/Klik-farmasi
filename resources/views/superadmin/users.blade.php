@extends('layouts.superadmin')
@section('title', 'Kelola Akun')
@section('content')
    <div class="container py-4">
        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi gagal -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Button Daftar Admin & Daftar Pasien -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div class="d-flex gap-2 mb-2 mb-md-0">
                        <a href="{{ route('superadmin.users', ['role' => 'admin']) }}" class="btn {{ $role == 'admin' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="bi bi-person-badge me-1"></i> Daftar Admin
                        </a>
                        <a href="{{ route('superadmin.users', ['role' => 'pasien']) }}" class="btn {{ $role == 'pasien' ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="bi bi-people me-1"></i> Daftar Pasien
                        </a>
                    </div>
                    @if($role == 'admin')
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Admin
                        </button>
                    @else
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPasien">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Pasien
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('superadmin.users') }}" class="row g-2">
                    <input type="hidden" name="role" value="{{ $role }}">
                    <div class="col-md-6 col-lg-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama, email, nomor HP..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                    <div class="col-auto">
                        @if(request('search'))
                            <a href="{{ route('superadmin.users', ['role' => $role]) }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar {{ $role == 'admin' ? 'Admin' : 'Pasien' }}</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
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
                            @forelse($users as $i => $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->nomor_hp }}</td>
                                    <td>{{ $user->jenis_kelamin }}</td>
                                    <td>{{ $user->usia }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('superadmin.userDetail', $user->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('superadmin.userEdit', $user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('superadmin.deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus {{ $role == 'admin' ? 'admin' : 'pasien' }} ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="bi bi-exclamation-circle text-muted fs-3 d-block mb-2"></i>
                                        <span class="text-muted">Belum ada {{ $role == 'admin' ? 'admin' : 'pasien' }} terdaftar.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection