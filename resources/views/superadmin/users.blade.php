@extends('layouts.app')
@section('title', 'Kelola User')
@section('content')
    <div class="container py-5">

        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi gagal -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-x-circle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Button Daftar Admin & Daftar Pasien -->
        <div class="mb-4 d-flex gap-2">
            <a href="{{ route('superadmin.users', ['role' => 'admin']) }}" class="btn btn-outline-primary {{ $role == 'admin' ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Daftar Admin
            </a>
            <a href="{{ route('superadmin.users', ['role' => 'pasien']) }}" class="btn btn-outline-success {{ $role == 'pasien' ? 'active' : '' }}">
                <i class="bi bi-people"></i> Daftar Pasien
            </a>
            @if($role == 'admin')
                <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalTambahAdmin">
                    <i class="bi bi-plus-circle"></i> Tambah Admin
                </button>
            @else
                <button class="btn btn-success ms-auto" data-bs-toggle="modal" data-bs-target="#modalTambahPasien">
                    <i class="bi bi-plus-circle"></i> Tambah Pasien
                </button>
            @endif
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('superadmin.users') }}" class="row g-2 mb-3">
            <input type="hidden" name="role" value="{{ $role }}">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, nomor HP, jenis kelamin, usia..." value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('superadmin.users', ['role' => $role]) }}" class="btn btn-secondary">Reset</a>
                @endif
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nomor_hp }}</td>
                            <td>{{ $user->jenis_kelamin }}</td>
                            <td>{{ $user->usia }}</td>
                            <td class="text-center">
                                <a href="{{ route('superadmin.userDetail', $user->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('superadmin.userEdit', $user->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('superadmin.deleteUser', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus {{ $role == 'admin' ? 'admin' : 'pasien' }} ini?')" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada {{ $role == 'admin' ? 'admin' : 'pasien' }} terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>

    <!-- Modal Tambah Admin -->
    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" aria-labelledby="modalTambahAdminLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('superadmin.addAdmin') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahAdminLabel">Tambah Admin Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Admin</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Admin</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" pattern="^08[0-9]{8,11}$" title="Nomor HP harus diawali 08 dan 10-13 digit, contoh: 081255693035" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" class="form-control" name="usia" min="18" max="120" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordAdminInput" required minlength="8">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('passwordAdminInput', this)">
                                <i class="bi bi-eye-slash" id="iconPasswordAdminInput"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Pasien -->
    <div class="modal fade" id="modalTambahPasien" tabindex="-1" aria-labelledby="modalTambahPasienLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('superadmin.addPasien') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPasienLabel">Tambah Pasien Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Pasien</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" name="nomor_hp" pattern="^08[0-9]{8,11}$" title="Nomor HP harus diawali 08 dan 10-13 digit, contoh: 081255693035" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="" disabled selected>Pilih jenis kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" class="form-control" name="usia" min="1" max="120" required>
                        </div>
                        <div class="mb-3 position-relative">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="passwordPasienInput" required minlength="8">
                            <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword('passwordPasienInput', this)">
                                <i class="bi bi-eye-slash" id="iconPasswordPasienInput"></i>
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </div>
            </form>
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
        .table { border-radius: 10px; overflow: hidden; }
        .table thead { background-color: #343a40; color: #fff; }
        .table-hover tbody tr:hover { background-color: #f8f9fa; }
        .table td, .table th { vertical-align: middle; text-align: center; }
        .btn { transition: all 0.3s ease; }
        .btn:hover { transform: scale(1.05); }
        .btn-danger:hover { background-color: #a71d2a; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-info:hover { background-color: #138496; }
        .btn-secondary { background-color: #6c757d; border: none; }
        .btn-secondary:hover { background-color: #5a6268; }
        .active { font-weight: bold; }
        @media (max-width: 768px) {
            .table { font-size: 0.9rem; }
            .btn { font-size: 0.7rem; padding: 5px 10px; }
        }
    </style>
@endsection