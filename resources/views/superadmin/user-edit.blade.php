@extends('layouts.app')
@section('title', 'Edit Pasien')
@section('content')
<div class="container py-5">

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Notifikasi gagal --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h3>Edit Pasien</h3>
    <form action="{{ route('superadmin.userUpdate', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="mb-3">
            <label>Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $user->nomor_hp) }}" required>
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control" value="{{ old('usia', $user->usia) }}" required>
        </div>
        {{-- Tambahkan ini untuk super admin --}}
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="pasien" {{ $user->role == 'pasien' ? 'selected' : '' }}>Pasien</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="super_admin" {{ $user->role == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('superadmin.users') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection