@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Daftar User</h1>
            <p class="text-muted">Kelola data pengguna dengan mudah di halaman ini.</p>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabel Daftar User -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">
                                <!-- Tombol Lihat Detail -->
                                <a href="{{ route('admin.userDetail', $user->id) }}" class="btn btn-info btn-sm me-1">
                                    <i class="bi bi-eye"></i> Detail
                                </a>

                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.userEdit', $user->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <div class="text-center mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <style>
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

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

        /* Responsiveness */
        @media (max-width: 768px) {
            .table {
                font-size: 0.9rem; /* Kurangi ukuran font tabel di layar kecil */
            }

            .btn {
                font-size: 0.7rem; /* Kurangi ukuran font tombol di layar kecil */
                padding: 5px 10px; /* Kurangi padding tombol di layar kecil */
            }
        }
    </style>
@endsection