@extends('layouts.admin')

@section('title', 'Daftar Pasien')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
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
            <div class="col-sm-6">
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
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Action Bar -->
        <div class="row mb-3">
            <div class="col-md-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPasienModal">
                    <i class="fas fa-plus mr-1"></i> Tambah Pasien
                </button>
            </div>
            <div class="col-md-4">
                <form method="GET" action="{{ route('admin.pasien') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, email, HP, jenis kelamin, usia..." value="{{ request('search') }}">
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
            <div class="col-md-4 text-right">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
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

<!-- Modal Tambah Pasien -->
<div class="modal fade" id="tambahPasienModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Pasien Baru</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="tambahPasienForm" action="{{ route('admin.addPasien') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Usia</label>
                        <input type="number" class="form-control" name="usia" min="1" max="120" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="passwordField" minlength="8" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye-slash" id="passwordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirmation" id="confirmPasswordField" minlength="8" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye-slash" id="confirmPasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">WhatsApp</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                            </div>
                            <input type="text" class="form-control" name="nomor_hp" placeholder="8xxxxxxxxx" pattern="[0-9]{8,13}" maxlength="13" minlength="8" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Pilih Puskesmas</label>
                        <select class="form-control" name="puskesmas" required>
                            @if (auth()->user()->role === 'super_admin')
                                <option value="">-- Pilih Puskesmas --</option>
                                <option value="kalasan">Puskesmas Kalasan</option>
                                <option value="godean_2">Puskesmas Godean 2</option>
                                <option value="umbulharjo">Puskesmas Umbulharjo</option>
                            @else
                                <option value="{{ auth()->user()->puskesmas }}" selected>
                                    Puskesmas
                                    @if (auth()->user()->puskesmas == 'kalasan')
                                        Kalasan
                                    @elseif(auth()->user()->puskesmas == 'godean_2')
                                        Godean 2
                                    @elseif(auth()->user()->puskesmas == 'umbulharjo')
                                        Umbulharjo
                                    @endif
                                </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="tambahPasienBtn">
                        <i class="fas fa-save mr-1"></i> Tambah Pasien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle form submission
    document.getElementById('tambahPasienForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('tambahPasienBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...';
    });

    // Phone input validation
    const phoneInput = document.querySelector('input[name="nomor_hp"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 13) value = value.substring(0, 13);
            e.target.value = value;
        });
    }

    // Password toggle
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('passwordField');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.className = 'fas fa-eye';
        } else {
            passwordField.type = 'password';
            passwordIcon.className = 'fas fa-eye-slash';
        }
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const confirmPasswordField = document.getElementById('confirmPasswordField');
        const confirmPasswordIcon = document.getElementById('confirmPasswordIcon');

        if (confirmPasswordField.type === 'password') {
            confirmPasswordField.type = 'text';
            confirmPasswordIcon.className = 'fas fa-eye';
        } else {
            confirmPasswordField.type = 'password';
            confirmPasswordIcon.className = 'fas fa-eye-slash';
        }
    });

    // Show modal if validation errors
    @if ($errors->any())
        $('#tambahPasienModal').modal('show');
    @endif
});
</script>
@endsection
