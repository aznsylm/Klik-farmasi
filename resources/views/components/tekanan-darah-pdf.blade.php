<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tekanan Darah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; line-height: 1.4; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #0b5e91; padding-bottom: 15px; }
        .header h1 { color: #0b5e91; margin: 0; font-size: 20px; }
        .header p { margin: 3px 0; color: #666; font-size: 12px; }
        
        .section { margin-bottom: 25px; }
        .section h3 { color: #0b5e91; margin-bottom: 10px; font-size: 14px; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
        
        .patient-info { background: #f8f9fa; padding: 15px; border-radius: 5px; }
        .info-row { margin-bottom: 5px; font-size: 12px; }
        .info-label { display: inline-block; width: 120px; font-weight: bold; }
        
        .medication-table, .pressure-table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        .medication-table th, .medication-table td, .pressure-table th, .pressure-table td { 
            border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 11px; 
        }
        .medication-table th, .pressure-table th { background: #0b5e91; color: white; text-align: center; }
        .pressure-table td:nth-child(1), .pressure-table td:nth-child(3), .pressure-table td:nth-child(4) { text-align: center; }
        tr:nth-child(even) { background: #f9f9f9; }
        
        .contact-section { background: #e3f2fd; padding: 15px; border-radius: 5px; }
        .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px; }
        .contact-item { font-size: 11px; }
        .contact-name { font-weight: bold; }
        
        .footer { margin-top: 30px; text-align: center; font-size: 10px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN REKAM MEDIS TEKANAN DARAH</h1>
        <p>Platform Kesehatan Digital - Klik Farmasi</p>
        <p>Tanggal dibuat: {{ $generatedAt }}</p>
    </div>

    <div class="section">
        <h3>Informasi Pasien</h3>
        <div class="patient-info">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="width: 50%; vertical-align: top; border: none; padding-right: 15px;">
                        <div class="info-row">
                            <span class="info-label">Nama:</span>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email:</span>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jenis Kelamin:</span>
                            <span>{{ $user->jenis_kelamin ?? '-' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Usia:</span>
                            <span>{{ $user->usia ?? '-' }} tahun</span>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top; border: none; padding-left: 15px;">
                        <div class="info-row">
                            <span class="info-label">No. HP:</span>
                            <span>
                                @if($user->nomor_hp)
                                    @if(str_starts_with($user->nomor_hp, '62'))
                                        +{{ $user->nomor_hp }}
                                    @else
                                        +62{{ $user->nomor_hp }}
                                    @endif
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Puskesmas:</span>
                            <span>{{ ucwords(str_replace('_', ' ', $user->puskesmas ?? '-')) }}</span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @if($pengingat && $pengingat->detailObat->count() > 0)
    <div class="section">
        <h3>Daftar Obat</h3>
        <table class="medication-table">
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Waktu Minum</th>
                    <th>Suplemen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengingat->detailObat as $obat)
                <tr>
                    <td>{{ $obat->nama_obat }}</td>
                    <td>{{ $obat->jumlah_obat }} tablet</td>
                    <td>{{ $obat->waktu_minum }}</td>
                    <td>{{ $obat->suplemen ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="section">
        <h3>Statistik Tekanan Darah</h3>
        <div class="patient-info">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="width: 50%; vertical-align: top; border: none; padding-right: 15px;">
                        <div class="info-row">
                            <span class="info-label">Total Catatan:</span>
                            <span>{{ $stats['total'] }} data</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Rata-rata Sistol:</span>
                            <span>{{ $stats['avg_sistol'] }} mmHg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Rata-rata Diastol:</span>
                            <span>{{ $stats['avg_diastol'] }} mmHg</span>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top; border: none; padding-left: 15px;">
                        <div class="info-row">
                            <span class="info-label">Sistol Tertinggi:</span>
                            <span>{{ $stats['max_sistol'] }} mmHg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Diastol Tertinggi:</span>
                            <span>{{ $stats['max_diastol'] }} mmHg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Periode:</span>
                            <span>
                                @if(count($chartData) > 0)
                                    {{ $chartData[0]['tanggal'] }} - {{ end($chartData)['tanggal'] }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <h3>Riwayat Tekanan Darah ({{ count($chartData) }} data)</h3>
        <table class="pressure-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Sistol (mmHg)</th>
                    <th>Diastol (mmHg)</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($chartData as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data['tanggal'] }}</td>
                        <td>{{ $data['sistol'] }}</td>
                        <td>{{ $data['diastol'] }}</td>
                        <td>{{ $data['kategori'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data tekanan darah</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">
        <h3>Kontak Tim Farmasi</h3>
        <div class="contact-section">
            <p style="margin: 0 0 15px 0; font-size: 12px; text-align: center;">Hubungi tim farmasi kami untuk konsultasi dan bantuan lebih lanjut:</p>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #0b5e91;">
                        <th style="color: white; padding: 8px; font-size: 11px; border: 1px solid #ddd;">Nama</th>
                        <th style="color: white; padding: 8px; font-size: 11px; border: 1px solid #ddd;">WhatsApp</th>
                        <th style="color: white; padding: 8px; font-size: 11px; border: 1px solid #ddd;">Nama</th>
                        <th style="color: white; padding: 8px; font-size: 11px; border: 1px solid #ddd;">WhatsApp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd; font-weight: bold;">Abdi Sugeng Pangestu</td>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd;">+62 812-9293-6247</td>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd; font-weight: bold;">Adinda Putri Ibdaniya</td>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd;">+62 812-4398-3318</td>
                    </tr>
                    <tr style="background: #f9f9f9;">
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd; font-weight: bold;">Enzelika</td>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd;">+62 812-7195-4082</td>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd; font-weight: bold;">Febby Trianingsih</td>
                        <td style="padding: 6px; font-size: 10px; border: 1px solid #ddd;">+62 822-8643-8701</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem Klik Farmasi</p>
        <p>© {{ date('Y') }} Klik Farmasi - Platform Kesehatan Digital untuk Manajemen Hipertensi</p>
    </div>
</body>
</html>