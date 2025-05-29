@extends('layouts.superadmin')

@section('title', 'Detail User')

@section('content')
<div class="container py-5">
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('superadmin.users', ['role' => $user->role]) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar {{ $user->role === 'admin' ? 'Admin' : 'Pasien' }}
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card user-detail-card">
                <div class="user-detail-header">
                    <div class="user-avatar">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h2 class="mb-1">{{ $user->name }}</h2>
                    <p class="mb-0">{{ ucfirst($user->role) }}</p>
                </div>
                
                <div class="card-body">
                    <table class="table user-detail-table">
                        <tbody>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                                <td>{{ $user->nomor_hp }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $user->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <td>{{ $user->usia }} tahun</td>
                            </tr>
                            <tr>
                                <th>Dibuat pada</th>
                                <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir diperbarui</th>
                                <td>{{ $user->updated_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="user-detail-actions">
                    <a href="{{ route('superadmin.userEdit', $user->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Edit {{ $user->role === 'admin' ? 'Admin' : 'Pasien' }}
                    </a>
                    <form action="{{ route('superadmin.deleteUser', $user->id) }}" method="POST" class="d-inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus {{ $user->role === 'admin' ? 'admin' : 'pasien' }} ini?')">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection