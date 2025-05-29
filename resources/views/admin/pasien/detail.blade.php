@extends('layouts.admin')

@section('title', 'Detail Pasien')

@section('content')
    <div class="container py-5">
        <!-- Tombol Kembali -->
        <div class="back-button">
            <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pasien
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Detail Pasien</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%">Nama</th>
                                <td width="5%">:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                                <td>:</td>
                                <td>{{ $user->nomor_hp }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td>{{ $user->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <td>:</td>
                                <td>{{ $user->usia }} tahun</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>:</td>
                                <td>{{ ucfirst($user->role) }}</td>
                            </tr>
                            <tr>
                                <th>Dibuat pada</th>
                                <td>:</td>
                                <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <div style="width: 150px; height: 150px; background-color: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 60px; color: #6c757d;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.pasienEdit', $user->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil me-2"></i> Edit Pasien
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection