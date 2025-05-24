@extends('layouts.auth')

@section('title', 'Register')

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
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="registerName" placeholder="Nama Lengkap" required value="{{ old('name') }}">
            </div>
            <div class="form-group row">
                <div>
                    <input type="email" class="form-control" name="email" id="registerEmail" placeholder="Email Aktif" required value="{{ old('email') }}">
                </div>
                <div>
                    <input type="tel" class="form-control" name="nomor_hp" id="registerPhone" placeholder="Nomor HP" required value="{{ old('nomor_hp') }}">
                </div>
            </div>
            <div class="form-group row">
                <div>
                    <select class="form-select" name="jenis_kelamin" id="registerGender" required>
                        <option value="" disabled {{ !old('jenis_kelamin') ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <input type="number" class="form-control" name="usia" id="registerAge" placeholder="Usia" min="1" max="120" required value="{{ old('usia') }}">
                </div>
            </div>
            <div class="form-group row">
                <div>
                    <div class="password-group">
                        <input type="password" class="form-control" name="password" id="registerPassword" placeholder="Buat Password" required minlength="8">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('registerPassword', this)"></i>
                    </div>
                </div>
                <div>
                    <div class="password-group">
                        <input type="password" class="form-control" name="password_confirmation" id="registerConfirmPassword" placeholder="Konfirmasi Password" required minlength="8">
                        <i class="fas fa-eye-slash password-toggle" onclick="togglePassword('registerConfirmPassword', this)"></i>
                    </div>
                </div>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="agreeTerms" required>
                <label for="agreeTerms">Saya menyetujui semua syarat & ketentuan</label>
            </div>
            <button type="submit" class="btn-primary">
                <i class="fas fa-user-plus"></i>
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
</style>
@endsection

@section('extra_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('successModal');
        
        if (modal.classList.contains('active')) {
            // Jika modal aktif, tambahkan event listener untuk menutup modal saat klik di luar
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        }
    });
</script>
@endsection