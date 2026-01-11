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
                                <a href="{{ route('beranda') }}" class="btn btn-info btn-block">
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

@include('components.superadmin.modal-tambah-user', ['role' => 'admin'])
@include('components.superadmin.modal-tambah-user', ['role' => 'pasien'])
@include('components.superadmin.modal-scripts')
@endsection