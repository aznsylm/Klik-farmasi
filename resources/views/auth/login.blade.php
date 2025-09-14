@extends('layouts.auth')

@section('title', 'Login - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Login ke akun Klik Farmasi untuk mengakses pengingat obat, konsultasi kesehatan, dan fitur eksklusif lainnya.">
    <meta name="keywords" content="login klik farmasi, masuk akun, pengingat obat, konsultasi kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

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
                <div class="password-input-wrapper">
                    <input type="text" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}" name="login" id="loginInput" placeholder="Email atau 62xxxxxxxxx" required value="{{ old('login') }}" style="flex: 1;" oninput="formatPhoneInput(this)" autocomplete="username">
                    <div class="password-info-icon" data-tooltip="Untuk nomor HP wajib gunakan awalan 62 (contoh: 6281234567890)">
                        <i class="fas fa-question-circle"></i>
                    </div>
                </div>
                @error('login')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <div class="password-input-wrapper">
                    <div class="password-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password" required autocomplete="current-password">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('loginPassword', this)"></i>
                    </div>
                    <div class="password-info-icon" data-tooltip="Lupa password? Hubungi admin puskesmas Anda untuk reset password: 0852-8090-9235">
                        <i class="fas fa-question-circle"></i>
                    </div>
                </div>
                @error('password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <div class="remember-checkbox">
                    <input type="checkbox" name="remember" value="1" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                    <span class="checkmark"></span>
                    <label for="rememberMe" class="remember-text">Ingat akun saya</label>
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

    <script>
    function formatPhoneInput(input) {
        let value = input.value;
        
        // Jika mengandung huruf atau @ atau ., anggap sebagai email - biarkan apa adanya
        if (/[a-zA-Z@.]/.test(value)) {
            return;
        }
        
        // Jika hanya angka, anggap sebagai nomor HP - format sesuai aturan
        value = value.replace(/[^0-9]/g, '');
        
        // Auto convert 0 ke 62
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        }
        
        // Auto convert 8 ke 62 (jika tidak dimulai 62)
        if (value.length > 0 && value.startsWith('8') && !value.startsWith('62')) {
            value = '62' + value;
        }
        
        // Batasi 15 digit
        if (value.length > 15) {
            value = value.substring(0, 15);
        }
        
        input.value = value;
    }

    function togglePassword(inputId, icon) {
        const input = document.getElementById(inputId);
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        
        if (type === 'text') {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
    </script>
@endsection
@section('hero_title', 'Klik Farmasi')
@section('hero_subtitle', 'Masuk untuk menikmati kemudahan konsultasi kesehatan, pengingat minum obat, dan akses informasi obat terpercaya.')

@section('extra_styles')
<style>
    /* Error styling */
    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    
    .password-group.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
    
    .error-message {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
        font-weight: 500;
    }
    
    .error-message i {
        font-size: 0.8rem;
    }
    
    /* Password input wrapper */
    .password-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
    }
    
    .password-input-wrapper .password-group {
        flex: 1;
        min-width: 0;
    }
    
    .password-info-icon {   
        color: #6c757d;
        cursor: help;
        font-size: 0.9rem;
    }
    
    .password-info-icon:hover {
        color: #0B5E91;
    }
    
    /* Tooltip */
    .password-info-icon[data-tooltip]:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 125%;
        right: 0;
        background: #333;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        white-space: nowrap;
        z-index: 1000;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        max-width: 250px;
        white-space: normal;
        text-align: center;
    }
    
    .password-info-icon[data-tooltip]:hover::before {
        content: '';
        position: absolute;
        bottom: 115%;
        right: 10px;
        border: 5px solid transparent;
        border-top-color: #333;
        z-index: 1000;
    }

    /* Remember Me Checkbox */
    .remember-checkbox {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        margin-bottom: 0;
    }

    .remember-checkbox input[type="checkbox"] {
        display: none;
    }

    .remember-checkbox .checkmark {
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 4px;
        display: inline-block;
        position: relative;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .remember-checkbox input[type="checkbox"]:checked + .checkmark {
        background-color: #0B5E91;
        border-color: #0B5E91;
    }

    .remember-checkbox input[type="checkbox"]:checked + .checkmark::after {
        content: '✓';
        position: absolute;
        top: -2px;
        left: 2px;
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    .remember-checkbox:hover .checkmark {
        border-color: #0B5E91;
    }

    .remember-text {
        font-size: 0.9rem;
        color: #495057;
        cursor: pointer;
        user-select: none;
    }
</style>
@endsection