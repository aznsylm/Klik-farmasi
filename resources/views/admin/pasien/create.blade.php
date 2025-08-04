@extends('layouts.admin')

@section('title', 'Tambah Pasien')

@section('content')
<div class="container py-5">
    
    <!-- Tombol Kembali -->
    <div class="back-button">
        <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pasien
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Tambah Pasien Baru</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form action="{{ route('admin.addPasien') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama:<span style="color: red">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email:<span style="color: red">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nomor_hp" class="form-label">Nomor HP (Whatsapp):<span style="color: red">*</span></label>
                        <input type="text" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" class="form-control" pattern="^08[0-9]{8,11}$" title="Nomor HP harus diawali 08 dan 10-13 digit, contoh: 081255693035" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin:<span style="color: red">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="usia" class="form-label">Usia:<span style="color: red">*</span></label>
                        <input type="number" id="usia" name="usia" value="{{ old('usia') }}" class="form-control" min="1" max="120" required>
                    </div>
                    <div class="col-md-6 mb-3 password-field">
                        <label for="password" class="form-label">Password:<span style="color: red">*</span></label>
                        <input type="password" id="passwordCreate" name="password" class="form-control" minlength="8" placeholder="Minimal 8 karakter, huruf & angka" required>
                        <button type="button" class="password-toggle " onclick="togglePassword('passwordCreate')" >
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>
                
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = "password";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }
</script>

<style>
    .password-field {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        z-index: 10;
    }
</style>
@endsection