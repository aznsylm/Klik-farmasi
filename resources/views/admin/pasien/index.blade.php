@extends('layouts.admin')

@section('title', 'Daftar Pasien')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6">
                <h1>Daftar Pasien</h1>
                <p class="text-muted mb-0">
                    Puskesmas
                    @if (auth()->user()->puskesmas == 'kalasan')
                        Kalasan
                    @elseif(auth()->user()->puskesmas == 'godean_2')
                        Godean 2
                    @elseif(auth()->user()->puskesmas == 'umbulharjo')
                        Umbulharjo
                    @endif
                </p>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pasien</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Notifications -->
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

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <div class="mb-0">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Action Bar -->
        <div class="row mb-3">
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <button type="button" class="btn btn-primary w-100 w-md-auto" data-toggle="modal" data-target="#tambahPasienModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Pasien
                </button>
            </div>
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <form method="GET" action="{{ route('admin.pasien') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, email, HP..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4 text-md-right">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary w-100 w-md-auto">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Patients Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-users mr-1"></i> Data Pasien</h3>
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
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $i => $user)
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
                                    <td>{{ $user->jenis_kelamin }}</td>
                                    <td>{{ $user->usia }} tahun</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.pasienDetail', $user->id) }}" class="btn btn-info btn-sm" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-warning btn-sm" title="Edit" 
                                                onclick="showEditPasienModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->nomor_hp }}', '{{ $user->jenis_kelamin }}', {{ $user->usia }}, '{{ $user->puskesmas }}')">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <form action="{{ route('admin.deletePasien', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-3x mb-3"></i>
                                            <p class="mb-0">Tidak ada data pasien.</p>
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

@include('components.admin.modal-tambah-pasien')
@include('components.admin.modal-edit-pasien')
@include('components.admin.modal-scripts')

<script>
// Handle tambah pasien form
document.addEventListener('DOMContentLoaded', function() {
    const tambahForm = document.querySelector('#tambahPasienModal form');
    if (tambahForm) {
        tambahForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (await validateTambahPasien()) {
                this.submit();
            }
        });
    }
});

// Custom validation messages
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('invalid', function(e) {
        const input = e.target;
        
        if (input.validity.valueMissing) {
            if (input.type === 'email') {
                input.setCustomValidity('Email wajib diisi');
            } else if (input.name === 'name') {
                input.setCustomValidity('Nama wajib diisi');
            } else if (input.name === 'nomor_hp') {
                input.setCustomValidity('Nomor HP wajib diisi');
            } else if (input.name === 'puskesmas') {
                input.setCustomValidity('Puskesmas wajib dipilih');
            } else if (input.name === 'jenis_kelamin') {
                input.setCustomValidity('Jenis kelamin wajib dipilih');
            } else if (input.name === 'usia') {
                input.setCustomValidity('Usia wajib diisi');
            } else if (input.name === 'password') {
                input.setCustomValidity('Password wajib diisi');
            } else {
                input.setCustomValidity('Field ini wajib diisi');
            }
        } else if (input.validity.typeMismatch) {
            if (input.type === 'email') {
                input.setCustomValidity('Format email tidak valid');
            }
        } else if (input.validity.patternMismatch) {
            if (input.name === 'name') {
                input.setCustomValidity('Nama hanya boleh huruf dan spasi, 2-50 karakter');
            }
        } else if (input.validity.tooShort) {
            if (input.name === 'password') {
                input.setCustomValidity('Password minimal 8 karakter');
            }
        } else if (input.validity.rangeUnderflow) {
            if (input.name === 'usia') {
                input.setCustomValidity('Usia terlalu kecil');
            }
        } else if (input.validity.rangeOverflow) {
            if (input.name === 'usia') {
                input.setCustomValidity('Usia terlalu besar (maksimal 120 tahun)');
            }
        }
    }, true);
    
    // Clear custom validity on input
    document.addEventListener('input', function(e) {
        if (e.target.matches('input, select')) {
            e.target.setCustomValidity('');
        }
    });
});

// Show modal if validation errors
@if ($errors->any())
    $(document).ready(function() {
        $('#tambahPasienModal').modal('show');
    });
@endif
</script>
@endsection
