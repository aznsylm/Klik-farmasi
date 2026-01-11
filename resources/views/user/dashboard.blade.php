@extends('layouts.user-admin')
@section('title', 'Dashboard')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
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
                        <h4 class="text-white mb-1">Selamat datang, {{ Auth::user()->name }}!</h4>
                        <p class="text-white mb-0">Jaga tekanan darah tetap terkontrol hari ini</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert System -->
        @php
            $alertMessage = '';
            $alertClass = '';
            $latestPengingat = \App\Models\PengingatObat::where('user_id', Auth::id())->latest()->first();
            $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', Auth::id())->latest()->first();
            
            // 30-day alert check
            $daysSinceLastInput = $latestTekananDarah ? 
                (int) \Carbon\Carbon::parse($latestTekananDarah->created_at)->diffInDays(now()) : 999;
            
            // Alert logic - prioritized by importance
            if ($latestTekananDarah && ($latestTekananDarah->sistol >= 140 || $latestTekananDarah->diastol >= 90)) {
                $alertMessage = 'Tekanan darah Anda tinggi! Segera konsultasi dengan admin atau dokter';
                $alertClass = 'alert-danger';
            } elseif ($daysSinceLastInput > 30) {
                $alertMessage = 'Sudah ' . $daysSinceLastInput . ' hari tidak input tekanan darah. Yuk catat tekanan darah Anda!';
                $alertClass = 'alert-warning';
            } elseif (!$latestTekananDarah) {
                $alertMessage = 'Selamat datang! Mulai catat tekanan darah untuk pantau kesehatan Anda';
                $alertClass = 'alert-info';
            }
        @endphp

        @if($alertMessage)
        <div class="row">
            <div class="col-12">
                <div class="alert {{ $alertClass }} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fas fa-info-circle mr-2"></i>{{ $alertMessage }}
                </div>
            </div>
        </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ \App\Models\CatatanTekananDarah::where('user_id', Auth::id())->count() }}</h3>
                        <p>Total Catatan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="{{ route('user.tekanan-darah') }}" class="small-box-footer">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $latestPengingat ? $latestPengingat->detailObat->count() : 0 }}</h3>
                        <p>Jenis Obat</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pills"></i>
                    </div>
                    <a href="{{ route('user.obat') }}" class="small-box-footer">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $latestTekananDarah ? $latestTekananDarah->sistol . '/' . $latestTekananDarah->diastol : '-' }}</h3>
                        <p>TD Terakhir</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <a href="{{ route('user.tekanan-darah') }}" class="small-box-footer">
                        Input Baru <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>5</h3>
                        <p>Tim Konsultasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <a href="{{ route('user.konsultasi') }}" class="small-box-footer">
                        Konsultasi <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Aksi Cepat</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <a href="{{ route('user.tekanan-darah') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-plus mr-1"></i> Catat TD
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="{{ route('user.obat') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-pills mr-1"></i> Lihat Obat
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('user.konsultasi') }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-comments mr-1"></i> Konsultasi
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('user.tekanan-darah.pdf') }}" class="btn btn-danger btn-block">
                                    <i class="fas fa-file-pdf mr-1"></i> Unduh PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection