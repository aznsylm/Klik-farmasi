@extends('layouts.app')
@section('title', 'Registrasi')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Registrasi Akun Pasien</h2>
    
    {{-- Notifikasi sukses registrasi --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <strong><i class="bi bi-check-circle-fill"></i> Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('register.process') }}" class="mx-auto" style="max-width:450px;">
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Aktif</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled selected>Pilih jenis kelamin</option>
                <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="usia" class="form-label">Usia</label>
            <input type="number" class="form-control" id="usia" name="usia" value="{{ old('usia') }}" min="1" max="120" required>
        </div>
        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('password', 'togglePasswordIcon')">
                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
            </span>
        </div>
        <div class="mb-3 position-relative">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8">
            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('password_confirmation', 'togglePasswordIcon2')">
                <i class="bi bi-eye-slash" id="togglePasswordIcon2"></i>
            </span>
        </div>
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
        <div class="text-center mt-3">
            <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
        </div>
    </form>

    {{-- Modal Sukses Registrasi --}}
    <div class="modal fade" id="modalRegisterSuccess" tabindex="-1" aria-labelledby="modalRegisterSuccessLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="modalRegisterSuccessLabel"><i class="bi bi-check-circle-fill"></i> Registrasi Berhasil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <p class="mb-3">Akun Anda berhasil terdaftar.<br>Silakan login untuk melanjutkan.</p>
            <a href="{{ route('login') }}" class="btn btn-primary w-100">Login</a>
          </div>
        </div>
      </div>
    </div>
    
    @if(session('register_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = new bootstrap.Modal(document.getElementById('modalRegisterSuccess'));
            modal.show();
        });
    </script>
    @endif

</div>
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
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
@endsection