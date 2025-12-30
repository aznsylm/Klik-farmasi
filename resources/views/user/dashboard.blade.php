@extends('layouts.user')

@section('title', 'Dashboard Pasien')

@section('content')
    <div class="container-fluid p-3" style="height: 100vh; overflow: hidden;">
        <!-- Header dengan Profile -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-1 fw-bold text-dark">Halo, {{ Auth::user()->name }}!</h3>
                <p class="text-muted mb-0 small">Jaga tekanan darah tetap terkontrol hari ini</p>
            </div>
            <button class="btn btn-primary rounded-circle shadow-sm" style="width: 45px; height: 45px; font-size: 1.2rem;"
                data-bs-toggle="modal" data-bs-target="#profileModal">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </button>
        </div>

        <!-- Alert Informatif -->
        @php
            $alertMessage = '';
            $alertClass = '';

            $latestPengingat = \App\Models\PengingatObat::where('user_id', Auth::id())->latest()->first();
            $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', Auth::id())->latest()->first();
            $allTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();

            // 1. Tekanan Darah Kritis
            if ($latestTekananDarah && ($latestTekananDarah->sistol >= 180 || $latestTekananDarah->diastol >= 120)) {
                $alertMessage =
                    'SEGERA KE HUBUNGI ADMIN! Tekanan darah Anda sangat tinggi dan berbahaya, Kunsultasi Segera';
                $alertClass = 'bg-danger text-white';
            }
            // 2. Hipertensi Kehamilan - Tekanan Tinggi
            elseif (
                $latestPengingat &&
                $latestPengingat->diagnosa === 'Hipertensi-Kehamilan' &&
                $latestTekananDarah &&
                ($latestTekananDarah->sistol >= 140 || $latestTekananDarah->diastol >= 90)
            ) {
                $alertMessage = 'Tekanan darah tinggi saat hamil berbahaya! Segera ke dokter kandungan';
                $alertClass = 'bg-danger text-white';
            }
            // 3. Tekanan Darah Sangat Tinggi
            elseif (
                $latestTekananDarah &&
                (($latestTekananDarah->sistol >= 160 && $latestTekananDarah->sistol < 180) ||
                    ($latestTekananDarah->diastol >= 100 && $latestTekananDarah->diastol < 120))
            ) {
                $alertMessage =
                    'Tekanan darah sangat tinggi! Segera hubungi dokter hari ini atau silahkan hubungi admin untuk konsultasi';
                $alertClass = 'bg-warning text-dark';
            }
            // 4. Trend Naik Konsisten
            elseif ($allTekananDarah->count() >= 3) {
                $data = $allTekananDarah->reverse()->values();
                if ($data[0]->sistol < $data[1]->sistol && $data[1]->sistol < $data[2]->sistol) {
                    $alertMessage =
                        'Tekanan darah terus naik dalam 3 catatan terakhir. Waspada dan hubungi admin jika ingin konsultasi';
                    $alertClass = 'bg-warning text-dark';
                }
            }
            // 5. Tidak Input >3 Hari
            if (!$alertMessage && $latestPengingat && $latestPengingat->status === 'aktif') {
                $daysSinceLastInput = $latestTekananDarah
                    ? \Carbon\Carbon::parse($latestTekananDarah->created_at)->diffInDays(now())
                    : 999;
                if ($daysSinceLastInput > 3) {
                    $alertMessage =
                        'Sudah ' .
                        (int) $daysSinceLastInput .
                        ' hari tidak catat tekanan darah. Jangan lupa pantau rutin!';
                    $alertClass = 'bg-info text-white';
                }
            }
            // 6. Mendekati Batas 91 Hari
            if (!$alertMessage && $latestPengingat && $latestPengingat->status === 'aktif') {
                $daysSinceStart = \Carbon\Carbon::parse($latestPengingat->created_at)->diffInDays(now());
                $remainingDays = 91 - $daysSinceStart;
                if ($remainingDays > 0 && $remainingDays <= 7) {
                    $alertMessage =
                        'Masa pantau akan berakhir dalam ' .
                        $remainingDays .
                        ' hari. Hubungi admin untuk bantuan lanjutan';
                    $alertClass = 'bg-info text-white';
                }
            }
            // 7. Pengingat Obat Tidak Aktif
            if (!$alertMessage && (!$latestPengingat || $latestPengingat->status !== 'aktif')) {
                $alertMessage = 'Pengingat obat tidak aktif. Hubungi admin untuk bantuan';
                $alertClass = 'bg-secondary text-white';
            }
            // 8. Belum Ada Data
            if (!$alertMessage && !$latestTekananDarah) {
                $alertMessage = 'Selamat datang! Mulai catat tekanan darah untuk pantau kesehatan Anda';
                $alertClass = 'bg-success text-white';
            }
        @endphp

        @if ($alertMessage)
            <div class="alert {{ $alertClass }} mb-3 fw-semibold" style="border: none; font-size: 14px;">
                {{ $alertMessage }}
            </div>
        @endif

        <div class="row h-75">
            <!-- Grafik Tekanan Darah -->
            <div class="col-lg-6 col-12 mb-3">
                <div class="card border-0 shadow-lg h-100">
                    <div class="card-body p-3">
                        <h6 class="fw-bold mb-2">Grafik Tekanan Darah</h6>
                        <div style="position: relative; height: calc(100% - 80px); min-height: 200px;">
                            <canvas id="bloodPressureChart"></canvas>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('user.tekanan-darah.pdf') }}" class="btn btn-danger btn-sm"
                                style="border-radius: 4px;">
                                <i class="fas fa-file-pdf me-1"></i> Unduh Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input & Obat -->
            <div class="col-lg-6 col-12 mb-3">
                <div class="row h-100">
                    <!-- Input Tekanan Darah -->
                    <div class="col-12 mb-3" style="height: 60%;">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-2">Catat Tekanan Darah</h6>
                                @php
                                    $latestPengingat = \App\Models\PengingatObat::where('user_id', Auth::id())
                                        ->latest()
                                        ->first();
                                    $canInput = false;
                                    $message = '';

                                    if ($latestPengingat) {
                                        $daysSinceStart = \Carbon\Carbon::parse(
                                            $latestPengingat->created_at,
                                        )->diffInDays(now());
                                        $canInput = $latestPengingat->status === 'aktif' && $daysSinceStart < 91;

                                        if (!$canInput) {
                                            if ($latestPengingat->status !== 'aktif') {
                                                $message =
                                                    'Pengingat obat sudah tidak aktif. Hubungi admin jika ada kendala.';
                                            } else {
                                                $message =
                                                    'Masa input tekanan darah sudah berakhir (91 hari). Hubungi admin jika ada kendala.';
                                            }
                                        }
                                    } else {
                                        $message = 'Belum ada pengingat obat yang diatur.';
                                    }
                                @endphp

                                @if ($canInput)
                                    <form id="bloodPressureForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <label class="form-label small fw-semibold">Sistol</label>
                                                <input type="number" class="form-control shadow-sm" id="sistol"
                                                    min="70" max="250" required style="border-radius: 8px;">
                                            </div>
                                            <div class="col-6 mb-2">
                                                <label class="form-label small fw-semibold">Diastol</label>
                                                <input type="number" class="form-control shadow-sm" id="diastol"
                                                    min="40" max="150" required style="border-radius: 8px;">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mb-2 shadow-sm"
                                            style="border-radius: 8px; font-weight: 600;">Simpan Data</button>
                                    </form>
                                @elseif($latestPengingat && $latestPengingat->status === 'tidak_aktif')
                                    <div class="text-center py-3">
                                        <div class="mb-3">
                                            <div class="text-muted mb-2">⏸️</div>
                                            <p class="text-muted mb-2 small">Pengingat obat sedang tidak aktif. Admin akan
                                                mengaktifkan kembali jika diperlukan.</p>
                                            <p class="text-muted mb-2 small">Jika diaktifkan kembali, Anda perlu mengisi
                                                ulang data pengingat obat.</p>
                                        </div>
                                        <button class="btn btn-secondary w-100 mb-2 shadow-sm" disabled
                                            style="border-radius: 8px; font-weight: 600;">Input Tidak Tersedia</button>
                                    </div>
                                @else
                                    <div class="text-center py-3">
                                        <div class="mb-3">
                                            <div class="text-muted mb-2">🚫</div>
                                            <p class="text-muted mb-2 small">{{ $message }}</p>
                                        </div>
                                        <button class="btn btn-secondary w-100 mb-2 shadow-sm" disabled
                                            style="border-radius: 8px; font-weight: 600;">Input Tidak Tersedia</button>
                                    </div>
                                @endif

                                @php
                                    $latestTekananDarah = \App\Models\CatatanTekananDarah::where('user_id', Auth::id())
                                        ->latest()
                                        ->first();
                                @endphp
                                @if ($latestTekananDarah)
                                    <div class="p-2 bg-light rounded shadow-sm">
                                        <small class="text-success fw-semibold">Terakhir:
                                            {{ $latestTekananDarah->sistol }}/{{ $latestTekananDarah->diastol }}
                                            mmHg</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Obat -->
                    <div class="col-12" style="height: 40%;">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="card-body p-3">
                                <h6 class="fw-bold mb-2">Obat Anda</h6>
                                @php
                                    $latestPengingat = \App\Models\PengingatObat::where('user_id', Auth::id())
                                        ->latest()
                                        ->first();
                                @endphp

                                <div style="max-height: calc(100% - 50px); overflow-y: auto;">
                                    @if ($latestPengingat && $latestPengingat->detailObat->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-sm mb-0" style="border-radius: 8px;">
                                                <thead>
                                                    <tr>
                                                        <th class="small fw-bold">Nama Obat</th>
                                                        <th class="small fw-bold">Jumlah</th>
                                                        <th class="small fw-bold">Waktu</th>
                                                        <th class="small fw-bold">Suplemen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($latestPengingat->detailObat as $obat)
                                                        <tr>
                                                            <td class="small fw-semibold">{{ $obat->nama_obat }}</td>
                                                            <td class="small">{{ $obat->jumlah_obat }}</td>
                                                            <td class="small">{{ $obat->waktu_minum }}</td>
                                                            <td class="small">{{ $obat->suplemen ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($latestPengingat->status === 'tidak_aktif')
                                            <div class="mt-2">
                                                <small class="text-warning fw-semibold">⚠️ Pengingat tidak aktif - Perlu
                                                    input ulang jika diaktifkan</small>
                                            </div>
                                        @endif
                                    @else
                                        <div class="text-center py-2">
                                            <p class="text-muted mb-2 small">Belum ada obat yang diatur</p>
                                            <a href="{{ route('pengingat') }}" class="btn btn-primary btn-sm shadow-sm"
                                                style="border-radius: 8px; font-weight: 600;">Atur Obat</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Layout -->
        <style>
            @media (max-width: 991px) {
                .container-fluid {
                    height: auto !important;
                    overflow: visible !important;
                }

                .row.h-75 {
                    height: auto !important;
                }

                .col-12 .card {
                    height: auto !important;
                    min-height: 250px;
                }

                .col-12:first-child .card {
                    min-height: 300px;
                }

                .col-12[style*="height: 60%"] {
                    height: auto !important;
                    margin-bottom: 1rem;
                }

                .col-12[style*="height: 40%"] {
                    height: auto !important;
                }
            }
        </style>
    </div>

    <!-- Floating FAQ Button -->
    <button class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#faqModal"
        style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; border-radius: 25px; padding: 8px 15px; font-size: 12px; font-weight: 600;">
        Memiliki Kendala?
    </button>

    <!-- Modal Profile -->
    <div class="modal fade" id="profileModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Profil Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-semibold">Nama:</td>
                            <td>{{ Auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Email:</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Jenis Kelamin:</td>
                            <td>{{ Auth::user()->jenis_kelamin ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Usia:</td>
                            <td>{{ Auth::user()->usia ?? '-' }} tahun</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">No. HP:</td>
                            <td>
                                @if (Auth::user()->nomor_hp)
                                    @if (str_starts_with(Auth::user()->nomor_hp, '62'))
                                        +{{ Auth::user()->nomor_hp }}
                                    @else
                                        +62{{ Auth::user()->nomor_hp }}
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Puskesmas:</td>
                            <td>{{ ucwords(str_replace('_', ' ', Auth::user()->puskesmas ?? '-')) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('logout') }}" class="btn btn-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Keluar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal FAQ -->
    <div class="modal fade" id="faqModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Bantuan & FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="accordion" id="faqAccordion">
                        <!-- Login & Akun -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq1">
                                    Masalah Login & Akun
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Saya lupa kata sandi, bagaimana cara menggantinya?</p>
                                        <p class="mb-0 text-muted">Hubungi Admin untuk mengganti kata sandi Anda</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Kenapa saya tidak bisa masuk ke akun?</p>
                                        <p class="mb-0 text-muted">Hubungi Admin untuk membantu masalah login Anda</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara mengubah data diri saya?</p>
                                        <p class="mb-0 text-muted">Hubungi Admin untuk mengubah data profil Anda</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Bisa ganti nomor HP yang sudah terdaftar?</p>
                                        <p class="mb-0 text-muted">Bisa, hubungi Admin untuk mengganti nomor HP</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Input Tekanan Darah -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq2">
                                    Masalah Input Tekanan Darah
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Kenapa saya tidak bisa catat tekanan darah hari ini?</p>
                                        <p class="mb-0 text-muted">Sehari hanya boleh catat 1 kali saja</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Muncul pesan "sudah catat hari ini" padahal belum</p>
                                        <p class="mb-0 text-muted">Silahkan hubungi Admin untuk bantuan</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Angka tekanan darah saya salah tulis, bisa diubah?</p>
                                        <p class="mb-0 text-muted">Bisa, silahkan hubungi Admin untuk mengubahnya</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Tombol "Simpan Data" tidak bisa diklik</p>
                                        <p class="mb-0 text-muted">Hubungi Admin jika ada masalah seperti ini</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Berapa angka tekanan darah yang boleh diisi?</p>
                                        <p class="mb-0 text-muted">Angka atas (sistol): 70-250. Angka bawah (diastol):
                                            40-150. Tekanan darah normal biasanya di bawah 120/80</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik & Data -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq3">
                                    Masalah Grafik & Data
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Grafik tekanan darah saya kosong/tidak muncul</p>
                                        <p class="mb-0 text-muted">Pastikan internet lancar. Jika masih bermasalah, hubungi
                                            Admin</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Data tekanan darah saya hilang</p>
                                        <p class="mb-0 text-muted">Coba muat ulang halaman atau keluar masuk lagi. Jika
                                            masih hilang, hubungi Admin</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara membaca grafik tekanan darah?</p>
                                        <p class="mb-0 text-muted">Garis merah = angka atas (sistol). Garis biru = angka
                                            bawah (diastol). Grafik menunjukkan naik turunnya tekanan darah dari hari ke
                                            hari</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Data lama tidak tampil di grafik</p>
                                        <p class="mb-0 text-muted">Hubungi Admin untuk bantuan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PDF & Laporan -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq4">
                                    Masalah PDF & Laporan
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">PDF tidak bisa diunduh/error saat download</p>
                                        <p class="mb-0 text-muted">Pastikan internet lancar. Jika masih bermasalah, hubungi
                                            Admin</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">File PDF kosong atau tidak ada datanya</p>
                                        <p class="mb-0 text-muted">Pastikan internet lancar. Jika masih bermasalah, hubungi
                                            Admin</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara menyimpan PDF di HP?</p>
                                        <p class="mb-0 text-muted">Setelah klik tombol merah "Unduh Laporan PDF", file akan
                                            tersimpan di folder Download HP Anda</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">PDF tidak bisa dibuka di HP saya</p>
                                        <p class="mb-0 text-muted">HP Anda perlu aplikasi pembaca PDF seperti Adobe Reader
                                            atau bisa buka lewat browser</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pengingat Obat -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq5">
                                    Masalah Pengingat Obat
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara mengatur pengingat obat?</p>
                                        <p class="mb-0 text-muted">Klik tombol "Atur Obat" di halaman utama, lalu isi semua
                                            data yang diminta dengan lengkap</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Pengingat obat saya sudah mati, bagaimana menghidupkan
                                            lagi?</p>
                                        <p class="mb-0 text-muted">Hubungi Admin untuk bantuan</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bisa ubah jadwal minum obat yang sudah diatur?</p>
                                        <p class="mb-0 text-muted">Bisa, hubungi Admin untuk mengubahnya</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Kenapa tidak bisa catat tekanan darah setelah 3 bulan?</p>
                                        <p class="mb-0 text-muted">Karena sudah mencapai batas waktu maksimal (91 hari).
                                            Hubungi Admin jika masih perlu bantuan</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Teknis Umum -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq6">
                                    Masalah Teknis Umum
                                </button>
                            </h2>
                            <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Website lambat atau tidak bisa dibuka</p>
                                        <p class="mb-0 text-muted">Pastikan internet HP Anda lancar</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Tombol tidak bisa diklik</p>
                                        <p class="mb-0 text-muted">Muat ulang halaman dan pastikan internet lancar</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Tampilan website berantakan di HP</p>
                                        <p class="mb-0 text-muted">Coba muat ulang halaman atau bersihkan riwayat browser.
                                            Pastikan pakai browser terbaru</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara keluar dari akun?</p>
                                        <p class="mb-0 text-muted">Klik foto profil di pojok kanan atas, lalu klik tombol
                                            merah "Keluar"</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Apakah data saya aman di website ini?</p>
                                        <p class="mb-0 text-muted">Aman, kami menjaga kerahasiaan data pribadi dan rekam
                                            medis Anda</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak & Bantuan -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq7">
                                    Kontak & Bantuan
                                </button>
                            </h2>
                            <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara menghubungi Admin/Farmasis?</p>
                                        <p class="mb-0 text-muted">Pilih salah satu nomor WhatsApp yang ada di bagian bawah
                                            halaman utama. Konsultasi gratis</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Berapa lama Tim Farmasi membalas pesan?</p>
                                        <p class="mb-0 text-muted">Kami selalu siap membantu Anda</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bisa konsultasi gratis lewat WhatsApp?</p>
                                        <p class="mb-0 text-muted">Bisa, konsultasi gratis untuk semua pasien</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Jam berapa saja bisa hubungi Tim Farmasi?</p>
                                        <p class="mb-0 text-muted">Kami selalu siap membantu Anda kapan saja</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemahaman Fitur -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faq8">
                                    Pemahaman Fitur
                                </button>
                            </h2>
                            <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Apa bedanya hipertensi kehamilan dan biasa?</p>
                                        <p class="mb-0 text-muted">Hipertensi kehamilan terjadi saat hamil dan berbahaya
                                            untuk ibu dan bayi. Hipertensi biasa adalah tekanan darah tinggi pada kondisi
                                            normal</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Bagaimana cara membaca hasil pantauan saya?</p>
                                        <p class="mb-0 text-muted">Lihat grafik untuk melihat naik turunnya tekanan darah.
                                            Jika terus di atas 140/90 atau naik mendadak, segera ke dokter</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <p class="fw-bold mb-1">Kapan saya harus ke dokter berdasarkan data tekanan darah?
                                        </p>
                                        <p class="mb-0 text-muted">Segera ke dokter jika tekanan darah lebih dari 180/120,
                                            sakit kepala berat, sesak napas, atau nyeri dada</p>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1">Apakah website ini bisa ganti konsultasi dokter?</p>
                                        <p class="mb-0 text-muted">Tidak bisa. Website ini hanya alat bantu pantau dan
                                            belajar. Tetap harus kontrol rutin ke dokter</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('bloodPressureChart');
            if (!ctx) return;

            fetch('/api/blood-pressure-data')
                .then(response => response.json())
                .then(data => {
                    new Chart(ctx, {
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
                            animation: {
                                duration: 0
                            },
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
                })
                .catch(err => console.error('Error loading chart:', err));

            const form = document.getElementById('bloodPressureForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const sistol = document.getElementById('sistol').value;
                    const diastol = document.getElementById('diastol').value;
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    fetch('/api/save-blood-pressure', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                sistol,
                                diastol
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert(data.message || 'Gagal menyimpan data');
                            }
                        })
                        .catch(err => {
                            console.error('Error:', err);
                            alert('Terjadi kesalahan');
                        });
                });
            }
        });
    </script>
@endsection
