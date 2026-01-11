@extends('layouts.superadmin')
@section('title', 'Dashboard Super Admin')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard Super Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Welcome Message -->
        <div class="row">
            <div class="col-12">
                <div class="card bg-gradient-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="mr-3">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="text-white">
                                <h3 class="mb-1">Selamat Datang, {{ Auth::user()->name }}!</h3>
                                <p class="mb-0">Anda login sebagai Super Administrator. Kelola sistem dengan bijak.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalAdmin }}</h3>
                        <p>Total Administrator</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <a href="{{ route('superadmin.admin') }}" class="small-box-footer">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalPasien }}</h3>
                        <p>Total Pasien</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('superadmin.pasien') }}" class="small-box-footer">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Aksi Cepat
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalTambahAdmin">
                                    <i class="fas fa-plus mr-1"></i> Tambah Admin Baru
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#modalTambahPasien">
                                    <i class="fas fa-plus mr-1"></i> Tambah Pasien Baru
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('beranda') }}" class="btn btn-info btn-block" target="_blank">
                                    <i class="fas fa-globe mr-1"></i> Lihat Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('superadmin.storeUser') }}" class="modal-content">
            @csrf
            <input type="hidden" name="role" value="admin">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Admin Baru</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Admin</label>
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
                                min="18" max="120" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" 
                                    name="password" 
                                    id="passwordAdminInput" 
                                    required 
                                    minlength="8">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary" onclick="togglePassword('passwordAdminInput')">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
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

<!-- Modal Tambah Pasien -->
<div class="modal fade" id="modalTambahPasien" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('superadmin.storeUser') }}" class="modal-content">
            @csrf
            <input type="hidden" name="role" value="pasien">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Tambah Pasien Baru</h4>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
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
                            <div class="input-group">
                                <input type="password" class="form-control" 
                                    name="password" 
                                    id="passwordPasienInput" 
                                    required 
                                    minlength="8">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary" onclick="togglePassword('passwordPasienInput')">
                                        <i class="fas fa-eye-slash"></i>
                                    </button>
                                </div>
                            </div>
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
@endsection