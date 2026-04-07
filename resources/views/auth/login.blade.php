@extends('layouts.medicio')

@section('title', 'Login - Klik Farmasi')

@push('head')
    <meta name="description"
        content="Login ke akun Klik Farmasi untuk mengakses pengingat obat, konsultasi kesehatan, dan fitur eksklusif lainnya.">
    <meta name="keywords" content="login klik farmasi, masuk akun, pengingat obat, konsultasi kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <style>
        .auth-page {
            padding: 48px 0 72px;
            background:
                radial-gradient(circle at 10% 10%, rgba(11, 94, 145, 0.08), transparent 35%),
                radial-gradient(circle at 90% 90%, rgba(186, 169, 113, 0.18), transparent 40%),
                linear-gradient(180deg, #f7fbff 0%, #eef5fa 100%);
            min-height: calc(100vh - 240px);
        }

        .auth-wrap {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 18px 48px rgba(11, 94, 145, 0.14);
            background: #fff;
        }

        .auth-aside {
            background: linear-gradient(140deg, #0b5e91 0%, #0a4f7a 100%);
            color: #fff;
            padding: 44px 34px;
            height: 100%;
            position: relative;
        }

        .auth-aside::before,
        .auth-aside::after {
            content: '';
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.12);
        }

        .auth-aside::before {
            width: 190px;
            height: 190px;
            top: -60px;
            right: -70px;
        }

        .auth-aside::after {
            width: 120px;
            height: 120px;
            bottom: -45px;
            left: -45px;
        }

        .auth-aside h2 {
            color: #fff;
            font-weight: 700;
            font-size: 1.9rem;
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }

        .auth-aside p,
        .auth-aside li {
            position: relative;
            z-index: 2;
            color: rgba(255, 255, 255, 0.94);
        }

        .auth-aside ul {
            list-style: none;
            padding-left: 0;
            margin-top: 22px;
            margin-bottom: 0;
        }

        .auth-aside li {
            margin-bottom: 10px;
            display: flex;
            align-items: start;
            gap: 10px;
        }

        .auth-card {
            padding: 34px 30px;
        }

        .auth-head {
            margin-bottom: 20px;
        }

        .auth-head h1 {
            font-size: 1.8rem;
            margin-bottom: 8px;
            color: #18344a;
        }

        .auth-head p {
            margin-bottom: 0;
            color: #516577;
        }

        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #d5e0ea;
            min-height: 48px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.14);
        }

        .password-group {
            position: relative;
            border: 1px solid #d5e0ea;
            border-radius: 10px;
            background: #fff;
        }

        .password-group:focus-within {
            border-color: #0b5e91;
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.14);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6f8293;
        }

        .password-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .password-input-wrapper .password-group,
        .password-input-wrapper input {
            flex: 1;
        }

        .helper-icon {
            color: #6f8293;
            cursor: help;
            position: relative;
        }

        .helper-icon:hover {
            color: #0b5e91;
        }

        .helper-icon[data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            right: 0;
            bottom: 130%;
            min-width: 220px;
            max-width: 260px;
            white-space: normal;
            font-size: 12px;
            line-height: 1.45;
            color: #fff;
            background: #233746;
            border-radius: 8px;
            padding: 8px 10px;
            z-index: 10;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            font-size: 0.87rem;
            color: #d83232;
        }

        .is-invalid {
            border-color: #d83232 !important;
        }

        .auth-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 4px;
        }

        .auth-check label {
            margin: 0;
            color: #516577;
            font-size: 0.95rem;
        }

        .btn-auth {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 12px 16px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(140deg, #0b5e91 0%, #0a4f7a 100%);
            margin-top: 8px;
        }

        .auth-foot {
            margin-top: 14px;
            color: #5b6f81;
        }

        .auth-foot a {
            font-weight: 600;
        }

        @media (max-width: 991px) {
            .auth-page {
                padding: 24px 0 56px;
            }

            .auth-aside {
                padding: 28px 22px;
            }

            .auth-card {
                padding: 26px 20px;
            }

            .helper-icon[data-tooltip]:hover::after {
                right: -30px;
            }
        }

        @media (max-width: 767px) {
            .auth-aside h2 {
                font-size: 1.45rem;
            }

            .auth-head h1 {
                font-size: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <section class="auth-page section">
        <div class="container" data-aos="fade-up">
            <div class="row g-0 auth-wrap">
                <div class="col-lg-5 d-none d-lg-block">
                    <aside class="auth-aside">
                        <h2>Kembali Kelola Hipertensi Anda</h2>
                        <p>Masuk untuk melanjutkan pengingat minum obat, pantau tekanan darah, dan akses artikel edukasi
                            terpercaya.</p>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i><span>Pengingat jadwal obat harian</span></li>
                            <li><i class="bi bi-check2-circle"></i><span>Pantau progres tekanan darah</span></li>
                            <li><i class="bi bi-check2-circle"></i><span>Konten edukasi khusus hipertensi</span></li>
                        </ul>
                    </aside>
                </div>

                <div class="col-lg-7">
                    <div class="auth-card">
                        <a href="{{ url('/') }}" class="auth-back"><i class="bi bi-arrow-left"></i> Kembali ke
                            beranda</a>

                        <div class="auth-head">
                            <h1>Login Akun</h1>
                            <p>Selamat datang kembali. Silakan masuk untuk melanjutkan.</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <div class="password-input-wrapper">
                                    <input type="text"
                                        class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}" name="login"
                                        id="loginInput" placeholder="Email atau Nomor WhatsApp" value="{{ old('login') }}"
                                        oninput="formatPhoneInput(this)" autocomplete="username">
                                    <span class="helper-icon"
                                        data-tooltip="Nomor HP harus memakai awalan 62. Contoh: 6281234567890">
                                        <i class="fas fa-circle-question"></i>
                                    </span>
                                </div>
                                @error('login')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="password-input-wrapper">
                                    <div class="password-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                        <input type="password" class="form-control border-0" name="password"
                                            id="loginPassword" placeholder="Password" autocomplete="current-password">
                                        <i class="fas fa-eye-slash password-toggle"
                                            onclick="togglePassword('loginPassword', this)"></i>
                                    </div>
                                    <span class="helper-icon"
                                        data-tooltip="Lupa password? Hubungi admin untuk reset password: +62 823-1338-2915">
                                        <i class="fas fa-circle-question"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <div class="auth-check">
                                <input type="checkbox" class="form-check-input" name="remember" value="1"
                                    id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
                                <label for="rememberMe">Ingat akun saya</label>
                            </div>

                            <button type="submit" class="btn-auth">Masuk</button>

                            <div class="auth-foot">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function formatPhoneInput(input) {
            let value = input.value;

            if (/[a-zA-Z@.]/.test(value)) {
                return;
            }

            value = value.replace(/[^0-9]/g, '');

            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            }

            if (value.length > 0 && value.startsWith('8') && !value.startsWith('62')) {
                value = '62' + value;
            }

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
@endpush
