@extends('layouts.auth')

@section('title', 'Register - Klik Farmasi')

@push('head')
    <!-- SEO Meta Tags -->
    <meta name="description" content="Daftar akun Klik Farmasi gratis untuk mendapatkan pengingat obat, konsultasi kesehatan, dan akses ke artikel kesehatan terpercaya.">
    <meta name="keywords" content="daftar klik farmasi, register akun, pengingat obat gratis, konsultasi kesehatan">
    <meta name="author" content="Tim Farmasi Universitas Alma Ata">
@endpush

@section('content')
    <!-- Register Form -->
    <div id="registerForm">
        <h2 class="form-title">Daftar Akun</h2>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif
        
        <form id="registerFormElement" method="POST" action="{{ route('register.process') }}">
            @csrf
            <!-- 1. Identitas Dasar -->
            <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="registerName" placeholder="Nama Lengkap *" required value="{{ old('name') }}">
                @error('name')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="form-group row">
                <div>
                    <select class="form-select {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" name="jenis_kelamin" id="registerGender" required>
                        <option value="" disabled hidden {{ !old('jenis_kelamin') ? 'selected' : '' }}>Pilih Jenis Kelamin *</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <input type="number" class="form-control {{ $errors->has('usia') ? 'is-invalid' : '' }}" name="usia" id="registerAge" placeholder="Usia *" min="1" max="120" required value="{{ old('usia') }}">
                    @error('usia')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
            
            <!-- 2. Akun & Keamanan -->
            <div class="form-group">
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="registerEmail" placeholder="Email Aktif *" required value="{{ old('email') }}">
                @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="form-group row">
                <div>
                    <div class="password-group">
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="registerPassword" placeholder="Buat Password *" required minlength="8">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('registerPassword', this)"></i>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div>
                    <div class="password-group">
                        <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" id="registerConfirmPassword" placeholder="Konfirmasi Password *" required minlength="8">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('registerConfirmPassword', this)"></i>
                    </div>
                    @error('password_confirmation')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>
            </div>
            
            <!-- 3. Kontak & Lokasi -->
            <div class="form-group">
                <div class="phone-input-wrapper">
                    <div class="phone-input-group {{ $errors->has('nomor_hp') ? 'is-invalid' : '' }}">
                        <span class="phone-prefix">+62</span>
                        <input type="tel" class="form-control phone-input" name="nomor_hp" id="registerPhone" placeholder="8xxxxxxxxx *" required value="{{ old('nomor_hp') }}" pattern="[0-9]{8,13}" maxlength="13" minlength="8">
                    </div>
                    <div class="phone-info-icon" data-tooltip="Masukkan nomor HP tanpa awalan 0 atau 62. Contoh: 81234567890">
                        <i class="fas fa-question-circle"></i>
                    </div>
                </div>
                @error('nomor_hp')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <select class="form-select {{ $errors->has('puskesmas_id') ? 'is-invalid' : '' }}" name="puskesmas_id" id="registerPuskesmas" required>
                    <option value="" disabled hidden {{ !old('puskesmas_id') ? 'selected' : '' }}>Pilih Puskesmas *</option>
                    <option value="kalasan" {{ old('puskesmas_id') == 'kalasan' ? 'selected' : '' }}>Puskesmas Kalasan</option>
                    <option value="godean_2" {{ old('puskesmas_id') == 'godean_2' ? 'selected' : '' }}>Puskesmas Godean 2</option>
                    <option value="umbulharjo" {{ old('puskesmas_id') == 'umbulharjo' ? 'selected' : '' }}>Puskesmas Umbulharjo</option>
                </select>
                @error('puskesmas_id')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            
            <!-- 4. Kode Verifikasi -->
            <div class="form-group">
                <input type="text" class="form-control {{ $errors->has('kode_pendaftaran') ? 'is-invalid' : '' }}" name="kode_pendaftaran" id="kodePendaftaran" placeholder="Kode Pendaftaran *" required value="{{ old('kode_pendaftaran') }}">
                <small class="form-text text-muted">Masukkan kode pendaftaran yang diberikan admin</small>
                @error('kode_pendaftaran')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="agreeTerms" required>
                <label for="agreeTerms">Saya menyetujui semua syarat & ketentuan</label>
            </div>
            <button type="submit" class="btn-primary">
                <span>Daftar Sekarang</span>
            </button>
            <div class="form-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login sekarang</a>
            </div>
        </form>
    </div>

    <!-- Modal Sukses Register -->
    <div class="modal-overlay {{ session('register_success') ? 'active' : '' }}" id="successModal">
        <div class="modal-container">
            <div class="modal-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>Pendaftaran Berhasil!</h3>
            <p>Akun Anda telah berhasil dibuat. Silakan login untuk melanjutkan.</p>
            <a href="{{ route('login') }}" class="btn-primary">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login Sekarang</span>
            </a>
        </div>
    </div>
@endsection

@section('hero_title', 'Daftar')
@section('hero_subtitle', 'Bergabunglah dengan pengguna lainnya untuk pengalaman kesehatan yang lebih baik')

@section('extra_styles')
<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-container {
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-20px);
        transition: all 0.3s ease;
    }
    
    .modal-overlay.active .modal-container {
        transform: translateY(0);
    }
    
    .modal-icon {
        font-size: 4rem;
        color: #38a169;
        margin-bottom: 20px;
    }
    
    .modal-container h3 {
        font-family: 'Quicksand', sans-serif;
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #2d3748;
    }
    
    .modal-container p {
        color: #4a5568;
        margin-bottom: 25px;
    }
    
    .modal-container .btn-primary {
        margin-bottom: 0;
    }
    
    /* Styling untuk tanda bintang merah */
    input[placeholder*="*"]::placeholder,
    select option[value=""]:first-child {
        color: #6c757d;
    }
    
    input[placeholder*="*"]::placeholder::after,
    select option[value=""]:first-child::after {
        content: " *";
        color: #dc3545;
        font-weight: bold;
    }
    
    /* Phone input styling */
    .phone-input-group {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background: white;
    }
    
    .phone-prefix {
        background: #f8f9fa;
        padding: 12px 15px;
        border-right: 1px solid #ddd;
        font-weight: 600;
        color: #495057;
        font-size: 1rem;
    }
    
    .phone-input {
        border: none !important;
        border-radius: 0 !important;
        flex: 1;
        padding: 12px 15px !important;
        font-size: 1rem;
    }
    
    .phone-input:focus {
        outline: none;
        box-shadow: none;
    }
    
    .phone-input-group:focus-within {
        border-color: #0B5E91;
        box-shadow: 0 0 0 0.2rem rgba(11, 94, 145, 0.25);
    }
    
    /* Error styling */
    .is-invalid {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    
    .phone-input-group.is-invalid {
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
    
    /* Phone input wrapper */
    .phone-input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
    }
    
    .phone-input-wrapper .phone-input-group {
        flex: 1;
        min-width: 0;
    }
    
    .phone-info-icon {
        position: relative;
        color: #6c757d;
        cursor: help;
        font-size: 0.9rem;
    }
    
    .phone-info-icon:hover {
        color: #0B5E91;
    }
    
    /* Tooltip */
    .phone-info-icon[data-tooltip]:hover::after {
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
    }
    
    .phone-info-icon[data-tooltip]:hover::before {
        content: '';
        position: absolute;
        bottom: 115%;
        right: 10px;
        border: 5px solid transparent;
        border-top-color: #333;
        z-index: 1000;
    }
</style>
@endsection

@section('extra_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('successModal');
        const phoneInput = document.getElementById('registerPhone');
        
        if (modal.classList.contains('active')) {
            // Jika modal aktif, tambahkan event listener untuk menutup modal saat klik di luar
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        }
        
        // Validasi nomor HP - hanya angka
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                // Hapus semua karakter non-digit
                let value = e.target.value.replace(/\D/g, '');
                
                // Hapus awalan 0 atau 62 jika ada
                if (value.startsWith('0')) {
                    value = value.substring(1);
                }
                if (value.startsWith('62')) {
                    value = value.substring(2);
                }
                
                // Batasi panjang maksimal 13 digit
                if (value.length > 13) {
                    value = value.substring(0, 13);
                }
                
                e.target.value = value;
                
                // Validasi panjang
                if (value.length < 8) {
                    e.target.setCustomValidity('Nomor HP minimal 8 digit');
                } else if (value.length > 13) {
                    e.target.setCustomValidity('Nomor HP maksimal 13 digit');
                } else {
                    e.target.setCustomValidity('');
                }
            });
            
            // Cegah paste karakter non-digit
            phoneInput.addEventListener('paste', function(e) {
                e.preventDefault();
                let paste = (e.clipboardData || window.clipboardData).getData('text');
                let cleanPaste = paste.replace(/\D/g, '');
                
                // Hapus awalan 0 atau 62 jika ada
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
        }
    });
</script>
@endsection