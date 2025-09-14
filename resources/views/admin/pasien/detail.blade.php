@extends('layouts.admin')

@section('title', 'Detail Pasien')

@section('content')
    <div class="container py-5">
        <!-- Tombol Kembali -->
        <div class="back-button">
            <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pasien
            </a>
        </div>

        @php
            $allPengingat = $user->pengingatObat()->latest()->get();
            $selectedPengingat = $allPengingat->first();

            // Calculate if 91 days have passed for the selected pengingat
            $isOver91Days = false;
            if ($selectedPengingat) {
                $tanggalMulai = \Carbon\Carbon::parse($selectedPengingat->created_at)->startOfDay();
                $now = \Carbon\Carbon::now('Asia/Jakarta');
                $daysDiff = $tanggalMulai->diffInDays($now);
                $isOver91Days = $daysDiff >= 91;
            }
        @endphp

        <!-- Sticky Alert untuk Catatan Keluhan Pasien -->
        @if ($allPengingat->isNotEmpty() && $selectedPengingat && $selectedPengingat->catatan)
            <div class="alert alert-warning alert-dismissible mb-4 shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    </div>
                    <div class="flex-grow-1">
                        <strong>Catatan dari {{ $user->name }}:</strong>
                        <span class="ms-2">{{ Str::limit($selectedPengingat->catatan, 120) }}</span>
                        @if (strlen($selectedPengingat->catatan) > 120)
                            <a href="#catatanKeluhan" class="text-decoration-none ms-2">[Lihat Selengkapnya]</a>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Profil Pasien</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th width="35%">Nama</th>
                                <td width="5%">:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                                <td>:</td>
                                <td>{{ $user->usia }} tahun</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td>{{ $user->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Whatsapp</th>
                                <td>:</td>
                                <td>{{ $user->nomor_hp }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>:</td>
                                <td>
                                    <form action="{{ route('admin.pasien.resetPassword', $user->id) }}" method="POST"
                                        class="d-flex gap-2">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <input type="password" name="new_password" class="form-control form-control-sm"
                                                placeholder="Password baru" required id="passwordInput">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="togglePassword('passwordInput')">
                                                <i class="bi bi-eye-slash"></i>
                                            </button>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-sm">Edit</button>
                                    </form>
                                    @error('new_password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat pada</th>
                                <td>:</td>
                                <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Puskesmas</th>
                                <td>:</td>
                                <td>{{ $user->puskesmas_id }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <div
                                style="width: 150px; height: 150px; background-color: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 60px; color: #6c757d;">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editPasienModal">
                                    Edit Pasien
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Pengingat Obat -->
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Pengingat Obat</h5>
            </div>
            <div class="card-body">

                @forelse($allPengingat as $pengingat)
                    <div class="alert pengingat-item"
                        style="background-color: #e3f2fd; border-color: #0b5e91; color: #0b5e91;"
                        data-status="{{ $pengingat->status }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Pengobatan {{ $pengingat->diagnosa }}</h6>
                                <p class="mb-1">Mulai:
                                    {{ \Carbon\Carbon::parse($pengingat->tanggal_mulai)->format('d M Y') }}</p>
                                <p class="mb-0">
                                    Status:
                                    @php
                                        $tanggalMulai = \Carbon\Carbon::parse($pengingat->created_at)->startOfDay();
                                        $now = \Carbon\Carbon::now('Asia/Jakarta');
                                        $daysDiff = $tanggalMulai->diffInDays($now);
                                        $currentWeek = floor($daysDiff / 7) + 1;
                                        $pengingatOver91Days = $daysDiff >= 91;
                                    @endphp
                                    <span class="badge" style="background-color: #0b5e91; color: white;">
                                        @if ($pengingat->status == 'aktif' && $pengingatOver91Days)
                                            Selesai (13 minggu)
                                        @else
                                            {{ ucfirst($pengingat->status) }}
                                        @endif
                                    </span>
                                </p>
                            </div>
                            @if ($pengingat->status == 'aktif' && !$pengingatOver91Days)
                                <form action="{{ route('admin.pengingat.stop', $pengingat->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghentikan pengobatan ini?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-stop-circle"></i> Stop Pengobatan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-muted mb-0">Tidak ada pengingat obat.</p>
                @endforelse
            </div>
        </div>

        @if ($allPengingat->isNotEmpty())
            <!-- Detail Data Pengingat Obat -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Data Pengingat Obat
                    </h5>
                    <div>
                        <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal"
                            data-bs-target="#tambahObatModal">
                            Tambah Obat
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="p-3 data-card rounded" style="background: #f8f9fa; border-left: 5px solid #0b5e91;">
                        <!-- Header Pengingat -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                @if ($selectedPengingat)
                                    <small class="text-muted">
                                        @if ($selectedPengingat->updated_at->ne($selectedPengingat->created_at))
                                            Terakhir diupdate: {{ $selectedPengingat->updated_at->format('d M Y, H:i') }}
                                            WIB
                                            <br>
                                            <span class="text-muted">(Dibuat:
                                                {{ $selectedPengingat->created_at->format('d M Y, H:i') }} WIB)</span>
                                        @else
                                            Dibuat: {{ $selectedPengingat->created_at->format('d M Y, H:i') }} WIB
                                        @endif
                                    </small>
                                @endif
                            </div>
                            <div class="col-md-6 text-md-end">
                                <span class="badge" style="background-color: #0b5e91; color: white;">
                                    {{ ucfirst($selectedPengingat->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Daftar Obat -->
                        <div class="mb-3">
                            <h6 class="mb-3 fw-bold">
                                Daftar Obat ({{ $selectedPengingat->detailObat->count() }} jenis)
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="30%">Nama Obat</th>
                                            <th width="15%">Jumlah</th>
                                            <th width="20%">Waktu Minum</th>
                                            <th width="20%">Suplemen</th>
                                            <th width="10%">Status</th>
                                            <th width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selectedPengingat->detailObat as $key => $obat)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td class="fw-medium">{{ $obat->nama_obat }}</td>
                                                <td>
                                                    {{ $obat->jumlah_obat }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }} WIB
                                                </td>
                                                <td>
                                                    @if ($obat->suplemen)
                                                        {{ $obat->suplemen }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ ucfirst($obat->status_obat) }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        onclick="editObat({{ $obat->id }}, '{{ $obat->nama_obat }}', '{{ $obat->jumlah_obat }}', '{{ $obat->waktu_minum }}', '{{ $obat->suplemen }}', '{{ $obat->status_obat }}')">
                                                        Edit
                                                    </button>
                                                    <form action="{{ route('admin.obat.delete', $obat->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Tekanan Darah -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up me-2"></i>
                        Grafik Tekanan Darah
                    </h5>
                    <div>
                        <button type="button" class="btn btn-success btn-sm me-2" onclick="showTambahDataModal()">
                            Tambah Data
                        </button>
                        <button type="button" class="btn btn-primary btn-sm me-2" onclick="showDataTable()">
                            Lihat Data
                        </button>
                        @if ($selectedPengingat && ($selectedPengingat->status !== 'aktif' || $isOver91Days))
                            <button type="button" class="btn btn-success btn-sm" onclick="showPDFModal()">
                                <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                            </button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="chart-container">
                                <canvas id="tekananDarahChart" width="400" height="300"></canvas>
                                <div id="chartPlaceholder" class="text-center py-5" style="display: none;">
                                    <i class="bi bi-graph-up text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-3">Belum ada data untuk ditampilkan</p>
                                    <small class="text-muted">Grafik akan muncul setelah ada input tekanan darah</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Tekanan Darah -->
            <div class="card mt-4" id="dataTableCard" style="display: none;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-table me-2"></i>
                        Data Tekanan Darah
                    </h5>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="hideDataTable()">
                        <i class="bi bi-x-lg me-1"></i> Tutup
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tekananDarahTable">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Sistol</th>
                                    <th>Diastol</th>
                                    <th>Sumber</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tekananDarahTableBody">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Catatan Keluhan/Pengobatan -->
            <div class="card mt-4" id="catatanKeluhan">
                <div class="card-header">
                    <h5 class="mb-0">
                        Catatan Keluhan dari {{ $user->name }}
                    </h5>
                </div>
                <div class="card-body">
                    @if ($selectedPengingat->catatan)
                        <div class="p-3 bg-light rounded">
                            <p class="mb-0">{{ $selectedPengingat->catatan }}</p>
                            <small class="text-muted mt-2 d-block">
                                Terakhir diupdate:
                                {{ \Carbon\Carbon::parse($selectedPengingat->updated_at)->format('d M Y, H:i') }} WIB
                            </small>
                        </div>
                    @else
                        <p class="text-muted mb-0 fst-italic">{{ $user->name }} belum menambahkan catatan keluhan atau
                            pengobatan</p>
                    @endif
                </div>
            </div>

        @endif

        <!-- Catatan untuk Pasien -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Catatan untuk {{ $user->name }}</h5>
            </div>
            <div class="card-body">
                <!-- Form Tambah/Edit Catatan -->
                <div class="mb-4">
                    <form id="formCatatan" action="{{ route('admin.catatan.simpan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="catatan_id" id="catatanId">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Catatan</label>
                            <textarea class="form-control" name="isi_catatan" id="isiCatatan" rows="4"
                                placeholder="Tulis catatan untuk {{ $user->name }}..." required></textarea>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" id="btnSimpan">
                                Simpan Catatan
                            </button>
                            <button type="button" class="btn btn-secondary" id="btnBatal" onclick="batalEdit()"
                                style="display: none;">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Daftar Catatan -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">No</th>
                                <th width="60%">Isi Catatan</th>
                                <th width="20%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->catatanDariAdmin as $key => $catatan)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ Str::limit($catatan->isi_catatan, 150) }}</td>
                                    <td>
                                        <span class="badge" style="background-color: #0b5e91; color: white;">
                                            {{ $catatan->status_baca == 'sudah_dibaca' ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm"
                                            data-id="{{ $catatan->id }}"
                                            data-isi="{{ htmlspecialchars($catatan->isi_catatan, ENT_QUOTES) }}"
                                            onclick="openEditModal(this.dataset.id, this.dataset.isi)">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.catatan.hapus', $catatan->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus catatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-journal-x fs-1 d-block mb-2"></i>
                                        Belum ada catatan untuk pasien ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Catatan -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Catatan untuk {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="modalForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Isi Catatan</label>
                            <textarea class="form-control" id="modalCatatan" name="isi_catatan" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pasien -->
    <div class="modal fade" id="editPasienModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editPasienForm" action="{{ route('admin.pasienUpdate', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" class="form-control" name="nomor_hp"
                                    value="{{ $user->nomor_hp }}" required pattern="[0-9]{8,13}" maxlength="13"
                                    minlength="8" placeholder="8xxxxxxxxx">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" class="form-control" name="usia" value="{{ $user->usia }}"
                                min="1" max="120" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Puskesmas</label>
                            <select class="form-control" name="puskesmas_id" required>
                                <option value="kalasan" {{ $user->puskesmas_id == 'kalasan' ? 'selected' : '' }}>Kalasan
                                </option>
                                <option value="godean_2" {{ $user->puskesmas_id == 'godean_2' ? 'selected' : '' }}>Godean
                                    2</option>
                                <option value="umbulharjo" {{ $user->puskesmas_id == 'umbulharjo' ? 'selected' : '' }}>
                                    Umbulharjo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning" id="editPasienBtn">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="tambahObatModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Obat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="tambahObatForm" action="{{ route('admin.obat.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pengingat_obat_id" value="{{ $selectedPengingat->id ?? '' }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Obat</label>
                            <select class="form-select" name="nama_obat" required>
                                <option value="">-- Pilih nama obat --</option>
                                @include('admin.partials.drug-options')
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Obat</label>
                            <select class="form-select" name="jumlah_obat" required>
                                <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                                <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                                <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Waktu Minum</label>
                            <select class="form-select" name="waktu_minum" required>
                                <option value="">-- Pilih jam --</option>
                                <option value="06:00">06.00 (Pagi)</option>
                                <option value="07:00">07.00 (Pagi)</option>
                                <option value="09:00">09.00 (Pagi)</option>
                                <option value="12:00">12.00 (Siang)</option>
                                <option value="13:00">13.00 (Siang)</option>
                                <option value="15:00">15.00 (Sore)</option>
                                <option value="18:00">18.00 (Sore)</option>
                                <option value="19:00">19.00 (Malam)</option>
                                <option value="21:00">21.00 (Malam)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Suplemen Tambahan (Opsional)</label>
                            <select class="form-select" name="suplemen">
                                <option value="">-- Pilih suplemen jika ada --</option>
                                <option value="Asam folat">Asam Folat</option>
                                <option value="Zat besi">Zat Besi</option>
                                <option value="Kalsium">Kalsium</option>
                                <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Obat</label>
                            <select class="form-select" name="status_obat" required>
                                <option value="aktif">Aktif</option>
                                <option value="habis">Habis</option>
                                <option value="berhenti">Berhenti</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="tambahObatBtn">Tambah Obat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Obat -->
    <div class="modal fade" id="editObatModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editObatForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Obat</label>
                            <select class="form-select" name="nama_obat" id="editNamaObat" required>
                                <option value="">-- Pilih nama obat --</option>
                                @include('admin.partials.drug-options')
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Obat</label>
                            <select class="form-select" name="jumlah_obat" id="editJumlahObat" required>
                                <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                                <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                                <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Waktu Minum</label>
                            <select class="form-select" name="waktu_minum" id="editWaktuMinum" required>
                                <option value="">-- Pilih jam --</option>
                                <option value="06:00">06.00 (Pagi)</option>
                                <option value="07:00">07.00 (Pagi)</option>
                                <option value="09:00">09.00 (Pagi)</option>
                                <option value="12:00">12.00 (Siang)</option>
                                <option value="13:00">13.00 (Siang)</option>
                                <option value="15:00">15.00 (Sore)</option>
                                <option value="18:00">18.00 (Sore)</option>
                                <option value="19:00">19.00 (Malam)</option>
                                <option value="21:00">21.00 (Malam)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Suplemen Tambahan (Opsional)</label>
                            <select class="form-select" name="suplemen" id="editSuplemen">
                                <option value="">-- Pilih suplemen jika ada --</option>
                                <option value="Asam folat">Asam Folat</option>
                                <option value="Zat besi">Zat Besi</option>
                                <option value="Kalsium">Kalsium</option>
                                <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Obat</label>
                            <select class="form-select" name="status_obat" id="editStatusObat" required>
                                <option value="aktif">Aktif</option>
                                <option value="habis">Habis</option>
                                <option value="berhenti">Berhenti</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning" id="editObatBtn">Update Obat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Tekanan Darah -->
    <div class="modal fade" id="tambahTekananDarahModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Tekanan Darah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="tambahTekananDarahForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" id="tambahTanggal" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Sistol (mmHg)</label>
                                <input type="number" class="form-control" id="tambahSistol" min="50"
                                    max="250" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diastol (mmHg)</label>
                                <input type="number" class="form-control" id="tambahDiastol" min="50"
                                    max="150" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="tambahTekananBtn">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tekanan Darah -->
    <div class="modal fade" id="editTekananDarahModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Tekanan Darah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editTekananDarahForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Sistol (mmHg)</label>
                                <input type="number" class="form-control" id="editSistol" min="50"
                                    max="250" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diastol (mmHg)</label>
                                <input type="number" class="form-control" id="editDiastol" min="50"
                                    max="150" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning" id="updateTekananBtn">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function openEditModal(id, isi) {
            // Set modal form data
            document.getElementById('modalCatatan').value = isi;
            document.getElementById('modalForm').action = '{{ url('/admin/catatan') }}/' + id;

            // Add method PUT
            let methodInput = document.querySelector('#modalForm input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                document.getElementById('modalForm').appendChild(methodInput);
            }

            // Show modal
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }

        // Handle modal form submission - form submit biasa dengan loading
        document.getElementById('modalForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';
        });

        // Handle edit pasien form submission
        document.getElementById('editPasienForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('editPasienBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';
        });

        // Function to show tambah data modal
        function showTambahDataModal() {
            // Reset form
            document.getElementById('tambahTekananDarahForm').reset();
            document.getElementById('tambahTanggal').value = new Date().toISOString().split('T')[0];
            new bootstrap.Modal(document.getElementById('tambahTekananDarahModal')).show();
        }

        // Handle tambah data form submission
        document.getElementById('tambahTekananDarahForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('tambahTekananBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';

            const formData = {
                user_id: {{ $user->id }},
                tanggal_input: document.getElementById('tambahTanggal').value,
                sistol: parseInt(document.getElementById('tambahSistol').value),
                diastol: parseInt(document.getElementById('tambahDiastol').value),
                _token: '{{ csrf_token() }}'
            };

            fetch('{{ route('admin.tekanan-darah.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('tambahTekananDarahModal')).hide();
                        alert('Data berhasil ditambahkan');
                        loadChartData();
                        if (document.getElementById('dataTableCard').style.display !== 'none') {
                            loadTableData();
                        }
                        // Reset form
                        document.getElementById('tambahTekananDarahForm').reset();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Tambah Data';
                });
        });

        // Handle edit data form submission
        document.getElementById('editTekananDarahForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('updateTekananBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';

            const formData = {
                sistol: parseInt(document.getElementById('editSistol').value),
                diastol: parseInt(document.getElementById('editDiastol').value),
                _token: '{{ csrf_token() }}',
                _method: 'PUT'
            };

            fetch(`{{ url('/admin/tekanan-darah') }}/${currentEditId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('editTekananDarahModal')).hide();
                        alert('Data berhasil diupdate');
                        loadChartData();
                        if (document.getElementById('dataTableCard').style.display !== 'none') {
                            loadTableData();
                        }
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate data');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Update Data';
                });
        });

        let currentEditId = null;

        function editTekananDarah(id, tanggal, sistol, diastol) {
            currentEditId = id;
            document.getElementById('editSistol').value = sistol;
            document.getElementById('editDiastol').value = diastol;
            new bootstrap.Modal(document.getElementById('editTekananDarahModal')).show();
        }

        // Validasi input angka untuk sistol dan diastol
        function validateBloodPressure() {
            const sistolInputs = document.querySelectorAll('#tambahSistol, #editSistol');
            const diastolInputs = document.querySelectorAll('#tambahDiastol, #editDiastol');
            
            sistolInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value < 50) this.value = 50;
                    if (this.value > 250) this.value = 250;
                });
            });
            
            diastolInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value < 50) this.value = 50;
                    if (this.value > 150) this.value = 150;
                });
            });
        }

        function deleteTekananDarah(id) {
            if (confirm('Yakin ingin menghapus data tekanan darah ini?')) {
                fetch(`{{ url('/admin/tekanan-darah') }}/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Data berhasil dihapus');
                            loadChartData();
                            if (document.getElementById('dataTableCard').style.display !== 'none') {
                                loadTableData();
                            }
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus data');
                    });
            }
        }

        // Phone input validation - only numbers
        const phoneInput = document.querySelector('input[name="nomor_hp"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 13) value = value.substring(0, 13);
                e.target.value = value;
            });
        }

        // Handle tambah obat form submission
        document.getElementById('tambahObatForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('tambahObatBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';
        });

        // Handle edit obat form submission
        document.getElementById('editObatForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('editObatBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';
        });

        // Function to edit obat
        function editObat(id, nama, jumlah, waktu, suplemen, status) {
            document.getElementById('editNamaObat').value = nama;
            document.getElementById('editJumlahObat').value = jumlah;
            document.getElementById('editWaktuMinum').value = waktu;
            document.getElementById('editSuplemen').value = suplemen || '';
            document.getElementById('editStatusObat').value = status;
            document.getElementById('editObatForm').action = '{{ url('/admin/obat') }}/' + id;
            new bootstrap.Modal(document.getElementById('editObatModal')).show();
        }

        // Chart and data management
        let tekananDarahChart = null;
        let chartData = [];

        function initChart() {
            console.log('Initializing chart...');
            const canvas = document.getElementById('tekananDarahChart');
            if (!canvas) {
                console.error('Canvas element not found!');
                return;
            }
            const ctx = canvas.getContext('2d');
            tekananDarahChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Sistol',
                        data: [],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.4,
                        fill: false
                    }, {
                        label: 'Diastol',
                        data: [],
                        borderColor: '#0b5e91',
                        backgroundColor: 'rgba(11, 94, 145, 0.1)',
                        tension: 0.4,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    spanGaps: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Riwayat Tekanan Darah (mmHg)'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 40,
                            max: 260,
                            title: {
                                display: true,
                                text: 'mmHg'
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal'
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        }
                    }
                }
            });
        }

        function loadChartData() {
            fetch('{{ route('admin.pasien.tekanan-darah.chart', $user->id) }}', {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    chartData = data.data || [];
                    if (data.labels && data.labels.length > 0) {
                        tekananDarahChart.data.labels = data.labels;
                        tekananDarahChart.data.datasets[0].data = data.sistol;
                        tekananDarahChart.data.datasets[1].data = data.diastol;
                        tekananDarahChart.update();

                        document.getElementById('tekananDarahChart').style.display = 'block';
                        document.getElementById('chartPlaceholder').style.display = 'none';
                    } else {
                        document.getElementById('tekananDarahChart').style.display = 'none';
                        document.getElementById('chartPlaceholder').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Chart loading error:', error);
                    document.getElementById('tekananDarahChart').style.display = 'none';
                    document.getElementById('chartPlaceholder').style.display = 'block';
                });
        }

        function showDataTable() {
            document.getElementById('dataTableCard').style.display = 'block';
            loadTableData();
        }

        function hideDataTable() {
            document.getElementById('dataTableCard').style.display = 'none';
        }

        function loadTableData() {
            const tbody = document.getElementById('tekananDarahTableBody');
            tbody.innerHTML = '';

            if (chartData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Belum ada data tekanan darah</td></tr>';
                return;
            }

            chartData.forEach((item, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${new Date(item.tanggal).toLocaleDateString('id-ID')}</td>
                        <td>${item.sistol}</td>
                        <td>${item.diastol}</td>
                        <td>${item.sumber === 'input_harian' ? 'Input Pasien' : item.sumber === 'admin_input' ? 'Input Admin' : 'Edit Admin'}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editTekananDarah(${item.id}, '${item.tanggal}', ${item.sistol}, ${item.diastol})">
                                Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteTekananDarah(${item.id})">
                                Hapus
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        // Initialize form state dan notifikasi
        document.addEventListener('DOMContentLoaded', function() {
            const btnBatal = document.getElementById('btnBatal');
            if (btnBatal) {
                btnBatal.style.display = 'none';
            }

            // Initialize chart
            console.log('DOM loaded, initializing chart...');
            initChart();
            loadChartData();
            
            // Initialize validasi
            validateBloodPressure();

            // Notifikasi dari session Laravel
            @if (session('success'))
                alert('✅ {{ session('success') }}');
            @endif

            @if (session('error'))
                alert('❌ {{ session('error') }}');
            @endif

            @if (session('obat_success'))
                alert('✅ {{ session('obat_success') }}');
            @endif
        });

        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye-slash';
            }
        }

        // Function untuk batalkan edit catatan
        function batalEdit() {
            document.getElementById('isiCatatan').value = '';
            document.getElementById('catatanId').value = '';
            document.getElementById('btnSimpan').textContent = 'Simpan Catatan';
            document.getElementById('btnBatal').style.display = 'none';
        }

        // PDF Modal functions
        function showPDFModal() {
            const modal = new bootstrap.Modal(document.getElementById('pdfModal'));
            const iframe = document.getElementById('pdfIframe');
            iframe.src = '{{ route('admin.pasien.tekanan-darah.pdf', $user->id) }}';
            modal.show();
        }

        // Clear iframe when modal is hidden
        const pdfModal = document.getElementById('pdfModal');
        if (pdfModal) {
            pdfModal.addEventListener('hidden.bs.modal', function() {
                document.getElementById('pdfIframe').src = '';
            });
        }
    </script>



    <!-- PDF Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Laporan Tekanan Darah - {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe id="pdfIframe" width="100%" height="600" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
