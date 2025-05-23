
@extends('layouts.app')
@section('title', 'Detail Pasien')
@section('content')
<div class="container py-5">
    <h3>Detail Pasien</h3>
    <table class="table">
        <tr><th>Nama</th><td>{{ $user->name }}</td></tr>
        <tr><th>Email</th><td>{{ $user->email }}</td></tr>
        <tr><th>Nomor HP</th><td>{{ $user->nomor_hp }}</td></tr>
        <tr><th>Jenis Kelamin</th><td>{{ $user->jenis_kelamin }}</td></tr>
        <tr><th>Usia</th><td>{{ $user->usia }}</td></tr>
        <tr><th>Role</th><td>{{ $user->role }}</td></tr>
    </table>
    <a href="{{ route('superadmin.userEdit', $user->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('superadmin.users') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection