@extends('layouts.app')
@section('title', 'Edit Pasien')
@section('content')
<div class="container py-5">
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
        <div class="mb-3">
            <label>Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('superadmin.users') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection