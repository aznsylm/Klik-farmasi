@extends('layouts.admin')

@section('title', 'Detail Pasien - ' . $user->name)

@section('additional_css')
    <!-- External CSS for Patient Detail Page -->
    <link rel="stylesheet" href="{{ asset('css/pasien-detail.css') }}">
@endsection

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

            <!-- Toast Container untuk Notifikasi -->
            <div id="toast-container"></div>

            @if (session('success') || session('error') || $errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        @if (session('success'))
                            showToast('success', '{{ session('success') }}');
                        @endif
                        @if (session('error'))
                            showToast('error', '{{ session('error') }}');
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                showToast('error', '{{ $error }}');
                            @endforeach
                        @endif
                    });
                </script>
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
                        $alertIcon = '';

                        $latestPengingat = $user->pengingatObat()->latest()->first();
                        $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', $user->id)
                            ->latest()
                            ->first();
                        $allTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();

                        // 1. Tekanan Darah Kritis (Stage 1/2) - PRIORITAS TERTINGGI
                        if (
                            $latestTekananDarah &&
                            ($latestTekananDarah->sistol >= 140 || $latestTekananDarah->diastol >= 90)
                        ) {
                            $alertMessage = 'Tekanan darah pasien tinggi (Stage 1/2)! Perlu segera dihubungi';
                            $alertClass = 'bg-danger text-white';
                            $alertIcon = 'fas fa-exclamation-triangle';
                        }
                        // 2. Tidak Input >30 Hari - PRIORITAS KEDUA
                        elseif ($latestTekananDarah) {
                            $daysSinceLastInput = (int) \Carbon\Carbon::parse(
                                $latestTekananDarah->created_at,
                            )->diffInDays(now());
                            if ($daysSinceLastInput > 30) {
                                $alertMessage =
                                    'Pasien sudah ' .
                                    $daysSinceLastInput .
                                    ' hari tidak catat tekanan darah. Perlu diingatkan';
                                $alertClass = 'bg-warning text-dark';
                                $alertIcon = 'fas fa-clock';
                            }
                            // 3. Trend Naik Konsisten - PRIORITAS KETIGA (hanya jika tidak ada kondisi di atas)
                            elseif ($allTekananDarah->count() >= 3) {
                                $data = $allTekananDarah->reverse()->values();
                                if ($data[0]->sistol < $data[1]->sistol && $data[1]->sistol < $data[2]->sistol) {
                                    $alertMessage =
                                        'Tekanan darah pasien terus naik dalam 3 catatan terakhir. Perlu perhatian khusus';
                                    $alertClass = 'bg-info text-white';
                                    $alertIcon = 'fas fa-chart-line';
                                }
                            }
                        }
                        // 4. Belum Ada Data - PRIORITAS TERENDAH
                        else {
                            $alertMessage = 'Pasien belum pernah input tekanan darah. Hubungi Pasien ini jika perlu';
                            $alertClass = 'bg-secondary text-white';
                            $alertIcon = 'fas fa-info-circle';
                        }
                    @endphp

                    @if ($alertMessage)
                        <div class="alert {{ $alertClass }} mb-4 fw-semibold" style="border: none; font-size: 14px;">
                            @if ($alertIcon)
                                <i class="{{ $alertIcon }} mr-2"></i>
                            @endif
                            {{ $alertMessage }}
                        </div>
                    @endif

                    <!-- Blood Pressure Chart Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Tekanan Darah</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm mr-1" onclick="showTambahDataModal()"
                                    title="Tambah Data">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm mr-1" onclick="showDataModal()"
                                    title="Lihat Data">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('admin.pasien.tekanan-darah.pdf', $user->id) }}"
                                    class="btn btn-danger btn-sm" title="Download PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="position: relative; height: 350px;" class="chart-container">
                                <canvas id="tekananDarahChart" style="max-width: 100%; height: auto;"></canvas>
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
                            @if ($selectedPengingat)
                                <div class="card-tools">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#tambahObatModal" title="Tambah Obat">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            @if ($selectedPengingat && $selectedPengingat->detailObat->count() > 0)
                                <div class="mb-3 p-2 rounded" style="background: #f8f9fa;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <small class="text-muted">Mulai:
                                                {{ $selectedPengingat->created_at->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                @if (auth()->user()->puskesmas === 'godean_2')
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
                                            @foreach ($selectedPengingat->detailObat as $obat)
                                                <tr>
                                                    @if (auth()->user()->puskesmas === 'godean_2')
                                                        <td>{{ $obat->suplemen ?? '-' }}</td>
                                                        <td>{{ $obat->jumlah_obat }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }}
                                                        </td>
                                                        <td>{{ $obat->nama_obat ?? '-' }}</td>
                                                    @else
                                                        <td>{{ $obat->nama_obat }}</td>
                                                        <td>{{ $obat->jumlah_obat }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }}
                                                        </td>
                                                        <td>{{ $obat->suplemen ?? '-' }}</td>
                                                    @endif
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('admin.obat.update-status') }}"
                                                            style="display: inline;">
                                                            @csrf
                                                            <input type="hidden" name="obat_id"
                                                                value="{{ $obat->id }}">
                                                            <select name="status" class="form-control form-control-sm"
                                                                onchange="this.form.submit()">
                                                                <option value="aktif"
                                                                    {{ $obat->status_obat === 'aktif' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option value="tidak_aktif"
                                                                    {{ $obat->status_obat === 'tidak_aktif' ? 'selected' : '' }}>
                                                                    Tidak Aktif</option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                onclick="editObat({{ $obat->id }}, '{{ $obat->nama_obat }}', '{{ $obat->jumlah_obat }}', '{{ $obat->waktu_minum }}', '{{ $obat->suplemen }}')"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form action="{{ route('admin.obat.delete', $obat->id) }}"
                                                                method="POST" style="display: inline;"
                                                                onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"
                                                                    title="Hapus">
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
                                        @if ($selectedPengingat)
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#tambahObatModal">
                                                <i class="fas fa-plus mr-1"></i>Tambah Obat Pertama
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- WhatsApp Tracking Card -->
                    @if (!empty($trackingData))
                        <div class="card mb-4" id="whatsapp-tracking">
                            <div class="card-header">
                                <h3 class="card-title">Status Pengiriman Pengingat</h3>
                                <div class="card-tools">
                                    <div class="btn-group flex-wrap" role="group">
                                        <a href="{{ route('admin.pasienDetail', ['id' => $user->id, 'period' => 'week']) }}#whatsapp-tracking"
                                            class="btn btn-sm {{ ($period ?? 'week') === 'week' ? 'btn-primary' : 'btn-outline-primary' }}">7
                                            Hari</a>
                                        <a href="{{ route('admin.pasienDetail', ['id' => $user->id, 'period' => 'month']) }}#whatsapp-tracking"
                                            class="btn btn-sm {{ ($period ?? 'week') === 'month' ? 'btn-primary' : 'btn-outline-primary' }}">30
                                            Hari</a>
                                        <a href="{{ route('admin.pasienDetail', ['id' => $user->id, 'period' => 'all']) }}#whatsapp-tracking"
                                            class="btn btn-sm {{ ($period ?? 'week') === 'all' ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($trackingData as $track)
                                    <div class="mb-3 p-3 border rounded">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <strong>{{ $track['display_name'] }}
                                                ({{ \Carbon\Carbon::parse($track['obat']->waktu_minum)->format('H:i') }})
                                            </strong>
                                            @php
                                                $validTrackingDays = collect($track['days'])->filter(
                                                    fn($day) => !in_array($day['status'], ['not_added', 'future']),
                                                );
                                                $hasValidTracking = $validTrackingDays->count() > 0;
                                            @endphp
                                            {{ $track['obat']->status_obat === 'aktif' ? 'Aktif' : 'Habis' }}
                                        </div>
                                        <div class="d-flex gap-1 flex-wrap">
                                            @foreach ($track['days'] as $day)
                                                <div class="tracking-day {{ $day['is_today'] ? 'today' : '' }}"
                                                    style="min-width: 45px; max-width: 45px;" data-bs-toggle="tooltip"
                                                    title="@if (isset($day['total'])) {{ $day['day'] }} - Total: {{ $day['total'] }}, Berhasil: {{ $day['sent'] }}, Gagal: {{ $day['failed'] }}@else{{ \Carbon\Carbon::parse($day['date'])->format('D, d M') }} - {{ $day['status'] === 'not_added' ? 'Obat belum ditambahkan' : ucfirst($day['status'] === 'sent' ? 'Terkirim' : ($day['status'] === 'failed' ? 'Gagal' : 'Belum ada data')) }} @endif">
                                                    @if (isset($day['total']))
                                                        @if ($day['sent'] > $day['failed'])
                                                            <span class="badge bg-success">✓</span>
                                                        @elseif($day['failed'] > 0)
                                                            <span class="badge bg-danger">✗</span>
                                                        @else
                                                            <span class="badge bg-warning text-dark">-</span>
                                                        @endif
                                                    @else
                                                        @if ($day['status'] === 'sent')
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
                                        <form action="/admin/pasien/{{ $user->id }}/reset-password" method="POST"
                                            class="d-flex flex-column flex-sm-row">
                                            @csrf
                                            <div class="input-group mb-2 mb-sm-0" style="max-width: 200px;">
                                                <input type="password" name="new_password" id="resetPassword"
                                                    class="form-control form-control-sm" placeholder="Password baru"
                                                    required>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                                        onclick="togglePassword('resetPassword')">
                                                        <i class="fas fa-eye" id="resetPasswordIcon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-warning btn-sm ml-sm-2">Reset</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="profile-avatar">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle text-white"
                                        style="width: 80px; height: 80px; font-size: 2rem;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary btn-sm w-100 w-sm-auto"
                                        data-toggle="modal" data-target="#editPasienModal">
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
                                                    Terakhir diupdate:
                                                    {{ $selectedPengingat->updated_at->format('d M Y, H:i') }} WIB
                                                    <br>
                                                    <span class="text-muted">(Dibuat:
                                                        {{ $selectedPengingat->created_at->format('d M Y, H:i') }}
                                                        WIB)</span>
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
    @include('components.admin.modal-edit-pasien', [
        'user' => $user,
        'action' => route('admin.pasienUpdate', $user->id),
    ])
    @include('components.admin.modal-tambah-obat', ['pengingatId' => $selectedPengingat->id ?? ''])
    @include('components.admin.modal-edit-obat')
    @include('components.admin.modal-tambah-tekanan-darah')
    @include('components.admin.modal-edit-tekanan-darah')
    @include('components.admin.modal-scripts')

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- External JavaScript for Patient Detail Page -->
    <script>
        // Set current user ID for validation - must be inline due to PHP variable
        window.currentUserId = {{ $user->id }};
    </script>
    <script src="{{ asset('js/pasien-detail.js') }}"></script>
@endsection
