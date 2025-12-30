@extends('layouts.admin')

@section('title', 'Daftar Pasien')

@section('content')
    <div class="container py-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Daftar Pasien</h1>
            <p class="text-muted mb-0">
                Puskesmas
                @if (auth()->user()->puskesmas == 'kalasan')
                    Kalasan
                @elseif(auth()->user()->puskesmas == 'godean_2')
                    Godean 2
                @elseif(auth()->user()->puskesmas == 'umbulharjo')
                    Umbulharjo
                @endif
            </p>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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

        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
            <!-- Tombol Tambah Pasien -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahPasienModal">
                Tambah Pasien
            </button>
            <!-- Fitur Pencarian -->
            <form method="GET" action="{{ route('admin.pasien') }}" class="d-flex gap-2 mb-2 flex-grow-1"
                style="max-width:400px;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari ..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>
                    <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </form>
            <!-- Tombol Kembali ke Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-2">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Tabel Daftar User -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
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
                    @forelse ($users as $i => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nomor_hp }}</td>
                            <td>{{ $user->jenis_kelamin }}</td>
                            <td>{{ $user->usia }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.pasienDetail', $user->id) }}" class="btn btn-info btn-sm me-1">
                                    Detail
                                </a>
                                <form action="{{ route('admin.deletePasien', $user->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data pasien.</td>
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

    <!-- Modal Tambah Pasien -->
    <div class="modal fade" id="tambahPasienModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pasien Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="tambahPasienForm" action="{{ route('admin.addPasien') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Kelamin</label>
                            <select class="form-select" name="jenis_kelamin" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Usia</label>
                            <input type="number" class="form-control" name="usia" min="1" max="120"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="passwordField"
                                    minlength="8" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="passwordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Konfirmasi Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="confirmPasswordField" minlength="8" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye-slash" id="confirmPasswordIcon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">WhatsApp</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" class="form-control" name="nomor_hp" placeholder="8xxxxxxxxx"
                                    pattern="[0-9]{8,13}" maxlength="13" minlength="8" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Puskesmas</label>
                            <select class="form-select" name="puskesmas" required>
                                @if (auth()->user()->role === 'super_admin')
                                    <option value="">-- Pilih Puskesmas --</option>
                                    <option value="kalasan">Puskesmas Kalasan</option>
                                    <option value="godean_2">Puskesmas Godean 2</option>
                                    <option value="umbulharjo">Puskesmas Umbulharjo</option>
                                @else
                                    <option value="{{ auth()->user()->puskesmas }}" selected>
                                        Puskesmas
                                        @if (auth()->user()->puskesmas == 'kalasan')
                                            Kalasan
                                        @elseif(auth()->user()->puskesmas == 'godean_2')
                                            Godean 2
                                        @elseif(auth()->user()->puskesmas == 'umbulharjo')
                                            Umbulharjo
                                        @endif
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="tambahPasienBtn">Tambah Pasien</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Tabel */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead {
            background-color: #343a40;
            color: #fff;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table td,
        .table th {
            vertical-align: middle;
            text-align: left;
        }

        /* Pagination Style */
        .pagination {
            justify-content: center;
        }

        .pagination .page-item .page-link {
            color: #0b5e91;
            border-radius: 6px;
            margin: 0 2px;
            border: 1px solid #e2e8f0;
            transition: background 0.2s, color 0.2s;
        }

        .pagination .page-item.active .page-link {
            background: #0b5e91;
            color: #fff;
            border-color: #0b5e91;
        }

        .pagination .page-item .page-link:hover {
            background: #e6f2fa;
            color: #0b5e91;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem;
            }

            .btn {
                font-size: 0.7rem;
                padding: 5px 10px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle tambah pasien form submission
            document.getElementById('tambahPasienForm').addEventListener('submit', function(e) {
                const submitBtn = document.getElementById('tambahPasienBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Menyimpan...';
            });

            // Phone input validation - only numbers
            const phoneInput = document.querySelector('input[name="nomor_hp"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 13) value = value.substring(0, 13);
                    e.target.value = value;
                });
            }

            // Password toggle functionality
            document.getElementById('togglePassword').addEventListener('click', function() {
                const passwordField = document.getElementById('passwordField');
                const passwordIcon = document.getElementById('passwordIcon');

                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    passwordIcon.className = 'bi bi-eye';
                } else {
                    passwordField.type = 'password';
                    passwordIcon.className = 'bi bi-eye-slash';
                }
            });

            document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
                const confirmPasswordField = document.getElementById('confirmPasswordField');
                const confirmPasswordIcon = document.getElementById('confirmPasswordIcon');

                if (confirmPasswordField.type === 'password') {
                    confirmPasswordField.type = 'text';
                    confirmPasswordIcon.className = 'bi bi-eye';
                } else {
                    confirmPasswordField.type = 'password';
                    confirmPasswordIcon.className = 'bi bi-eye-slash';
                }
            });

            // Show modal if there are validation errors
            @if ($errors->any())
                new bootstrap.Modal(document.getElementById('tambahPasienModal')).show();
            @endif
        });
    </script>
@endsection
