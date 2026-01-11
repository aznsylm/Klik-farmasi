@extends('layouts.admin')

@section('title', 'Detail Pasien - ' . $user->name)

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Pasien</h1>
                <p class="text-muted mb-0">{{ $user->name }}</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pasien') }}">Pasien</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

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



        <!-- Notifications -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fas fa-times-circle mr-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Back Button -->
        <div class="row mb-3">
            <div class="col-12">
                <a href="{{ route('admin.pasien') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Pasien
                </a>
            </div>
        </div>

        <!-- Patient Profile Card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user mr-1"></i> Profil Pasien</h3>
            </div>
            <div class="card-body">
                <!-- Alert Informatif -->
                @php
                    $alertMessage = '';
                    $alertClass = '';
                    
                    $latestPengingat = $user->pengingatObat()->latest()->first();
                    $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', $user->id)->latest()->first();
                    $allTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', $user->id)->orderBy('created_at', 'desc')->take(3)->get();
                    
                    // 1. Tekanan Darah Kritis (Stage 2)
                    if ($latestTekananDarah && ($latestTekananDarah->sistol >= 140 || $latestTekananDarah->diastol >= 90)) {
                        $alertMessage = 'Tekanan darah pasien tinggi (Stage 1/2)! Perlu segera dihubungi';
                        $alertClass = 'bg-danger text-white';
                    }
                    // 2. Tidak Input >30 Hari
                    elseif ($latestTekananDarah) {
                        $daysSinceLastInput = (int) \Carbon\Carbon::parse($latestTekananDarah->created_at)->diffInDays(now());
                        if ($daysSinceLastInput > 30) {
                            $alertMessage = 'Pasien sudah ' . $daysSinceLastInput . ' hari tidak catat tekanan darah. Perlu diingatkan';
                            $alertClass = 'bg-warning text-dark';
                        }
                    }
                    // 3. Trend Naik Konsisten
                    elseif ($allTekananDarah->count() >= 3) {
                        $data = $allTekananDarah->reverse()->values();
                        if ($data[0]->sistol < $data[1]->sistol && $data[1]->sistol < $data[2]->sistol) {
                            $alertMessage = 'Tekanan darah pasien terus naik dalam 3 catatan terakhir. Perlu perhatian khusus';
                            $alertClass = 'bg-info text-white';
                        }
                    }
                    // 4. Belum Ada Data
                    elseif (!$latestTekananDarah) {
                        $alertMessage = 'Pasien belum pernah input tekanan darah. Perlu panduan penggunaan';
                        $alertClass = 'bg-secondary text-white';
                    }
                @endphp
                
        @if($alertMessage)
        <div class="alert {{ $alertClass }} mb-4 fw-semibold" style="border: none; font-size: 14px;">
            {{ $alertMessage }}
        </div>
        @endif

        <!-- Blood Pressure Chart Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Grafik Tekanan Darah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm mr-1" onclick="showTambahDataModal()" title="Tambah Data">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm mr-1" onclick="showDataModal()" title="Lihat Data">
                        <i class="fas fa-eye"></i>
                    </button>
                    <a href="{{ route('admin.pasien.tekanan-darah.pdf', $user->id) }}" class="btn btn-danger btn-sm" title="Download PDF" target="_blank">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div style="position: relative; height: 350px;">
                    <canvas id="tekananDarahChart"></canvas>
                    <div id="chartPlaceholder" class="text-center py-5" style="display: none;">
                        <i class="fas fa-chart-line text-muted" style="font-size: 3rem;"></i>
                        <p class="text-muted mt-3">Belum ada data untuk ditampilkan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medication Data Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-pills mr-1"></i> Data Obat</h3>
                @if($selectedPengingat)
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahObatModal" title="Tambah Obat">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                @endif
            </div>
            <div class="card-body">
                    @if($selectedPengingat && $selectedPengingat->detailObat->count() > 0)
                        @php
                            $daysSinceStart = (int) \Carbon\Carbon::parse($selectedPengingat->created_at)->diffInDays(now());
                        @endphp
                        <div class="mb-3 p-2 rounded" style="background: #f8f9fa;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Mulai: {{ $selectedPengingat->created_at->format('d M Y') }} ({{ $daysSinceStart }} hari)</small>
                                </div>
                                @if ($selectedPengingat->status == 'aktif' && $daysSinceStart < 91)
                                <form action="{{ route('admin.pengingat.stop', $selectedPengingat->id) }}" method="POST" onsubmit="return confirmStop()" class="me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-stop-circle"></i> Stop
                                    </button>
                                </form>
                                @elseif ($selectedPengingat->status == 'tidak_aktif')
                                <form action="{{ route('admin.pengingat.activate', $selectedPengingat->id) }}" method="POST" onsubmit="return confirm('Pasien perlu mengisi ulang data pengingat. Lanjutkan?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-play-circle"></i> Aktifkan
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Obat</th>
                                        <th>Jumlah</th>
                                        <th>Waktu</th>
                                        <th>Suplemen</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedPengingat->detailObat as $obat)
                                    <tr>
                                        <td>{{ $obat->nama_obat }}</td>
                                        <td>{{ $obat->jumlah_obat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }}</td>
                                        <td>{{ $obat->suplemen ?? '-' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm" onclick="editObat({{ $obat->id }}, '{{ $obat->nama_obat }}', '{{ $obat->jumlah_obat }}', '{{ $obat->waktu_minum }}', '{{ $obat->suplemen }}', '{{ $obat->status_obat }}')" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.obat.delete', $obat->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-pills fa-3x mb-3"></i>
                                <p class="mb-2">Belum ada obat yang diatur</p>
                                @if($selectedPengingat)
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahObatModal">
                                    <i class="fas fa-plus mr-1"></i>Tambah Obat Pertama
                                </button>
                                @endif
                            </div>
                        </div>
                    @endif
            </div>
        </div>

        <!-- WhatsApp Tracking Card -->
        @if(!empty($trackingData))
        <div class="card mb-4" id="whatsapp-tracking">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-whatsapp mr-1"></i> Status Pengiriman Pengingat</h3>
                <div class="card-tools">
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.pasienDetail', ['id' => $user->id, 'period' => 'week']) }}#whatsapp-tracking" class="btn btn-sm {{ ($period ?? 'week') === 'week' ? 'btn-primary' : 'btn-outline-primary' }}">7 Hari</a>
                        <a href="{{ route('admin.pasienDetail', ['id' => $user->id, 'period' => 'month']) }}#whatsapp-tracking" class="btn btn-sm {{ ($period ?? 'week') === 'month' ? 'btn-primary' : 'btn-outline-primary' }}">30 Hari</a>
                        <a href="{{ route('admin.pasienDetail', ['id' => $user->id, 'period' => 'all']) }}#whatsapp-tracking" class="btn btn-sm {{ ($period ?? 'week') === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                    @foreach($trackingData as $track)
                    <div class="mb-3 p-3 border rounded">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong>{{ $track['obat']->nama_obat }} ({{ \Carbon\Carbon::parse($track['obat']->waktu_minum)->format('H:i') }})</strong>
                            @php
                                $validTrackingDays = collect($track['days'])->filter(fn($day) => !in_array($day['status'], ['not_added', 'future']));
                                $hasValidTracking = $validTrackingDays->count() > 0;
                            @endphp
                            @if($hasValidTracking)
                                <span class="badge bg-{{ $track['success_rate'] >= 80 ? 'success' : ($track['success_rate'] >= 60 ? 'warning' : 'danger') }}">{{ $track['success_rate'] }}% berhasil</span>
                            @else
                                <span class="badge bg-secondary">Belum ada data</span>
                            @endif
                        </div>
                        <div class="d-flex gap-1 flex-wrap">
                            @foreach($track['days'] as $day)
                            <div class="tracking-day {{ $day['is_today'] ? 'today' : '' }}" 
             style="min-width: 45px; max-width: 45px;" 
                                 data-bs-toggle="tooltip" 
                                 title="@if(isset($day['total'])){{ $day['day'] }} - Total: {{ $day['total'] }}, Berhasil: {{ $day['sent'] }}, Gagal: {{ $day['failed'] }}@else{{ \Carbon\Carbon::parse($day['date'])->format('D, d M') }} - {{ $day['status'] === 'not_added' ? 'Obat belum ditambahkan' : ucfirst($day['status'] === 'sent' ? 'Terkirim' : ($day['status'] === 'failed' ? 'Gagal' : 'Belum ada data')) }}@endif">
                                @if(isset($day['total']))
                                    @if($day['sent'] > $day['failed'])
                                        <span class="badge bg-success">✓</span>
                                    @elseif($day['failed'] > 0)
                                        <span class="badge bg-danger">✗</span>
                                    @else
                                        <span class="badge bg-warning text-dark">-</span>
                                    @endif
                                @else
                                    @if($day['status'] === 'sent')
                                        <span class="badge bg-success">✓</span>
                                    @elseif($day['status'] === 'failed')
                                        <span class="badge bg-danger">✗</span>
                                    @elseif($day['status'] === 'future')
                                        <span class="badge bg-warning text-dark">-</span>
                                    @elseif($day['status'] === 'not_added')
                                        <span class="badge bg-secondary text-white">N</span>
                                    @else
                                        <span class="badge bg-warning text-dark">-</span>
                                    @endif
                                @endif
                                <small class="d-block text-center mt-1">{{ $day['day'] }}</small>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-3">
                        <small class="text-muted">
                            <strong>Legend:</strong> 
                            <span class="badge bg-success me-1">✓</span> Terkirim
                            <span class="badge bg-danger me-1">✗</span> Gagal
                            <span class="badge bg-warning text-dark me-1">-</span> Belum ada data
                            <span class="badge bg-secondary text-white me-1">N</span> Obat belum ditambahkan
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Patient Profile Data Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-circle mr-1"></i> Data Profil Pasien</h3>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Nama Lengkap</label>
                            <p class="mb-0">{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Usia</label>
                            <p class="mb-0">{{ $user->usia }} tahun</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Jenis Kelamin</label>
                            <p class="mb-0">{{ $user->jenis_kelamin }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">WhatsApp</label>
                            <p class="mb-0">+{{ $user->nomor_hp }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Email</label>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Puskesmas</label>
                            <p class="mb-0">{{ ucwords(str_replace('_', ' ', $user->puskesmas)) }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Terdaftar</label>
                            <p class="mb-0">{{ $user->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 mb-3">
                            <label class="font-weight-bold text-muted">Reset Password</label>
                            <form action="{{ route('admin.pasien.resetPassword', $user->id) }}" method="POST" class="d-flex">
                                @csrf
                                <input type="password" name="new_password" class="form-control form-control-sm mr-2" placeholder="Password baru" required style="max-width: 150px;">
                                <button type="submit" class="btn btn-warning btn-sm">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle text-white" style="width: 80px; height: 80px; font-size: 2rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editPasienModal">
                            <i class="fas fa-user-edit mr-1"></i>Edit Data Pasien
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if ($allPengingat->isNotEmpty())
            <!-- Medication Reminder Details Card -->
            <div class="card mb-4" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-clock mr-1"></i> Detail Data Pengingat Obat</h3>
                </div>
                <div class="card-body">
                    @if ($selectedPengingat)
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    @if ($selectedPengingat->updated_at->ne($selectedPengingat->created_at))
                                        Terakhir diupdate: {{ $selectedPengingat->updated_at->format('d M Y, H:i') }} WIB
                                        <br>
                                        <span class="text-muted">(Dibuat: {{ $selectedPengingat->created_at->format('d M Y, H:i') }} WIB)</span>
                                    @else
                                        Dibuat: {{ $selectedPengingat->created_at->format('d M Y, H:i') }} WIB
                                    @endif
                                </small>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <span class="badge badge-primary">
                                    {{ ucfirst($selectedPengingat->status) }}
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</section>



    <!-- Modal Data Tekanan Darah -->
    <div class="modal fade" id="dataModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Data Tekanan Darah - {{ $user->name }}</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataModalTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Sistol</th>
                                    <th>Diastol</th>
                                    <th>Sumber</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="dataModalTableBody">
                                <!-- Data will be loaded here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pasien -->
    <div class="modal fade" id="editPasienModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Edit Data Pasien</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="editPasienForm" action="{{ route('admin.pasienUpdate', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nomor HP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" class="form-control" name="nomor_hp" value="{{ $user->nomor_hp }}" required pattern="[0-9]{8,13}" maxlength="13" minlength="8" placeholder="8xxxxxxxxx">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" required>
                                <option value="Laki-laki" {{ $user->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $user->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Usia</label>
                            <input type="number" class="form-control" name="usia" value="{{ $user->usia }}" min="1" max="120" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Puskesmas</label>
                            <select class="form-control" name="puskesmas" required>
                                <option value="kalasan" {{ $user->puskesmas == 'kalasan' ? 'selected' : '' }}>Kalasan</option>
                                <option value="godean_2" {{ $user->puskesmas == 'godean_2' ? 'selected' : '' }}>Godean 2</option>
                                <option value="umbulharjo" {{ $user->puskesmas == 'umbulharjo' ? 'selected' : '' }}>Umbulharjo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-warning" id="editPasienBtn">
                            <i class="fas fa-save mr-1"></i>Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="tambahObatModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Tambah Obat Baru</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="tambahObatForm" action="{{ route('admin.obat.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pengingat_obat_id" value="{{ $selectedPengingat->id ?? '' }}">
                    <div class="modal-body">
                        <div class="form-group nama-obat-field">
                            <label class="form-label">Nama Obat</label>
                            <select class="form-control" name="nama_obat" id="tambahNamaObat">
                                <option value="">-- Pilih nama obat --</option>
                                @include('admin.partials.drug-options')
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Obat</label>
                            <select class="form-control" name="jumlah_obat" required>
                                <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                                <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                                <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Waktu Minum</label>
                            <select class="form-control" name="waktu_minum" required>
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
                        <div class="form-group suplemen-field">
                            <label class="form-label">Suplemen Tambahan (Opsional)</label>
                            <select class="form-control" name="suplemen" id="tambahSuplemen">
                                <option value="">-- Pilih suplemen jika ada --</option>
                                <option value="Asam folat">Asam Folat</option>
                                <option value="Zat besi">Zat Besi</option>
                                <option value="Kalsium">Kalsium</option>
                                <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Obat</label>
                            <select class="form-control" name="status_obat" required>
                                <option value="aktif">Aktif</option>
                                <option value="habis">Habis</option>
                                <option value="berhenti">Berhenti</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-success" id="tambahObatBtn">
                            <i class="fas fa-save mr-1"></i>Tambah Obat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Obat -->
    <div class="modal fade" id="editObatModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Edit Obat</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="editObatForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group nama-obat-field">
                            <label class="form-label">Nama Obat</label>
                            <select class="form-control" name="nama_obat" id="editNamaObat">
                                <option value="">-- Pilih nama obat --</option>
                                @include('admin.partials.drug-options')
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Obat</label>
                            <select class="form-control" name="jumlah_obat" id="editJumlahObat" required>
                                <option value="30 tablet/bulan">30 tablet (1 bulan)</option>
                                <option value="60 tablet/bulan">60 tablet (2 bulan)</option>
                                <option value="90 tablet/bulan">90 tablet (3 bulan)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Waktu Minum</label>
                            <select class="form-control" name="waktu_minum" id="editWaktuMinum" required>
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
                        <div class="form-group suplemen-field">
                            <label class="form-label">Suplemen Tambahan (Opsional)</label>
                            <select class="form-control" name="suplemen" id="editSuplemen">
                                <option value="">-- Pilih suplemen jika ada --</option>
                                <option value="Asam folat">Asam Folat</option>
                                <option value="Zat besi">Zat Besi</option>
                                <option value="Kalsium">Kalsium</option>
                                <option value="Suplemen Multivitamin">Multivitamin untuk Ibu Hamil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status Obat</label>
                            <select class="form-control" name="status_obat" id="editStatusObat" required>
                                <option value="aktif">Aktif</option>
                                <option value="habis">Habis</option>
                                <option value="berhenti">Berhenti</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-warning" id="editObatBtn">
                            <i class="fas fa-save mr-1"></i>Update Obat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Tekanan Darah -->
    <div class="modal fade" id="tambahTekananDarahModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Tambah Data Tekanan Darah</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="tambahTekananDarahForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tambahTanggal" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Sistol (mmHg)</label>
                                    <input type="number" class="form-control" id="tambahSistol" min="70" max="250" required placeholder="120">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Diastol (mmHg)</label>
                                    <input type="number" class="form-control" id="tambahDiastol" min="40" max="150" required placeholder="80">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-success" id="tambahTekananBtn">
                            <i class="fas fa-save mr-1"></i>Tambah Data
                        </button>
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
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" id="editTanggal" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Sistol (mmHg)</label>
                                <input type="number" class="form-control" id="editSistol" min="70"
                                    max="250" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Diastol (mmHg)</label>
                                <input type="number" class="form-control" id="editDiastol" min="40"
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
            $('#tambahTekananDarahModal').modal('show');
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
                        $('#tambahTekananDarahModal').modal('hide');
                        alert('Data berhasil ditambahkan');
                        loadChartData();
                        // Reset form
                        document.getElementById('tambahTekananDarahForm').reset();
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save mr-1"></i>Tambah Data';
                });
        });

        // Handle edit data form submission
        document.getElementById('editTekananDarahForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('updateTekananBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Menyimpan...';

            const formData = {
                tanggal_input: document.getElementById('editTanggal').value,
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
                        $('#editTekananDarahModal').modal('hide');
                        alert('Data berhasil diupdate');
                        loadChartData();
                    } else {
                        alert('Error: ' + (data.message || 'Terjadi kesalahan'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate data');
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save mr-1"></i>Update Data';
                });
        });

        let currentEditId = null;

        function editTekananDarah(id, tanggal, sistol, diastol) {
            currentEditId = id;
            document.getElementById('editTanggal').value = tanggal;
            document.getElementById('editSistol').value = sistol;
            document.getElementById('editDiastol').value = diastol;
            $('#editTekananDarahModal').modal('show');
        }

        // Validasi input angka untuk sistol dan diastol
        function validateBloodPressure() {
            const sistolInputs = document.querySelectorAll('#tambahSistol, #editSistol');
            const diastolInputs = document.querySelectorAll('#tambahDiastol, #editDiastol');
            
            sistolInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value < 50) this.value = 50;
                    if (this.value > 250) this.value = 250;
                });
            });
            
            diastolInputs.forEach(input => {
                input.addEventListener('blur', function() {
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
            $('#editObatModal').modal('show');
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

        function showDataModal() {
            loadModalTableData();
            $('#dataModal').modal('show');
        }

        function loadModalTableData() {
            const tbody = document.getElementById('dataModalTableBody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center">Loading...</td></tr>';

            if (chartData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center text-muted">Belum ada data tekanan darah</td></tr>';
                return;
            }

            tbody.innerHTML = '';
            chartData.forEach((item, index) => {
                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${new Date(item.tanggal).toLocaleDateString('id-ID')}</td>
                        <td>${item.sistol}</td>
                        <td>${item.diastol}</td>
                        <td>${item.sumber === 'input_harian' ? 'Pasien' : item.sumber === 'admin_input' ? 'Admin' : 'Admin Mengedit'}</td>
                        <td>
                            <button class="btn btn-warning btn-sm me-1" onclick="editTekananDarah(${item.id}, '${item.tanggal}', ${item.sistol}, ${item.diastol})" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteTekananDarah(${item.id})" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        // Function to toggle modal fields - Universal untuk semua pasien
        function toggleModalFields() {
            // Semua field ditampilkan untuk semua pasien
            const namaObatFields = document.querySelectorAll('.nama-obat-field');
            const suplemenFields = document.querySelectorAll('.suplemen-field');
            
            namaObatFields.forEach(field => {
                field.style.display = 'block';
                const select = field.querySelector('select');
                if (select) select.required = true;
            });
            
            suplemenFields.forEach(field => {
                const label = field.querySelector('label');
                const select = field.querySelector('select');
                if (label) label.textContent = 'Suplemen Tambahan (Opsional)';
                if (select) select.required = false;
            });
        }

        // Initialize form state dan notifikasi
        document.addEventListener('DOMContentLoaded', function() {


            // Initialize chart
            console.log('DOM loaded, initializing chart...');
            initChart();
            loadChartData();
            
            // Initialize validasi
            validateBloodPressure();
            
            // Setup modal event listeners
            const tambahObatModal = document.getElementById('tambahObatModal');
            if (tambahObatModal) {
                tambahObatModal.addEventListener('show.bs.modal', function(e) {
                    toggleModalFields();
                });
            }
            
            const editObatModal = document.getElementById('editObatModal');
            if (editObatModal) {
                editObatModal.addEventListener('show.bs.modal', function() {
                    toggleModalFields();
                });
            }

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

        // Confirm stop with backup alert
        function confirmStop() {
            return confirm('PENTING: Unduh riwayat PDF terlebih dahulu sebagai backup!\n\nSetelah dihentikan, pengingat dapat diaktifkan kembali tapi pasien perlu input ulang data pengingat.\n\nLanjutkan menghentikan?');
        }


    </script>
    
    <style>
        .tracking-day {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 6px 4px;
            border-radius: 6px;
            min-width: 45px;
            max-width: 45px;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }
        
        .tracking-day:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
        }
        
        .tracking-day.today {
            background-color: #e3f2fd;
            border: 2px solid #2196f3;
        }
        
        .tracking-day .badge {
            font-size: 14px;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .tracking-day small {
            font-size: 10px;
            font-weight: 600;
            color: #666;
        }
    </style>
@endsection
