@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Edit User</h1>
        <p class="text-muted">Perbarui informasi pengguna di sini.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0">
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
                    <form action="{{ route('admin.userUpdate', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama:</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label">Nomor HP:</label>
                            <input type="text" id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" class="form-control" pattern="^08[0-9]{8,11}$" title="Nomor HP harus diawali 08 dan 10-13 digit, contoh: 081255693035" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin:</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usia" class="form-label">Usia:</label>
                            <input type="number" id="usia" name="usia" value="{{ old('usia', $user->usia) }}" class="form-control" min="1" max="120" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <input type="text" id="role" name="role" value="{{ $user->role }}" class="form-control" readonly>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah):</label>
                            <input type="password" id="passwordEdit" name="password" class="form-control" minlength="8" autocomplete="new-password">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('passwordEdit', this)">
                                <i class="bi bi-eye-slash" id="iconPasswordEdit"></i>
                            </span>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar User
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconSpan) {
    const input = document.getElementById(inputId);
    const icon = iconSpan.querySelector('i');
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
.card { border-radius: 15px; }
.btn { transition: all 0.3s ease; }
.btn:hover { transform: scale(1.05); }
</style>
@endsection