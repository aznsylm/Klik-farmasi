@extends('layouts.medicio')

@section('title', 'Register - Klik Farmasi')

@push('head')
    <meta name="description"
        content="Daftar akun Klik Farmasi gratis untuk mendapatkan pengingat obat, konsultasi kesehatan, dan akses ke artikel kesehatan terpercaya.">
    <meta name="keywords" content="daftar klik farmasi, register akun, pengingat obat gratis, konsultasi kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">

    <style>
        .auth-page {
            padding: 48px 0 72px;
            background:
                radial-gradient(circle at 8% 14%, rgba(11, 94, 145, 0.08), transparent 34%),
                radial-gradient(circle at 92% 82%, rgba(186, 169, 113, 0.18), transparent 38%),
                linear-gradient(180deg, #f8fbff 0%, #eef5fa 100%);
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
            padding: 42px 34px;
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
            width: 180px;
            height: 180px;
            top: -60px;
            right: -70px;
        }

        .auth-aside::after {
            width: 110px;
            height: 110px;
            bottom: -45px;
            left: -45px;
        }

        .auth-aside h2 {
            color: #fff;
            font-size: 1.8rem;
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
            margin: 18px 0 0;
        }

        .auth-aside li {
            margin-bottom: 9px;
            display: flex;
            align-items: start;
            gap: 10px;
        }

        .auth-card {
            padding: 30px;
        }

        .auth-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .auth-head h1 {
            margin-bottom: 8px;
            color: #18344a;
            font-size: 1.75rem;
        }

        .auth-head p {
            color: #516577;
            margin-bottom: 20px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #d5e0ea;
            min-height: 46px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0b5e91;
            box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.14);
        }

        .password-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6f8293;
        }

        .phone-input-wrapper,
        .help-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .phone-input-group {
            flex: 1;
            display: flex;
            align-items: center;
            border: 1px solid #d5e0ea;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            min-height: 46px;
        }

        .phone-prefix {
            background: #eef4f9;
            border-right: 1px solid #d5e0ea;
            color: #516577;
            min-height: 46px;
            padding: 11px 14px;
            font-weight: 600;
        }

        .phone-input {
            border: 0 !important;
            box-shadow: none !important;
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

        .is-invalid {
            border-color: #d83232 !important;
        }

        .phone-input-group.is-invalid {
            border-color: #d83232 !important;
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            font-size: 0.87rem;
            color: #d83232;
        }

        .btn-auth {
            width: 100%;
            border: 0;
            border-radius: 10px;
            padding: 12px 16px;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(140deg, #0b5e91 0%, #0a4f7a 100%);
            margin-top: 10px;
        }

        .auth-foot {
            margin-top: 14px;
            color: #5b6f81;
        }

        .auth-foot a {
            font-weight: 600;
        }

        .form-text {
            color: #5b6f81 !important;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(5, 19, 30, 0.58);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 20px;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: #fff;
            border-radius: 14px;
            width: min(420px, 100%);
            padding: 28px 22px;
            text-align: center;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.22);
            transform: translateY(-8px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-icon {
            font-size: 3rem;
            color: #2f9e44;
            margin-bottom: 10px;
        }

        @media (max-width: 991px) {
            .auth-page {
                padding: 24px 0 56px;
            }

            .auth-card {
                padding: 24px 20px;
            }

            .auth-aside {
                padding: 28px 22px;
            }
        }

        @media (max-width: 767px) {
            .auth-head h1 {
                font-size: 1.45rem;
            }

            .auth-aside h2 {
                font-size: 1.35rem;
            }

            .helper-icon[data-tooltip]:hover::after {
                right: -30px;
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
                        <h2>Buat Akun Klik Farmasi</h2>
                        <p>Daftar dalam beberapa langkah untuk mulai menerima pengingat obat dan memantau kesehatan lebih
                            teratur.</p>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i><span>Pendaftaran pasien dengan kode admin</span></li>
                            <li><i class="bi bi-check2-circle"></i><span>Pengingat obat otomatis via WhatsApp</span></li>
                            <li><i class="bi bi-check2-circle"></i><span>Artikel edukasi dan konsultasi kesehatan</span>
                            </li>
                        </ul>
                    </aside>
                </div>

                <div class="col-lg-7">
                    <div class="auth-card">
                        <a href="{{ route('login') }}" class="auth-back"><i class="bi bi-arrow-left"></i> Kembali ke
                            login</a>

                        <div class="auth-head">
                            <h1>Register Pasien</h1>
                            <p>Lengkapi data berikut untuk membuat akun baru.</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form id="registerFormElement" method="POST" action="{{ route('register.process') }}">
                            @csrf

                            <div class="mb-3">
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                    name="name" id="registerName" placeholder="Nama Lengkap" required
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <select class="form-select {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}"
                                        name="jenis_kelamin" id="registerGender" required>
                                        <option value="" disabled hidden
                                            {{ !old('jenis_kelamin') ? 'selected' : '' }}>Jenis Kelamin</option>
                                        <option value="Laki-laki"
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="error-message"><i
                                                class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="number"
                                        class="form-control {{ $errors->has('usia') ? 'is-invalid' : '' }}" name="usia"
                                        id="registerAge" placeholder="Usia" min="1" max="120" required
                                        value="{{ old('usia') }}">
                                    @error('usia')
                                        <div class="error-message"><i
                                                class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    name="email" id="registerEmail" placeholder="Email Aktif" required
                                    value="{{ old('email') }}">
                                <div class="error-message" id="registerEmailError" style="display: none;">
                                    <i class="fas fa-circle-exclamation"></i><span></span>
                                </div>
                                @error('email')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <div class="password-group">
                                        <input type="password"
                                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            name="password" id="registerPassword" placeholder="Buat Password" required
                                            minlength="8">
                                        <i class="fas fa-eye-slash password-toggle"
                                            onclick="togglePassword('registerPassword', this)"></i>
                                    </div>
                                    @error('password')
                                        <div class="error-message"><i
                                                class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="password-group">
                                        <input type="password"
                                            class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                            name="password_confirmation" id="registerConfirmPassword"
                                            placeholder="Konfirmasi Password" required minlength="8">
                                        <i class="fas fa-eye-slash password-toggle"
                                            onclick="togglePassword('registerConfirmPassword', this)"></i>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="error-message"><i
                                                class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="phone-input-wrapper">
                                    <div class="phone-input-group {{ $errors->has('nomor_hp') ? 'is-invalid' : '' }}"
                                        id="phoneInputGroup">
                                        <span class="phone-prefix">+62</span>
                                        <input type="tel" class="form-control phone-input" name="nomor_hp"
                                            id="registerPhone" placeholder="Nomor WhatsApp (contoh: 81234567890)" required
                                            value="{{ old('nomor_hp') }}" pattern="[0-9]{8,13}" maxlength="13"
                                            minlength="8">
                                    </div>
                                    <span class="helper-icon"
                                        data-tooltip="Masukkan nomor tanpa awalan 0 atau 62. Contoh: 81234567890">
                                        <i class="fas fa-circle-question"></i>
                                    </span>
                                </div>
                                <div class="error-message" id="registerPhoneError" style="display: none;">
                                    <i class="fas fa-circle-exclamation"></i><span></span>
                                </div>
                                @error('nomor_hp')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <select class="form-select {{ $errors->has('puskesmas') ? 'is-invalid' : '' }}"
                                    name="puskesmas" id="registerPuskesmas" required>
                                    <option value="" disabled hidden {{ !old('puskesmas') ? 'selected' : '' }}>Pilih
                                        Puskesmas</option>
                                    <option value="kalasan" {{ old('puskesmas') == 'kalasan' ? 'selected' : '' }}>
                                        Puskesmas Kalasan</option>
                                    <option value="godean_2" {{ old('puskesmas') == 'godean_2' ? 'selected' : '' }}>
                                        Puskesmas Godean 2</option>
                                    <option value="umbulharjo" {{ old('puskesmas') == 'umbulharjo' ? 'selected' : '' }}>
                                        Puskesmas Umbulharjo</option>
                                </select>
                                @error('puskesmas')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="text"
                                    class="form-control {{ $errors->has('kode_pendaftaran') ? 'is-invalid' : '' }}"
                                    name="kode_pendaftaran" id="kodePendaftaran" placeholder="Kode Pendaftaran" required
                                    value="{{ old('kode_pendaftaran') }}">
                                <small class="form-text">Masukkan kode pendaftaran yang diberikan admin.</small>
                                @error('kode_pendaftaran')
                                    <div class="error-message"><i
                                            class="fas fa-circle-exclamation"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>

                            <button type="submit" class="btn-auth" id="registerSubmitBtn">Daftar Sekarang</button>

                            <div class="auth-foot">
                                Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay {{ session('register_success') ? 'active' : '' }}" id="successModal">
            <div class="modal-container">
                <div class="modal-icon"><i class="fas fa-circle-check"></i></div>
                <h3>Pendaftaran Berhasil</h3>
                <p class="mb-4">Akun Anda sudah dibuat. Silakan login untuk mulai menggunakan aplikasi.</p>
                <a href="{{ route('login') }}" class="btn-auth d-inline-block text-decoration-none"
                    style="width: auto; padding-left: 22px; padding-right: 22px;">Login Sekarang</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        let emailValid = true;
        let phoneValid = true;

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('successModal');
            const phoneInput = document.getElementById('registerPhone');
            const emailInput = document.getElementById('registerEmail');

            if (modal.classList.contains('active')) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.remove('active');
                    }
                });
            }

            emailInput.addEventListener('blur', async function() {
                const email = this.value.trim();

                if (!email) {
                    hideError('registerEmail', 'registerEmailError');
                    emailValid = true;
                    updateSubmitButton();
                    return;
                }

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    showError('registerEmail', 'registerEmailError', 'Format email tidak valid');
                    emailValid = false;
                    updateSubmitButton();
                    return;
                }

                try {
                    const response = await fetch('/admin/check-duplicate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    });

                    const data = await response.json();
                    if (data.exists) {
                        showError('registerEmail', 'registerEmailError', 'Email sudah terdaftar');
                        emailValid = false;
                    } else {
                        hideError('registerEmail', 'registerEmailError');
                        emailValid = true;
                    }
                } catch (error) {
                    console.error('Error checking email:', error);
                    emailValid = true;
                }

                updateSubmitButton();
            });

            phoneInput.addEventListener('blur', async function() {
                const phone = this.value.trim();

                if (!phone) {
                    hidePhoneError();
                    phoneValid = true;
                    updateSubmitButton();
                    return;
                }

                if (phone.length < 8 || phone.length > 13) {
                    showPhoneError('Nomor HP harus 8-13 digit');
                    phoneValid = false;
                    updateSubmitButton();
                    return;
                }

                const formattedPhone = '62' + phone;

                try {
                    const response = await fetch('/admin/check-duplicate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            nomor_hp: formattedPhone
                        })
                    });

                    const data = await response.json();
                    if (data.exists) {
                        showPhoneError('Nomor HP sudah terdaftar');
                        phoneValid = false;
                    } else {
                        hidePhoneError();
                        phoneValid = true;
                    }
                } catch (error) {
                    console.error('Error checking phone:', error);
                    phoneValid = true;
                }

                updateSubmitButton();
            });

            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.startsWith('0')) {
                    value = value.substring(1);
                }
                if (value.startsWith('62')) {
                    value = value.substring(2);
                }
                if (value.length > 13) {
                    value = value.substring(0, 13);
                }

                e.target.value = value;
                hidePhoneError();
                phoneValid = true;
                updateSubmitButton();
            });

            phoneInput.addEventListener('paste', function(e) {
                e.preventDefault();
                let paste = (e.clipboardData || window.clipboardData).getData('text');
                let cleanPaste = paste.replace(/\D/g, '');

                if (cleanPaste.startsWith('0')) {
                    cleanPaste = cleanPaste.substring(1);
                }
                if (cleanPaste.startsWith('62')) {
                    cleanPaste = cleanPaste.substring(2);
                }
                cleanPaste = cleanPaste.substring(0, 13);

                e.target.value = cleanPaste;
                e.target.dispatchEvent(new Event('input'));
            });

            emailInput.addEventListener('input', function() {
                hideError('registerEmail', 'registerEmailError');
                emailValid = true;
                updateSubmitButton();
            });

            document.getElementById('registerFormElement').addEventListener('submit', function(e) {
                if (!emailValid || !phoneValid) {
                    e.preventDefault();
                    alert('Mohon perbaiki kesalahan pada form sebelum melanjutkan');
                }
            });

            setupCustomValidation();
        });

        function setupCustomValidation() {
            document.addEventListener('invalid', function(e) {
                const input = e.target;

                if (input.validity.valueMissing) {
                    if (input.name === 'name') input.setCustomValidity('Nama lengkap wajib diisi');
                    else if (input.name === 'jenis_kelamin') input.setCustomValidity('Jenis kelamin wajib dipilih');
                    else if (input.name === 'usia') input.setCustomValidity('Usia wajib diisi');
                    else if (input.name === 'email') input.setCustomValidity('Email wajib diisi');
                    else if (input.name === 'password') input.setCustomValidity('Password wajib diisi');
                    else if (input.name === 'password_confirmation') input.setCustomValidity(
                        'Konfirmasi password wajib diisi');
                    else if (input.name === 'nomor_hp') input.setCustomValidity('Nomor HP wajib diisi');
                    else if (input.name === 'puskesmas') input.setCustomValidity('Puskesmas wajib dipilih');
                    else if (input.name === 'kode_pendaftaran') input.setCustomValidity(
                        'Kode pendaftaran wajib diisi');
                } else if (input.validity.typeMismatch) {
                    if (input.type === 'email') input.setCustomValidity('Format email tidak valid');
                } else if (input.validity.tooShort) {
                    if (input.name === 'password' || input.name === 'password_confirmation') input
                        .setCustomValidity('Password minimal 8 karakter');
                    if (input.name === 'nomor_hp') input.setCustomValidity('Nomor HP minimal 8 digit');
                } else if (input.validity.rangeUnderflow) {
                    if (input.name === 'usia') input.setCustomValidity('Usia minimal 1 tahun');
                } else if (input.validity.rangeOverflow) {
                    if (input.name === 'usia') input.setCustomValidity('Usia maksimal 120 tahun');
                } else if (input.validity.patternMismatch) {
                    if (input.name === 'nomor_hp') input.setCustomValidity(
                        'Nomor HP hanya boleh berisi angka 8-13 digit');
                }
            }, true);

            document.addEventListener('input', function(e) {
                if (e.target.matches('input, select')) {
                    e.target.setCustomValidity('');
                }
            });
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

        function showError(inputId, errorId, message) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);

            input.classList.add('is-invalid');
            error.style.display = 'flex';
            error.querySelector('span').textContent = message;
        }

        function hideError(inputId, errorId) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);

            input.classList.remove('is-invalid');
            error.style.display = 'none';
        }

        function showPhoneError(message) {
            const phoneGroup = document.getElementById('phoneInputGroup');
            const error = document.getElementById('registerPhoneError');

            phoneGroup.classList.add('is-invalid');
            error.style.display = 'flex';
            error.querySelector('span').textContent = message;
        }

        function hidePhoneError() {
            const phoneGroup = document.getElementById('phoneInputGroup');
            const error = document.getElementById('registerPhoneError');

            phoneGroup.classList.remove('is-invalid');
            error.style.display = 'none';
        }

        function updateSubmitButton() {
            const submitBtn = document.getElementById('registerSubmitBtn');
            if (!emailValid || !phoneValid) {
                submitBtn.style.opacity = '0.6';
                submitBtn.style.cursor = 'not-allowed';
            } else {
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        }
    </script>
@endpush
