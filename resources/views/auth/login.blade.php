@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Login</h2>
    <form method="POST" action="{{ route('login') }}" class="mx-auto" style="max-width:400px;">
        @csrf

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
            <label for="login" class="form-label">Email atau Nomor HP</label>
            <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" required autofocus>
            @error('login')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword()">
                <i class="bi bi-eye-slash" id="togglePasswordIcon"></i>
            </span>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
            <small>
                Belum punya akun?
                <a href="{{ route('register') }}" class="fw-bold text-decoration-underline">Daftar sebagai pasien</a>
            </small>
        </div>
    </form>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
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