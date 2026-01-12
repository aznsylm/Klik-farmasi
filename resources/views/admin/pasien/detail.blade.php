@extends('layouts.admin')

@section('title', 'Detail Pasien - ' . $user->name)

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 col-sm-6">
                <h1>Detail Pasien</h1>
                <p class="text-muted mb-0">{{ $user->name }}</p>
            </div>
            <div class="col-12 col-sm-6">
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
                <a href="{{ route('admin.pasien') }}" class="btn btn-secondary w-100 w-sm-auto">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Patient Profile Card -->
        <div class="card">
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
                        $alertMessage = 'Pasien belum pernah input tekanan darah. Hubungi Pasien ini jika perlu';
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
                <h3 class="card-title">Grafik Tekanan Darah</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-sm mr-1" onclick="showTambahDataModal()" title="Tambah Data">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-primary btn-sm mr-1" onclick="showDataModal()" title="Lihat Data">
                        <i class="fas fa-eye"></i>
                    </button>
                    <a href="{{ route('admin.pasien.tekanan-darah.pdf', $user->id) }}" class="btn btn-danger btn-sm" title="Download PDF">
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
                <h3 class="card-title">Data Obat</h3>
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
                        <div class="mb-3 p-2 rounded" style="background: #f8f9fa;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Mulai: {{ $selectedPengingat->created_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        @if(auth()->user()->puskesmas === 'godean_2')
                                            <th>Suplemen</th>
                                            <th>Jumlah</th>
                                            <th>Waktu</th>
                                            <th>Obat</th>
                                        @else
                                            <th>Obat</th>
                                            <th>Jumlah</th>
                                            <th>Waktu</th>
                                            <th>Suplemen</th>
                                        @endif
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($selectedPengingat->detailObat as $obat)
                                    <tr>
                                        @if(auth()->user()->puskesmas === 'godean_2')
                                            <td>{{ $obat->suplemen ?? '-' }}</td>
                                            <td>{{ $obat->jumlah_obat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }}</td>
                                            <td>{{ $obat->nama_obat ?? '-' }}</td>
                                        @else
                                            <td>{{ $obat->nama_obat }}</td>
                                            <td>{{ $obat->jumlah_obat }}</td>
                                            <td>{{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }}</td>
                                            <td>{{ $obat->suplemen ?? '-' }}</td>
                                        @endif
                                        <td>
                                            <form method="POST" action="{{ route('admin.obat.update-status') }}" style="display: inline;">
                                                @csrf
                                                <input type="hidden" name="obat_id" value="{{ $obat->id }}">
                                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    <option value="aktif" {{ $obat->status_obat === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="habis" {{ $obat->status_obat === 'habis' ? 'selected' : '' }}>Habis</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning btn-sm" onclick="editObat({{ $obat->id }}, '{{ $obat->nama_obat }}', '{{ $obat->jumlah_obat }}', '{{ $obat->waktu_minum }}', '{{ $obat->suplemen }}')" title="Edit">
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
                <h3 class="card-title">Status Pengiriman Pengingat</h3>
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
                            <strong>{{ $track['display_name'] }} ({{ \Carbon\Carbon::parse($track['obat']->waktu_minum)->format('H:i') }})</strong>
                            @php
                                $validTrackingDays = collect($track['days'])->filter(fn($day) => !in_array($day['status'], ['not_added', 'future']));
                                $hasValidTracking = $validTrackingDays->count() > 0;
                            @endphp
                            {{ $track['obat']->status_obat === 'aktif' ? 'Aktif' : 'Habis' }}
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
                <h3 class="card-title">Profil Pasien</h3>
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
                                <div class="input-group" style="max-width: 200px;">
                                    <input type="password" name="new_password" id="resetPassword" class="form-control form-control-sm" placeholder="Password baru" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="togglePassword('resetPassword')">
                                            <i class="fas fa-eye" id="resetPasswordIcon"></i>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning btn-sm ml-2">Reset</button>
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

@include('components.admin.modal-data-tekanan-darah')
@include('components.admin.modal-edit-pasien', ['user' => $user, 'action' => route('admin.pasienUpdate', $user->id)])
@include('components.admin.modal-tambah-obat', ['pengingatId' => $selectedPengingat->id ?? ''])
@include('components.admin.modal-edit-obat')
@include('components.admin.modal-tambah-tekanan-darah')
@include('components.admin.modal-edit-tekanan-darah')
@include('components.admin.modal-scripts')

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Set current user ID for validation
window.currentUserId = {{ $user->id }};

// Indonesian validation messages
const validationMessages = {
    sistol: {
        required: 'Sistol harus diisi',
        min: 'Sistol minimal 70 mmHg',
        max: 'Sistol maksimal 250 mmHg',
        invalid: 'Sistol harus berupa angka'
    },
    diastol: {
        required: 'Diastol harus diisi',
        min: 'Diastol minimal 40 mmHg', 
        max: 'Diastol maksimal 150 mmHg',
        invalid: 'Diastol harus berupa angka'
    }
};

// Load existing dates
function loadExistingDates() {
    const userId = {{ $user->id }};
    fetch(`/admin/pasien/${userId}/tekanan-darah/dates`)
        .then(response => response.json())
        .then(data => {
            existingDates = data.dates || [];
        })
        .catch(error => console.error('Error loading dates:', error));
}

// Validation function
function validateTekananDarah(sistol, diastol, tanggal) {
    let isValid = true;
    
    // Reset previous errors
    document.getElementById('tambahSistol').classList.remove('is-invalid');
    document.getElementById('tambahDiastol').classList.remove('is-invalid');
    document.getElementById('tambahTanggal').classList.remove('is-invalid');
    document.getElementById('tambahSistolError').textContent = '';
    document.getElementById('tambahDiastolError').textContent = '';
    document.getElementById('tambahTanggalError').textContent = '';
    
    // Validate tanggal for duplicates
    if (tanggal && existingDates.includes(tanggal)) {
        document.getElementById('tambahTanggal').classList.add('is-invalid');
        document.getElementById('tambahTanggalError').textContent = 'Tanggal ini sudah ada data tekanan darah';
        isValid = false;
    }
    
    // Validate sistol
    if (!sistol) {
        document.getElementById('tambahSistol').classList.add('is-invalid');
        document.getElementById('tambahSistolError').textContent = validationMessages.sistol.required;
        isValid = false;
    } else if (isNaN(sistol)) {
        document.getElementById('tambahSistol').classList.add('is-invalid');
        document.getElementById('tambahSistolError').textContent = validationMessages.sistol.invalid;
        isValid = false;
    } else if (sistol < 70) {
        document.getElementById('tambahSistol').classList.add('is-invalid');
        document.getElementById('tambahSistolError').textContent = validationMessages.sistol.min;
        isValid = false;
    } else if (sistol > 250) {
        document.getElementById('tambahSistol').classList.add('is-invalid');
        document.getElementById('tambahSistolError').textContent = validationMessages.sistol.max;
        isValid = false;
    }
    
    // Validate diastol
    if (!diastol) {
        document.getElementById('tambahDiastol').classList.add('is-invalid');
        document.getElementById('tambahDiastolError').textContent = validationMessages.diastol.required;
        isValid = false;
    } else if (isNaN(diastol)) {
        document.getElementById('tambahDiastol').classList.add('is-invalid');
        document.getElementById('tambahDiastolError').textContent = validationMessages.diastol.invalid;
        isValid = false;
    } else if (diastol < 40) {
        document.getElementById('tambahDiastol').classList.add('is-invalid');
        document.getElementById('tambahDiastolError').textContent = validationMessages.diastol.min;
        isValid = false;
    } else if (diastol > 150) {
        document.getElementById('tambahDiastol').classList.add('is-invalid');
        document.getElementById('tambahDiastolError').textContent = validationMessages.diastol.max;
        isValid = false;
    }
    
    return isValid;
}

// Validation function for edit modal
function validateEditTekananDarah(sistol, diastol, tanggal) {
    let isValid = true;
    
    // Reset previous errors
    document.getElementById('editSistol').classList.remove('is-invalid');
    document.getElementById('editDiastol').classList.remove('is-invalid');
    document.getElementById('editTanggal').classList.remove('is-invalid');
    document.getElementById('editSistolError').textContent = '';
    document.getElementById('editDiastolError').textContent = '';
    document.getElementById('editTanggalError').textContent = '';
    
    // Validate tanggal for duplicates (exclude original date)
    if (tanggal && tanggal !== originalEditDate && existingDates.includes(tanggal)) {
        document.getElementById('editTanggal').classList.add('is-invalid');
        document.getElementById('editTanggalError').textContent = 'Tanggal ini sudah ada data tekanan darah';
        isValid = false;
    }
    
    // Validate sistol
    if (!sistol) {
        document.getElementById('editSistol').classList.add('is-invalid');
        document.getElementById('editSistolError').textContent = validationMessages.sistol.required;
        isValid = false;
    } else if (isNaN(sistol)) {
        document.getElementById('editSistol').classList.add('is-invalid');
        document.getElementById('editSistolError').textContent = validationMessages.sistol.invalid;
        isValid = false;
    } else if (sistol < 70) {
        document.getElementById('editSistol').classList.add('is-invalid');
        document.getElementById('editSistolError').textContent = validationMessages.sistol.min;
        isValid = false;
    } else if (sistol > 250) {
        document.getElementById('editSistol').classList.add('is-invalid');
        document.getElementById('editSistolError').textContent = validationMessages.sistol.max;
        isValid = false;
    }
    
    // Validate diastol
    if (!diastol) {
        document.getElementById('editDiastol').classList.add('is-invalid');
        document.getElementById('editDiastolError').textContent = validationMessages.diastol.required;
        isValid = false;
    } else if (isNaN(diastol)) {
        document.getElementById('editDiastol').classList.add('is-invalid');
        document.getElementById('editDiastolError').textContent = validationMessages.diastol.invalid;
        isValid = false;
    } else if (diastol < 40) {
        document.getElementById('editDiastol').classList.add('is-invalid');
        document.getElementById('editDiastolError').textContent = validationMessages.diastol.min;
        isValid = false;
    } else if (diastol > 150) {
        document.getElementById('editDiastol').classList.add('is-invalid');
        document.getElementById('editDiastolError').textContent = validationMessages.diastol.max;
        isValid = false;
    }
    
    return isValid;
}

let currentEditId = null;
let currentPage = 1;
let existingDates = [];
let originalEditDate = null;

// Show data modal with pagination
function showDataModal() {
    loadModalData(1);
    $('#dataModal').modal('show');
}

// Load modal data with pagination
function loadModalData(page = 1) {
    currentPage = page;
    const userId = {{ $user->id }};
    
    // Use the correct API endpoint
    fetch(`/admin/pasien/${userId}/tekanan-darah/records?page=${page}`)
        .then(response => response.json())
        .then(records => {
            const tbody = document.getElementById('dataModalTableBody');
            const pagination = document.getElementById('modalPagination');
            
            // Clear existing data
            tbody.innerHTML = '';
            
            if (records && records.data && records.data.length > 0) {
                records.data.forEach((record, index) => {
                    const startIndex = (records.current_page - 1) * records.per_page;
                    const category = getBloodPressureCategory(record.sistol, record.diastol);
                    
                    tbody.innerHTML += `
                        <tr>
                            <td>${startIndex + index + 1}</td>
                            <td>${formatDate(record.created_at)}</td>
                            <td>${record.sistol}</td>
                            <td>${record.diastol}</td>
                            <td><span class="${category.text}">${category.text}</span></td>
                            <td>
                                <button class="btn btn-warning btn-sm mr-1" onclick="editTekananDarah(${record.id}, '${record.created_at.split('T')[0]}', ${record.sistol}, ${record.diastol})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTekananDarah(${record.id})" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                
                // Generate pagination
                pagination.innerHTML = generatePagination(records);
            } else {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4"><i class="fas fa-chart-line fa-3x text-muted mb-3"></i><p class="text-muted">Belum ada data tekanan darah</p></td></tr>';
                pagination.innerHTML = '';
            }
        })
        .catch(error => {
            console.error('Error loading records:', error);
            document.getElementById('dataModalTableBody').innerHTML = '<tr><td colspan="6" class="text-center py-4"><i class="fas fa-chart-line fa-3x text-muted mb-3"></i><p class="text-muted">Error loading data</p></td></tr>';
        });
}

// Generate pagination HTML
function generatePagination(data) {
    if (data.last_page <= 1) return '';
    
    let html = '<nav><ul class="pagination pagination-sm">';
    
    // Previous button
    if (data.current_page > 1) {
        html += `<li class="page-item"><a class="page-link" href="#" onclick="loadModalData(${data.current_page - 1})">‹</a></li>`;
    }
    
    // Page numbers
    const start = Math.max(1, data.current_page - 2);
    const end = Math.min(data.last_page, data.current_page + 2);
    
    for (let i = start; i <= end; i++) {
        const active = i === data.current_page ? 'active' : '';
        html += `<li class="page-item ${active}"><a class="page-link" href="#" onclick="loadModalData(${i})">${i}</a></li>`;
    }
    
    // Next button
    if (data.current_page < data.last_page) {
        html += `<li class="page-item"><a class="page-link" href="#" onclick="loadModalData(${data.current_page + 1})">›</a></li>`;
    }
    
    html += '</ul></nav>';
    return html;
}

// Get blood pressure category
function getBloodPressureCategory(sistol, diastol) {
    if (sistol < 120 && diastol < 80) {
        return { text: 'NORMAL', color: 'text-success' };
    } else if (sistol >= 120 && sistol <= 129 && diastol < 80) {
        return { text: 'PRE HIPERTENSI', color: 'text-info' };
    } else if ((sistol >= 130 && sistol <= 139) || (diastol >= 80 && diastol <= 89)) {
        return { text: 'HIPERTENSI STAGE 1', color: 'text-warning' };
    } else {
        return { text: 'HIPERTENSI STAGE 2', color: 'text-danger' };
    }
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Show tambah data modal
function showTambahDataModal() {
    loadExistingDates();
    document.getElementById('tambahTanggal').value = new Date().toISOString().split('T')[0];
    $('#tambahTekananDarahModal').modal('show');
}

// Edit tekanan darah
function editTekananDarah(id, tanggal, sistol, diastol) {
    currentEditId = id;
    originalEditDate = tanggal;
    loadExistingDates();
    document.getElementById('editTanggal').value = tanggal;
    document.getElementById('editSistol').value = sistol;
    document.getElementById('editDiastol').value = diastol;
    $('#editTekananDarahModal').modal('show');
}

// Delete tekanan darah
function deleteTekananDarah(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(`/admin/tekanan-darah/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadModalData(currentPage);
                loadChart();
            } else {
                alert('Gagal menghapus data');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        });
    }
}

// Handle tambah form submit
document.getElementById('tambahTekananDarahForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const sistol = parseInt(document.getElementById('tambahSistol').value);
    const diastol = parseInt(document.getElementById('tambahDiastol').value);
    const tanggal = document.getElementById('tambahTanggal').value;
    
    if (!tanggal) {
        alert('Tanggal harus diisi');
        return;
    }
    
    if (!validateTekananDarah(sistol, diastol, tanggal)) {
        return;
    }
    
    const formData = {
        user_id: {{ $user->id }},
        tanggal_input: tanggal,
        sistol: sistol,
        diastol: diastol
    };
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch('/admin/tekanan-darah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#tambahTekananDarahModal').modal('hide');
            loadModalData(currentPage);
            loadChart();
            this.reset();
        } else {
            alert(data.message || 'Gagal menyimpan data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
});

// Handle edit form submit
document.getElementById('editTekananDarahForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const sistol = parseInt(document.getElementById('editSistol').value);
    const diastol = parseInt(document.getElementById('editDiastol').value);
    const tanggal = document.getElementById('editTanggal').value;
    
    if (!tanggal) {
        alert('Tanggal harus diisi');
        return;
    }
    
    if (!validateEditTekananDarah(sistol, diastol, tanggal)) {
        return;
    }
    
    const formData = {
        tanggal_input: tanggal,
        sistol: sistol,
        diastol: diastol
    };
    
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/admin/tekanan-darah/${currentEditId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            $('#editTekananDarahModal').modal('hide');
            loadModalData(currentPage);
            loadChart();
        } else {
            alert(data.message || 'Gagal mengupdate data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
});

// Load chart function
function loadChart() {
    const userId = {{ $user->id }};
    const ctx = document.getElementById('tekananDarahChart');
    
    if (!ctx) {
        console.error('Canvas element not found!');
        return;
    }
    
    fetch(`/admin/pasien/${userId}/tekanan-darah/chart`)
        .then(response => response.json())
        .then(data => {
            if (window.tekananDarahChart && typeof window.tekananDarahChart.destroy === 'function') {
                window.tekananDarahChart.destroy();
            }
            
            if (data.labels && data.labels.length > 0) {
                window.tekananDarahChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Sistol',
                            data: data.sistol,
                            borderColor: '#dc3545',
                            backgroundColor: 'rgba(220, 53, 69, 0.1)',
                            tension: 0.4
                        }, {
                            label: 'Diastol',
                            data: data.diastol,
                            borderColor: '#0b5e91',
                            backgroundColor: 'rgba(11, 94, 145, 0.1)',
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 60,
                                max: 200
                            }
                        },
                        plugins: {
                            legend: {
                                position: 'top'
                            }
                        }
                    }
                });
                
                document.getElementById('chartPlaceholder').style.display = 'none';
            } else {
                document.getElementById('chartPlaceholder').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error loading chart:', error);
            document.getElementById('chartPlaceholder').style.display = 'block';
        });
}

// Password toggle function (specific to detail page)
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(inputId + 'Icon');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Load chart on page load
document.addEventListener('DOMContentLoaded', function() {
    loadChart();
    
    // Disable default browser validation for both forms
    const tambahForm = document.getElementById('tambahTekananDarahForm');
    const editForm = document.getElementById('editTekananDarahForm');
    
    if (tambahForm) {
        tambahForm.setAttribute('novalidate', 'novalidate');
    }
    if (editForm) {
        editForm.setAttribute('novalidate', 'novalidate');
    }
});
</script>
@endsection
