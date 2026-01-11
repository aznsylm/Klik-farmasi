@extends('layouts.admin')
@section('title', 'Daftar Admin')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Admin</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-times-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Navigation Tabs -->
        <div class="card">
            <div class="card-header p-0">
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('superadmin.admin') }}">
                            <i class="fas fa-user-shield mr-1"></i> Daftar Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('superadmin.pasien') }}">
                            <i class="fas fa-users mr-1"></i> Daftar Pasien
                        </a>
                    </li>
                    <li class="nav-item ml-auto">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAdmin">
                            <i class="fas fa-plus mr-1"></i> Tambah Admin
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Search Card -->
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('superadmin.admin') }}" class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari nama, email, nomor HP..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if (request('search'))
                            <a href="{{ route('superadmin.admin') }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-shield mr-1"></i>
                    Daftar Admin
                </h3>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Puskesmas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $i => $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 35px; height: 35px;">
                                                <span class="text-white font-weight-bold">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->nomor_hp }}</td>
                                    <td>
                                        <span class="badge badge-{{ $user->jenis_kelamin == 'Laki-laki' ? 'primary' : 'pink' }}">
                                            {{ $user->jenis_kelamin }}
                                        </span>
                                    </td>
                                    <td>{{ $user->usia }} tahun</td>
                                    <td>{{ $user->puskesmas ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-info btn-sm" title="Detail" 
                                                onclick="showDetailModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->nomor_hp }}', '{{ $user->jenis_kelamin }}', {{ $user->usia }}, '{{ $user->puskesmas }}', '{{ $user->created_at->format('d M Y, H:i') }}', '{{ $user->role }}')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-warning btn-sm" title="Edit" 
                                                onclick="showEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->nomor_hp }}', '{{ $user->jenis_kelamin }}', {{ $user->usia }}, '{{ $user->puskesmas }}', '{{ $user->role }}')">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('superadmin.deleteUser', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus admin ini?')"
                                                    title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                                            <p class="mb-0">Belum ada admin terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($users->hasPages())
            <div class="card-footer">
                <div class="d-flex justify-content-center">
                    {{ $users->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

@include('superadmin.partials.modals')
@endsection