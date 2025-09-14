@extends('layouts.app')

@section('title', 'Dashboard Pasien')

@section('content')
    <style>
        .bg-primary-solid {
            background-color: #0b5e91 !important;
        }

        .bg-gold-solid {
            background-color: #baa971 !important;
        }

        .text-primary-custom {
            color: #0b5e91 !important;
        }

        .text-gold-custom {
            color: #baa971 !important;
        }

        .bg-primary-soft {
            background-color: rgba(11, 94, 145, 0.1);
        }

        .bg-gold-soft {
            background-color: rgba(186, 169, 113, 0.1);
        }

        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        body {
            font-size: 16px !important;
            line-height: 1.6;
        }

        .card {
            border-radius: 15px;
            transition: transform 0.2s ease;
            border: 2px solid #e9ecef;
        }

        .card:hover {
            transform: translateY(-2px);
            border-color: #0b5e91;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .data-card {
            background: #f8f9fa;
            border-left: 5px solid #0b5e91;
            padding: 1.5rem;
        }

        .display-number {
            font-size: 1.8rem !important;
            font-weight: 600 !important;
            color: #0b5e91;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
        }

        .admin-contact {
            background: #0b5e91;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
        }

        .catatan-sidebar {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1050;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .catatan-sidebar.active {
            right: 0;
        }

        .catatan-header {
            background: #0b5e91;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-close-sidebar {
            background: none;
            border: none;
            padding: 0.5rem;
        }

        .catatan-content {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .catatan-item {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid #0b5e91;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .catatan-item:hover {
            background: #e9ecef;
            transform: translateX(-2px);
        }

        .catatan-item.belum-dibaca {
            border-left-color: #dc3545;
            background: #fff5f5;
        }

        .floating-catatan-btn {
            position: fixed;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            width: 50px;
            height: 80px;
            background: #0b5e91;
            border-radius: 10px 0 0 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            box-shadow: -3px 0 10px rgba(11, 94, 145, 0.3);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .floating-catatan-btn:hover {
            transform: translateY(-50%) translateX(-5px);
            box-shadow: -5px 0 15px rgba(11, 94, 145, 0.4);
        }

        .badge-notif {
            position: absolute;
            top: -8px;
            left: -8px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .pesan-popup {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            padding: 20px;
        }

        .pesan-popup.active {
            opacity: 1;
            visibility: visible;
        }

        .pesan-content {
            background: white;
            border-radius: 15px;
            padding: 2.5rem;
            max-width: 600px;
            width: 100%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .pesan-popup.active .pesan-content {
            transform: scale(1);
        }

        .pesan-text {
            font-size: 20px;
            line-height: 1.8;
            color: #333;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .pesan-info {
            border-top: 2px solid #f0f0f0;
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            color: #666;
        }

        .pesan-close {
            background: #0b5e91;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .pesan-close:hover {
            background: #094a73;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 0.5rem;
            }

            .card-body {
                padding: 0.75rem;
            }

            .card-body.p-5 {
                padding: 1.5rem !important;
            }

            .display-number {
                font-size: 1.4rem !important;
            }

            .icon-circle {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }

            h1 {
                font-size: 1.8rem !important;
            }

            .fs-5 {
                font-size: 1rem !important;
            }

            .table-responsive {
                font-size: 0.85rem;
            }

            .table th, .table td {
                padding: 0.5rem 0.25rem;
            }

            .chart-container {
                height: 250px;
                margin-bottom: 1rem;
            }

            .catatan-sidebar {
                width: 100%;
                right: -100%;
            }

            .floating-catatan-btn {
                width: 45px;
                height: 70px;
                font-size: 1.1rem;
                right: 10px;
            }

            .pesan-content {
                padding: 1.5rem;
                margin: 10px;
                max-height: 90vh;
            }

            .pesan-text {
                font-size: 18px;
                line-height: 1.6;
            }

            .pesan-info {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .input-group .form-control {
                min-width: 0;
            }

            .admin-contact {
                padding: 0.75rem;
                font-size: 0.9rem;
            }

            .bg-primary-soft, .bg-gold-soft {
                padding: 0.75rem !important;
            }

            .btn, .form-control, .catatan-item {
                min-height: 44px;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 0.25rem;
            }

            .card-body {
                padding: 0.5rem;
            }

            .card-body.p-5 {
                padding: 1rem !important;
            }

            .display-number {
                font-size: 1.2rem !important;
            }

            h1 {
                font-size: 1.5rem !important;
            }

            .table-responsive {
                font-size: 0.75rem;
            }

            .table th, .table td {
                padding: 0.25rem;
            }

            .chart-container {
                height: 200px;
            }

            .pesan-content {
                padding: 1rem;
                margin: 5px;
            }

            .pesan-text {
                font-size: 16px;
            }

            .floating-catatan-btn {
                right: 5px;
                width: 40px;
                height: 60px;
                font-size: 1rem;
            }

            .row .col-md-8, .row .col-md-4 {
                margin-bottom: 1rem;
            }

            .btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            .form-control {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            .status-badge {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 768px) and (orientation: landscape) {
            .chart-container {
                height: 180px;
            }

            .card-body.p-5 {
                padding: 1rem !important;
            }
        }
    </style>

    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="border-radius: 25px; overflow: hidden;">
                    <div class="card-body p-5 bg-primary-solid text-white"
                        style="background: linear-gradient(135deg, #0b5e91 0%, #1a7bb8 50%, #0b5e91 100%);">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h1 class="mb-3 fw-bold text-white" style="font-size: 2.2rem;">Selamat datang,
                                        {{ Auth::user()->name }}!</h1>
                                    <p class="mb-2 fs-5 text-white opacity-90">Pantau kesehatan Anda hari ini dan jaga
                                        tekanan darah tetap terkontrol</p>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="d-flex justify-content-end align-items-center flex-column flex-md-row">
                                    <div class="me-md-3 mb-3 mb-md-0 text-center text-md-end">
                                        <div>
                                            <h6 class="mb-2 text-white fw-bold">Status Akun</h6>
                                            <span class="status-badge bg-success text-white shadow-sm">✓ Aktif</span>
                                        </div>
                                    </div>
                                    <div class="icon-circle bg-gold-solid shadow-lg">
                                        <i class="bi bi-person-check text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Cards -->
        <div class="row mb-4">
            <!-- Tekanan Darah Card -->
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <h6 class="text-muted mb-2 fw-bold">Tekanan Darah Terakhir</h6>
                        <div class="display-number mb-2">
                            @php
                                // Show blood pressure data for any pengingat
                                $latestTekananDarah = null;
                                if ($latestPengingat) {
                                    $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', $user->id)
                                        ->latest()
                                        ->first();
                                }

                                if ($latestTekananDarah) {
                                    $sistol = $latestTekananDarah->sistol;
                                    $diastol = $latestTekananDarah->diastol;
                                    echo "$sistol/$diastol mmHg";
                                } else {
                                    echo 'Belum ada';
                                }
                            @endphp
                        </div>
                        <span class="status-badge bg-gold-solid text-white">
                            @php
                                if ($latestTekananDarah) {
                                    $sistol = $latestTekananDarah->sistol;
                                    $diastol = $latestTekananDarah->diastol;
                                    if ($sistol < 90 || $diastol < 60) {
                                        echo 'Hipotensi';
                                    } elseif ($sistol <= 120 && $diastol < 80) {
                                        echo 'Normal';
                                    } elseif (
                                        ($sistol >= 121 && $sistol <= 139) ||
                                        ($diastol >= 80 && $diastol <= 90)
                                    ) {
                                        echo 'Pre Hipertensi';
                                    } else {
                                        echo 'Hipertensi';
                                    }
                                } else {
                                    echo 'Belum diukur';
                                }
                            @endphp
                        </span>
                    </div>
                </div>
            </div>

            <!-- Total Obat -->
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <h6 class="text-muted mb-2 fw-bold">Total Jenis Obat</h6>
                        @php
                            $totalObat = $latestPengingat ? $latestPengingat->detailObat->count() : 0;
                        @endphp
                        <div class="display-number mb-2">{{ $totalObat }}</div>
                        <span class="status-badge bg-gold-solid text-white">Jenis obat berbeda</span>
                    </div>
                </div>
            </div>

            <!-- Status Pengingat -->
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <h6 class="text-muted mb-2 fw-bold">Status Pengingat</h6>
                        <div class="display-number mb-2">
                            {{ $latestPengingat ? ucfirst($latestPengingat->status) : 'Belum Ada' }}</div>
                        <span
                            class="status-badge {{ $latestPengingat ? ($latestPengingat->status == 'aktif' ? 'bg-gold-solid' : 'bg-secondary') : 'bg-secondary' }} text-white">
                            {{ $latestPengingat ? ($latestPengingat->status == 'aktif' ? 'Pengingat berjalan' : 'Pengobatan dihentikan') : 'Belum ada pengingat' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Diagnosa Card -->
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-3 text-center">
                        <h6 class="text-muted mb-2 fw-bold">Diagnosa</h6>
                        <div class="display-number mb-2" style="font-size: 1.5rem !important;">
                            {{ $latestPengingat ? str_replace('-', ' ', $latestPengingat->diagnosa) : 'Belum ada' }}
                        </div>
                        <span class="status-badge bg-gold-solid text-white">
                            Saat ini
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">

                <!-- Data Pengingat Obat -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary-custom">
                            Data Pengingat Obat
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($latestPengingat)
                            <div class="p-3 data-card rounded">
                                <!-- Header Pengingat -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h6 class="mb-1 fw-bold text-primary">
                                            Pengingat Obat Aktif
                                        </h6>
                                        <small class="text-muted">
                                            @if ($latestPengingat->updated_at->ne($latestPengingat->created_at))
                                                Terakhir diupdate: {{ $latestPengingat->updated_at->format('d M Y, H:i') }}
                                                WIB
                                                <br>
                                                <span class="text-muted">(Dibuat:
                                                    {{ $latestPengingat->created_at->format('d M Y, H:i') }} WIB)</span>
                                            @else
                                                Dibuat: {{ $latestPengingat->created_at->format('d M Y, H:i') }} WIB
                                            @endif
                                        </small>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <span
                                            class="badge bg-{{ $latestPengingat->status == 'aktif' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($latestPengingat->status) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Daftar Obat -->
                                <div class="mb-3">
                                    <h6 class="mb-3 fw-bold">
                                        Daftar Obat ({{ $latestPengingat->detailObat->count() }} jenis)
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($latestPengingat->detailObat as $key => $obat)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td class="fw-medium">{{ $obat->nama_obat }}</td>
                                                        <td>
                                                            {{ $obat->jumlah_obat }}
                                                        </td>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($obat->waktu_minum)->format('H:i') }}
                                                            WIB
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
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Keterangan Admin -->
                                    <div class="admin-contact text-center">
                                        <h6 class="text-white mb-2">
                                            Informasi Penting
                                        </h6>
                                        <p class="mb-0 text-white">
                                            <strong>Untuk mengubah data obat, silakan hubungi:</strong><br>
                                            Admin Klik Farmasi: <strong>+62 852-8090-9235</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info text-center p-4">
                                <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                                <h5 class="mt-2">Belum ada data pengingat obat</h5>
                                <p class="mb-3 text-center">Mulai perjalanan kesehatan Anda dengan membuat pengingat obat
                                    pertama, Pengingat ini akan aktif selama 91 hari (13 minggu)</p>
                                <a href="{{ route('pengingat') }}" class="btn btn-primary btn-lg">
                                    Buat Pengingat
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Grafik Tekanan Darah -->
                @if ($latestPengingat)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 py-3">
                            <h5 class="mb-0 fw-bold text-primary-custom">
                                <i class="bi bi-graph-up me-2"></i>
                                Grafik Tekanan Darah
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="chart-container">
                                        <canvas id="tekananDarahChart" width="400" height="300"></canvas>
                                        <div id="chartPlaceholder" class="text-center py-5" style="display: none;">
                                            <i class="bi bi-graph-up text-muted" style="font-size: 3rem;"></i>
                                            <p class="text-muted mt-3">Belum ada data untuk ditampilkan</p>
                                            <small class="text-muted">Grafik akan muncul setelah ada input tekanan
                                                darah</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-light p-3 rounded">
                                        <h6 class="text-primary-custom mb-3">Input Tekanan Darah</h6>
                                        @php
                                            try {
                                                $tanggalMulai = \Carbon\Carbon::parse(
                                                    $latestPengingat->tanggal_mulai ?? $latestPengingat->created_at,
                                                )->startOfDay();
                                                $now = \Carbon\Carbon::now('Asia/Jakarta')->startOfDay();
                                                $daysDiff = $tanggalMulai->diffInDays($now);
                                                $currentWeek = min(floor($daysDiff / 7) + 1, 13);
                                                $isOver91Days = $daysDiff >= 91;
                                                $canInput = $latestPengingat->status == 'aktif' && !$isOver91Days;
                                                
                                                if ($canInput) {
                                                    $weekStart = $tanggalMulai->copy()->addWeeks($currentWeek - 1);
                                                    $weekEnd = $weekStart->copy()->addDays(6);
                                                    $hasInputThisWeek = \App\Models\CatatanTekananDarah::where(
                                                        'user_id',
                                                        auth()->id(),
                                                    )
                                                        ->whereBetween('tanggal_input', [
                                                            $weekStart->toDateString(),
                                                            $weekEnd->toDateString(),
                                                        ])
                                                        ->where('sumber', 'input_harian')
                                                        ->exists();
                                                } else {
                                                    $weekStart = $weekEnd = $hasInputThisWeek = null;
                                                }
                                            } catch (Exception $e) {
                                                $canInput = false;
                                                $currentWeek = 1;
                                                $isOver91Days = true;
                                                $weekStart = $weekEnd = $hasInputThisWeek = null;
                                            }
                                        @endphp

                                        @if ($canInput)
                                            <div class="mb-3 p-2 rounded" style="background: rgba(11, 94, 145, 0.1);">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="fw-bold text-primary-custom">Minggu
                                                        ke-{{ $currentWeek }}/13</small>
                                                    @if ($hasInputThisWeek)
                                                        <span class="badge bg-success">Sudah input</span>
                                                    @else
                                                        <span class="badge bg-warning">Belum input</span>
                                                    @endif
                                                </div>
                                                <small class="text-muted">{{ $weekStart->format('d M') }} -
                                                    {{ $weekEnd->format('d M Y') }}</small>
                                            </div>
                                            <form id="inputTekananDarahForm">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Sistol/Diastol</label>
                                                    <div class="input-group">
                                                        <input type="number" class="form-control" id="sistolInput"
                                                            placeholder="140" min="50" max="250" required>
                                                        <span class="input-group-text">/</span>
                                                        <input type="number" class="form-control" id="diastolInput"
                                                            placeholder="90" min="50" max="150" required>
                                                    </div>
                                                    <small class="text-muted">mmHg</small>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100"
                                                    id="simpanTekananBtn">
                                                    Simpan
                                                </button>
                                            </form>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                                                <p class="text-muted mt-2 mb-1 text-center">
                                                    @if ($latestPengingat->status == 'aktif' && $isOver91Days)
                                                        Masa pengingat telah berakhir (91 hari / 13 minggu)
                                                    @else
                                                        Pengobatan telah selesai
                                                    @endif
                                                </p>
                                                <small class="text-muted">Tidak perlu input tekanan darah lagi</small>
                                                @if ($latestPengingat->status == 'aktif' && $isOver91Days)
                                                    <br><small class="text-muted">Berakhir:
                                                        {{ $tanggalMulai->copy()->addDays(91)->format('d M Y') }}</small>
                                                @else
                                                    <br><small class="text-muted">Dihentikan:
                                                        {{ $latestPengingat->updated_at->format('d M Y, H:i') }}</small>
                                                @endif
                                                <div class="mt-3">
                                                    <a href="{{ route('user.tekanan-darah.pdf') }}"
                                                        class="btn btn-success btn-sm">
                                                        Download Laporan PDF
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Catatan Keluhan/Pengobatan -->
                            <div class="mt-4 p-3 bg-light rounded">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="text-primary-custom mb-0">
                                        Catatan Keluhan/Pengobatan
                                    </h6>
                                    <div>
                                        @if ($latestPengingat->catatan)
                                            <button class="btn btn-warning btn-sm me-2" onclick="editCatatan()">
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm me-2" onclick="hapusCatatan()">
                                                Hapus
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-primary" onclick="tambahCatatan()">
                                                Tambah Catatan
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div id="catatanDisplay">
                                    @if ($latestPengingat->catatan)
                                        <p class="mb-0 text-muted">{{ $latestPengingat->catatan }}</p>
                                    @else
                                        <p class="mb-0 text-muted fst-italic">Belum ada catatan keluhan atau pengobatan</p>
                                    @endif
                                </div>

                                <div id="catatanForm" style="display: none;">
                                    <textarea class="form-control mb-2" id="catatanTextarea" rows="3"
                                        placeholder="Tulis catatan keluhan atau pengobatan Anda...">{{ $latestPengingat->catatan }}</textarea>
                                    <div class="text-end">
                                        <button class="btn btn-sm btn-secondary me-2"
                                            onclick="batalCatatan()">Batal</button>
                                        <button class="btn btn-sm btn-primary" onclick="simpanCatatan()">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Data Pasien -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0 fw-bold text-primary-custom">
                            Profil Pasien
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <span class="text-dark fw-bold">
                                        Nama :
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->name }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <span class="text-dark fw-bold">
                                        Usia :
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->usia }} tahun</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <span class="text-dark fw-bold">
                                        Jenis Kelamin :
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->jenis_kelamin }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <span class="text-dark fw-bold">
                                        WhatsApp :
                                    </span>
                                    <span class="fw-bold text-dark">+{{ $user->nomor_hp }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <span class="text-dark fw-bold">
                                        Email :
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->email }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3">
                                    <span class="text-dark fw-bold">
                                        Dibuat pada :
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                                    <span class="text-dark fw-bold">
                                        Puskesmas :
                                    </span>
                                    <span class="fw-bold text-dark">{{ $user->puskesmas_id }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Kesehatan -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0 fw-bold text-gold-custom">
                            Tips Kesehatan Harian
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 p-3 bg-primary-soft rounded">
                            <h6 class="text-primary-custom mb-2 fw-bold">
                                Batasi Konsumsi Garam Berlebih
                            </h6>
                            <p class="mb-0 fs-6">Konsumsi garam berlebih dapat meningkatkan tekanan darah, WHO
                                merekomendasikan untuk orang dewasa membatasi konsumsi garam maksimal 5 gram per hari atau
                                setara dengan 2 gram atau ½ sendok per hari.</p>
                        </div>
                        <div class="bg-gold-soft rounded p-3">
                            <h6 class="text-primary-custom mb-3 fw-bold">
                                Minum Air yang Cukup
                            </h6>
                            <p class="mb-0 fs-6">Konsumsi <strong>8-10 gelas air putih</strong> setiap hari untuk menjaga
                                tekanan darah stabil dan mendukung fungsi ginjal yang optimal.</p>
                        </div>
                        <div class="mt-3 p-3 bg-primary-soft rounded">
                            <h6 class="text-primary-custom mb-2 fw-bold">
                                Olahraga Ringan
                            </h6>
                            <p class="mb-0 fs-6">Lakukan jalan kaki <strong>30 menit setiap hari</strong> untuk menjaga
                                kesehatan jantung dan mengontrol tekanan darah.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Sidebar Catatan Admin -->
    <div class="catatan-sidebar" id="catatanSidebar">
        <div class="catatan-header">
            <h5 class="mb-0 fw-bold text-white">
                Pesan dari Admin
            </h5>
            <button class="btn-close-sidebar" onclick="tutupSidebar()">
                <i class="bi bi-x-lg text-white"></i>
            </button>
        </div>
        <div class="catatan-content" id="catatanContent">
            <div class="text-center py-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Memuat pesan...</p>
            </div>
        </div>
    </div>

    <!-- Button Floating Catatan -->
    <div class="floating-catatan-btn" onclick="bukaSidebar()">
        <i class="bi bi-chat-dots-fill"></i>
        @php
            $catatanBelumBaca = auth()->user()->catatanDariAdmin()->where('status_baca', 'belum_dibaca')->count();
        @endphp
        @if ($catatanBelumBaca > 0)
            <span class="badge-notif">{{ $catatanBelumBaca }}</span>
        @endif
    </div>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="tutupSidebar()"></div>

    <!-- Pop-up Detail Pesan -->
    <div class="pesan-popup" id="pesanPopup" onclick="tutupPopupPesan(event)">
        <div class="pesan-content" onclick="event.stopPropagation()">
            <div class="pesan-text fs-5 fw-bold" id="pesanText">
                <!-- Isi pesan akan dimuat di sini -->
            </div>
            <div class="pesan-info">
                <div>
                    <div class="fw-bold" id="pesanAdmin">Admin</div>
                    <div class="text-muted" id="pesanTanggal">Tanggal</div>
                </div>
                <button class="pesan-close" onclick="tutupPopupPesan()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

    <script>
        // Catatan Functions
        function tambahCatatan() {
            document.getElementById('catatanDisplay').style.display = 'none';
            document.getElementById('catatanForm').style.display = 'block';
            document.getElementById('catatanTextarea').value = '';
            document.getElementById('catatanTextarea').focus();
        }

        function editCatatan() {
            document.getElementById('catatanDisplay').style.display = 'none';
            document.getElementById('catatanForm').style.display = 'block';
            document.getElementById('catatanTextarea').focus();
        }

        function batalCatatan() {
            document.getElementById('catatanDisplay').style.display = 'block';
            document.getElementById('catatanForm').style.display = 'none';
        }

        function simpanCatatan() {
            const catatan = document.getElementById('catatanTextarea').value.trim();
            fetch('{{ route('catatan.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        catatan: catatan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) location.reload();
                })
                .catch(() => alert('Terjadi kesalahan saat menyimpan catatan'));
        }

        function hapusCatatan() {
            if (confirm('Apakah Anda yakin ingin menghapus catatan ini?')) {
                fetch('{{ route('catatan.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            catatan: ''
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.success ? 'Catatan berhasil dihapus' : data.message);
                        if (data.success) location.reload();
                    })
                    .catch(() => alert('Terjadi kesalahan saat menghapus catatan'));
            }
        }

        // Sidebar Functions
        function bukaSidebar() {
            document.getElementById('catatanSidebar').classList.add('active');
            document.getElementById('sidebarOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
            muatCatatanAdmin();
        }

        function tutupSidebar() {
            document.getElementById('catatanSidebar').classList.remove('active');
            document.getElementById('sidebarOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function muatCatatanAdmin() {
            const content = document.getElementById('catatanContent');
            fetch('/catatan-admin')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        content.innerHTML =
                            '<div class="text-center py-5"><i class="bi bi-chat-dots fs-1 text-muted mb-3"></i><h6 class="text-muted">Belum ada pesan dari admin</h6></div>';
                    } else {
                        let html = '';
                        data.forEach(catatan => {
                            const statusClass = catatan.status_baca === 'belum_dibaca' ? 'belum-dibaca' : '';
                            const tanggal = new Date(catatan.created_at).toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            html += `<div class="catatan-item ${statusClass}" onclick="tampilkanDetailPesan('${catatan.isi_catatan.replace(/'/g, "\\'")}', '${catatan.admin.name}', '${tanggal}', ${catatan.id})">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <small class="text-muted">${tanggal}</small>
                                    ${catatan.status_baca === 'belum_dibaca' ? '<span class="badge bg-danger">Baru</span>' : ''}
                                </div>
                                <p class="mb-0 text-dark fw-medium">${catatan.isi_catatan.length > 100 ? catatan.isi_catatan.substring(0, 100) + '...' : catatan.isi_catatan}</p>
                            </div>`;
                        });
                        content.innerHTML = html;
                    }
                })
                .catch(() => {
                    content.innerHTML = '<div class="text-center py-5 text-danger"><i class="bi bi-exclamation-triangle fs-1 mb-3"></i><h6>Gagal memuat pesan</h6></div>';
                });
        }

        function tampilkanDetailPesan(isi, admin, tanggal, id) {
            document.getElementById('pesanText').textContent = isi;
            document.getElementById('pesanAdmin').textContent = admin;
            document.getElementById('pesanTanggal').textContent = tanggal;
            document.getElementById('pesanPopup').classList.add('active');
            
            // Tandai sebagai sudah dibaca
            fetch(`/catatan-admin/${id}/baca`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
        }

        function tutupPopupPesan(event) {
            if (event && event.target !== event.currentTarget) return;
            document.getElementById('pesanPopup').classList.remove('active');
        }

        // Chart and Blood Pressure Functions
        let tekananDarahChart = null;

        function initChart() {
            const canvas = document.getElementById('tekananDarahChart');
            if (!canvas) return;
            
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
                        tension: 0.4
                    }, {
                        label: 'Diastol',
                        data: [],
                        borderColor: '#0b5e91',
                        backgroundColor: 'rgba(11, 94, 145, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: 'Riwayat Tekanan Darah (mmHg)' }
                    },
                    scales: {
                        y: { beginAtZero: false, min: 40, max: 260 }
                    }
                }
            });
        }

        function loadChartData() {
            fetch('{{ route('tekanan-darah.chart') }}')
                .then(response => response.json())
                .then(data => {
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

        // Form submission for blood pressure
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
            loadChartData();

            const form = document.getElementById('inputTekananDarahForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const submitBtn = document.getElementById('simpanTekananBtn');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Menyimpan...';

                    const formData = {
                        sistol: document.getElementById('sistolInput').value,
                        diastol: document.getElementById('diastolInput').value,
                        _token: '{{ csrf_token() }}'
                    };

                    fetch('{{ route('tekanan-darah.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Data berhasil disimpan');
                            location.reload();
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
                        submitBtn.innerHTML = 'Simpan';
                    });
                });
            }
        });
    </script>
@endsection