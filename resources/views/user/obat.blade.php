@extends('layouts.user-admin')
@section('title', 'Daftar Obat')
@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ Auth::user()->puskesmas === 'godean_2' ? 'Daftar Suplemen' : 'Daftar Obat' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ Auth::user()->puskesmas === 'godean_2' ? 'Daftar Suplemen' : 'Daftar Obat' }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ session('success') }}
            </div>
        @endif

        @if($latestPengingat && $latestPengingat->detailObat->count() > 0)
            <!-- Pengingat Info -->
            <div class="row">
                <div class="col-12">
                    <div class="card bg-gradient-info">
                        <div class="card-body">
                            <h4 class="text-white mb-1">{{ Auth::user()->puskesmas === 'godean_2' ? 'Pengingat Suplemen Anda' : 'Pengingat Obat Anda' }}</h4>
                            <p class="text-white mb-2">
                                <strong>Status:</strong> {{ ucfirst($latestPengingat->status) }} |
                                <strong>Mulai:</strong> {{ $latestPengingat->tanggal_mulai }}
                            </p>
                            @if($latestPengingat->catatan)
                                <p class="text-white mb-0"><strong>Catatan:</strong> {{ $latestPengingat->catatan }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Alert -->
            @if($latestPengingat->status === 'tidak_aktif')
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Perhatian!</strong> Pengingat obat sedang tidak aktif. Jika diaktifkan kembali, Anda perlu mengisi ulang data pengingat obat.
                        </div>
                    </div>
                </div>
            @endif

            <!-- Obat Cards -->
            <div class="row">
                @foreach($latestPengingat->detailObat as $index => $obat)
                    <div class="col-md-6 col-lg-4">
                        <div class="card {{ $obat->status_obat === 'aktif' ? 'card-success' : 'card-secondary' }}">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-pills mr-1"></i>
                                    {{ Auth::user()->puskesmas === 'godean_2' ? 'Suplemen' : 'Obat' }} {{ $index + 1 }}
                                </h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless table-sm">
                                    @if(Auth::user()->puskesmas === 'godean_2')
                                        <tr>
                                            <td class="font-weight-bold">Nama Suplemen:</td>
                                            <td>{{ $obat->suplemen ?? $obat->nama_obat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Jumlah:</td>
                                            <td>{{ $obat->jumlah_obat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Waktu Minum:</td>
                                            <td>{{ $obat->waktu_minum }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Urutan:</td>
                                            <td>{{ $obat->urutan }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="font-weight-bold">Nama Obat:</td>
                                            <td>{{ $obat->nama_obat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Jumlah:</td>
                                            <td>{{ $obat->jumlah_obat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Waktu Minum:</td>
                                            <td>{{ $obat->waktu_minum }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Suplemen:</td>
                                            <td>{{ $obat->suplemen ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Urutan:</td>
                                            <td>{{ $obat->urutan }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ Auth::user()->puskesmas === 'godean_2' ? 'Ringkasan Suplemen' : 'Ringkasan Obat' }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            @if(Auth::user()->puskesmas === 'godean_2')
                                                <th>Nama Suplemen</th>
                                                <th>Jumlah</th>
                                                <th>Waktu Minum</th>
                                                <th>Status</th>
                                            @else
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Waktu Minum</th>
                                                <th>Suplemen</th>
                                                <th>Status</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($latestPengingat->detailObat->sortBy('urutan') as $index => $obat)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                @if(Auth::user()->puskesmas === 'godean_2')
                                                    <td class="font-weight-bold">{{ $obat->suplemen ?? $obat->nama_obat }}</td>
                                                    <td>{{ $obat->jumlah_obat }}</td>
                                                    <td>{{ $obat->waktu_minum }}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('user.obat.update-status') }}" style="display: inline;">
                                                            @csrf
                                                            <input type="hidden" name="obat_id" value="{{ $obat->id }}">
                                                            <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                                <option value="aktif" {{ $obat->status_obat === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                                <option value="habis" {{ $obat->status_obat === 'habis' ? 'selected' : '' }}>Habis</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td class="font-weight-bold">{{ $obat->nama_obat }}</td>
                                                    <td>{{ $obat->jumlah_obat }}</td>
                                                    <td>{{ $obat->waktu_minum }}</td>
                                                    <td>{{ $obat->suplemen ?? '-' }}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('user.obat.update-status') }}" style="display: inline;">
                                                            @csrf
                                                            <input type="hidden" name="obat_id" value="{{ $obat->id }}">
                                                            <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                                <option value="aktif" {{ $obat->status_obat === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                                <option value="habis" {{ $obat->status_obat === 'habis' ? 'selected' : '' }}>Habis</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- No Medicine -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-pills fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">{{ Auth::user()->puskesmas === 'godean_2' ? 'Belum Ada Suplemen' : 'Belum Ada Obat' }}</h4>
                            <p class="text-muted">{{ Auth::user()->puskesmas === 'godean_2' ? 'Anda belum memiliki pengingat suplemen.' : 'Anda belum memiliki pengingat obat.' }}</p>
                            <a href="{{ route('user.pengingat') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i>
                                {{ Auth::user()->puskesmas === 'godean_2' ? 'Buat Pengingat Suplemen' : 'Buat Pengingat Obat' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection