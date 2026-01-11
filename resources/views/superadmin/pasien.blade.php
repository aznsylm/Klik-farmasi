@extends('layouts.superadmin')
@section('title', 'Daftar Pasien')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Daftar Pasien</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Pasien</li>
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
                        <a class="nav-link" href="{{ route('superadmin.admin') }}">
                            <i class="fas fa-user-shield mr-1"></i> Daftar Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('superadmin.pasien') }}">
                            <i class="fas fa-users mr-1"></i> Daftar Pasien
                        </a>
                    </li>
                    <li class="nav-item ml-auto">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPasien">
                            <i class="fas fa-plus mr-1"></i> Tambah Pasien
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Search Card -->
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('superadmin.pasien') }}" class="row">
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
                            <a href="{{ route('superadmin.pasien') }}" class="btn btn-secondary">
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
                    <i class="fas fa-users mr-1"></i>
                    Daftar Pasien
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
                                                    onclick="return confirm('Yakin hapus pasien ini?')"
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
                                            <p class="mb-0">Belum ada pasien terdaftar.</p>
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
<!-- Modal Tambah Pasien -->
<div class="modal fade" id="modalTambahPasien" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('superadmin.addPasien') }}" class="modal-content">
            @csrf
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Pasien Baru</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Pasien</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" 
                                pattern="^08[0-9]{8,11}$" 
                                title="Nomor HP harus diawali 08 dan 10-13 digit" 
                                required>
                        </div>
                        <div class="form-group">
                            <label>Puskesmas</label>
                            <select class="form-control" name="puskesmas" required>
                                <option value="">Pilih Puskesmas</option>
                                <option value="kalasan">Puskesmas Kalasan</option>
                                <option value="godean_2">Puskesmas Godean 2</option>
                                <option value="umbulharjo">Puskesmas Umbulharjo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Usia</label>
                            <input type="number" class="form-control" name="usia" 
                                min="1" max="120" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required minlength="8">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required minlength="8">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Tambah
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail User -->
<div class="modal fade" id="modalDetailUser" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Detail <span id="detailUserRole"></span></h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px; font-size: 2rem; color: white;" id="detailUserInitial">
                        </div>
                        <h5 id="detailUserName"></h5>
                        <span class="badge badge-primary" id="detailUserRoleBadge"></span>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-envelope mr-1"></i> Email</label>
                                    <p id="detailUserEmail"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-phone mr-1"></i> Nomor HP</label>
                                    <p id="detailUserPhone"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</label>
                                    <p id="detailUserGender"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-birthday-cake mr-1"></i> Usia</label>
                                    <p id="detailUserAge"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-hospital mr-1"></i> Puskesmas</label>
                                    <p id="detailUserPuskesmas"></p>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold"><i class="fas fa-calendar-plus mr-1"></i> Terdaftar</label>
                                    <p id="detailUserCreated"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="editUserForm" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Edit <span id="editUserRole"></span></h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="name" id="editUserName" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" id="editUserEmail" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" id="editUserPhone" required>
                        </div>
                        <div class="form-group">
                            <label>Puskesmas</label>
                            <select class="form-control" name="puskesmas" id="editUserPuskesmas" required>
                                <option value="">Pilih Puskesmas</option>
                                <option value="kalasan">Puskesmas Kalasan</option>
                                <option value="godean_2">Puskesmas Godean 2</option>
                                <option value="umbulharjo">Puskesmas Umbulharjo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="editUserGender" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Usia</label>
                            <input type="number" class="form-control" name="usia" id="editUserAge" min="1" max="120" required>
                        </div>
                        <div class="form-group">
                            <label>Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" name="password" minlength="8">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="password_confirmation" minlength="8">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showDetailModal(id, name, email, phone, gender, age, puskesmas, created, role) {
    document.getElementById('detailUserInitial').textContent = name.charAt(0);
    document.getElementById('detailUserName').textContent = name;
    document.getElementById('detailUserRole').textContent = role === 'admin' ? 'Admin' : 'Pasien';
    document.getElementById('detailUserRoleBadge').textContent = role === 'admin' ? 'Administrator' : 'Pasien';
    document.getElementById('detailUserEmail').textContent = email;
    document.getElementById('detailUserPhone').textContent = phone;
    document.getElementById('detailUserGender').textContent = gender;
    document.getElementById('detailUserAge').textContent = age + ' tahun';
    
    let puskesmasName = puskesmas;
    if (puskesmas === 'kalasan') puskesmasName = 'Puskesmas Kalasan';
    else if (puskesmas === 'godean_2') puskesmasName = 'Puskesmas Godean 2';
    else if (puskesmas === 'umbulharjo') puskesmasName = 'Puskesmas Umbulharjo';
    document.getElementById('detailUserPuskesmas').textContent = puskesmasName || '-';
    
    document.getElementById('detailUserCreated').textContent = created;
    $('#modalDetailUser').modal('show');
}

function showEditModal(id, name, email, phone, gender, age, puskesmas, role) {
    document.getElementById('editUserRole').textContent = role === 'admin' ? 'Admin' : 'Pasien';
    document.getElementById('editUserName').value = name;
    document.getElementById('editUserEmail').value = email;
    document.getElementById('editUserPhone').value = phone;
    document.getElementById('editUserGender').value = gender;
    document.getElementById('editUserAge').value = age;
    document.getElementById('editUserPuskesmas').value = puskesmas || '';
    
    document.getElementById('editUserForm').action = '{{ route('superadmin.userUpdate', '') }}/' + id;
    $('#modalEditUser').modal('show');
}
</script>