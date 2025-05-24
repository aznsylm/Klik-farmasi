@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
    <div class="container py-5">

        <div class="text-center mb-4">
            <h1 class="fw-bold">Daftar Pasien</h1>
            <p class="text-muted">Kelola data pasien dengan mudah di halaman ini.</p>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Fitur Pencarian -->
        <form method="GET" action="{{ route('admin.users') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Cari ..." value="{{ request('search') }}">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('admin.users') }}" class="btn btn-secondary w-100">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            </div>
        </form>

        <!-- Tombol Kembali ke Dashboard -->
        <div class="text-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <!-- Tombol Tambah Pasien -->
        <div class="mb-4 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahPasien">
                <i class="bi bi-person-plus"></i> Tambah Pasien
            </button>
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
                                <a href="{{ route('admin.userDetail', $user->id) }}" class="btn btn-info btn-sm me-1">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.userEdit', $user->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}
        </div>

        @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('modalTambahPasien'));
                modal.show();
            });
        </script>
        @endif

        <!-- Modal Tambah Pasien -->
        <div class="modal fade" id="modalTambahPasien" tabindex="-1" aria-labelledby="modalTambahPasienLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.addPasien') }}">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTambahPasienLabel">Tambah Pasien Baru</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nomor HP | 08xxx-xxxx-xxxx</label>
                        <input type="text" name="nomor_hp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Usia</label>
                        <input type="number" name="usia" class="form-control" min="1" max="120" required>
                    </div>
                    <div class="mb-3">
                    <label>Password</label>
                        <div class="position-relative">
                            <input type="password" name="password" class="form-control" id="addPasienPassword" required minlength="8" placeholder="Minimal 8 karakter, huruf & angka">
                            <i class="fas fa-eye-slash password-toggle"
                            style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #6c757d;"
                            onclick="togglePassword('addPasienPassword', this)"></i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan</button>
                </div>
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

        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }

        /* Tombol */
        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-danger:hover {
            background-color: #a71d2a;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
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
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            }
        }
    </script>
@endsection