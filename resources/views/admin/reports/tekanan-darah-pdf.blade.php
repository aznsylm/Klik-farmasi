<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tekanan Darah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #0b5e91; padding-bottom: 20px; }
        .header h1 { color: #0b5e91; margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; color: #666; }
        .patient-info { background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .patient-info h3 { color: #0b5e91; margin-top: 0; }
        .info-row { display: flex; margin-bottom: 8px; }
        .info-label { width: 150px; font-weight: bold; }
        .summary { display: flex; justify-content: space-between; margin: 20px 0; }
        .summary-box { background: #e3f2fd; padding: 15px; border-radius: 8px; text-align: center; width: 30%; }
        .summary-box h4 { margin: 0; color: #0b5e91; }
        .summary-box p { margin: 5px 0; font-size: 18px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #0b5e91; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #666; border-top: 1px solid #ddd; padding-top: 15px; }
        .badge { padding: 3px 8px; border-radius: 4px; color: white; font-size: 11px; }
        .badge-sistol { background: #dc3545; }
        .badge-diastol { background: #0b5e91; }
        .badge-sumber { background: #6c757d; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN MONITORING TEKANAN DARAH</h1>
        <p>Platform Kesehatan Digital - Klik Farmasi</p>
        <p>Tanggal dibuat: {{ $generatedAt }}</p>
    </div>

    <div class="patient-info">
        <h3>Informasi Pasien</h3>
        <div class="info-row">
            <span class="info-label">Nama:</span>
            <span>{{ $user->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Usia:</span>
            <span>{{ $user->usia }} tahun</span>
        </div>
        <div class="info-row">
            <span class="info-label">Jenis Kelamin:</span>
            <span>{{ $user->jenis_kelamin }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Diagnosa:</span>
            <span>{{ $pengingat->diagnosa }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Mulai:</span>
            <span>{{ \Carbon\Carbon::parse($pengingat->tanggal_mulai)->format('d M Y') }}
        </div>
    </div>

    <div class="summary">
        <div class="summary-box">
            <h4>Total Data</h4>
            <p>{{ $totalData }}</p>
        </div>
    </div>

    <h3 style="color: #0b5e91;">Riwayat Data Tekanan Darah</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Sistol (mmHg)</th>
                <th>Diastol (mmHg)</th>
                <th>Sumber Data</th>
            </tr>
        </thead>
        <tbody>
            @forelse($chartData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['tanggal'] }}</td>
                    <td><span class="badge badge-sistol">{{ $data['sistol'] }}</span></td>
                    <td><span class="badge badge-diastol">{{ $data['diastol'] }}</span></td>
                    <td><span class="badge badge-sumber">{{ $data['sumber'] }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data tekanan darah</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($pengingat->catatan)
        <div style="margin-top: 20px; padding: 15px; background: #fff3cd; border-radius: 8px;">
            <h4 style="color: #856404; margin-top: 0;">Catatan {{ $user->name }}:</h4>
            <p style="margin: 0;">{{ $pengingat->catatan }}</p>
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem Klik Farmasi</p>
        <p>© {{ date('Y') }} Klik Farmasi - Platform Kesehatan Digital</p>
    </div>
</body>
</html>