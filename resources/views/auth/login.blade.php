@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <!-- Tombol Kembali -->
    <a href="{{ url('/') }}" 
    style="position: absolute; top: 24px; left: 24px; z-index: 10; display: flex; align-items: center; gap: 6px; text-decoration: none; color: #0b5e91; font-weight: 600; font-size: 1rem;">
        <i class="fas fa-arrow-left"></i> Halaman Utama
    </a>

    <!-- Login Form -->
    <div id="loginForm">
        
        <h2 class="form-title">Masuk</h2>
        <p class="form-subtitle">Selamat datang kembali! Silakan login untuk melanjutkan</p>
        
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif
        
        <form id="loginFormElement" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="login" id="loginInput" placeholder="Email atau Nomor HP" required value="{{ old('login') }}">
            </div>
            <div class="form-group">
                <div class="password-group">
                    <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password" required>
                    <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                </div>
            </div>
            <button type="submit" class="btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                <span>Masuk</span>
            </button>
            <div class="form-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </form>
    </div>
@endsection
@section('hero_title', 'Klik Farmasi')
@section('hero_subtitle', 'Masuk untuk menikmati kemudahan konsultasi kesehatan, pengingat minum obat, dan akses informasi obat terpercaya.')