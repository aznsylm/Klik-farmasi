<?php
// Script untuk menghitung estimasi biaya SMS
// Jalankan: php artisan tinker, lalu copy paste script ini

use App\Models\DetailObatPengingat;
use App\Models\PengingatObat;

// Hitung total detail obat aktif
$totalDetailObatAktif = DetailObatPengingat::where('status_obat', 'aktif')
    ->whereHas('pengingatObat', function($q) {
        $q->where('status', 'aktif');
    })
    ->count();

echo "=== ESTIMASI BIAYA SMS PENGINGAT OBAT ===\n";
echo "Total detail obat aktif: {$totalDetailObatAktif}\n";
echo "SMS per hari: {$totalDetailObatAktif}\n";
echo "SMS per bulan (30 hari): " . ($totalDetailObatAktif * 30) . "\n\n";

// Estimasi biaya dengan berbagai provider
$providers = [
    'Zenziva' => 200,
    'Nexmo/Vonage' => 250, 
    'Twilio' => 300,
    'SMS Broadcast' => 150
];

foreach ($providers as $provider => $hargaPerSms) {
    $biayaBulanan = $totalDetailObatAktif * 30 * $hargaPerSms;
    echo "{$provider}: Rp " . number_format($biayaBulanan) . "/bulan\n";
}

// Breakdown per puskesmas
echo "\n=== BREAKDOWN PER PUSKESMAS ===\n";
$puskesmasList = ['kalasan', 'godean_2', 'umbulharjo'];

foreach ($puskesmasList as $puskesmas) {
    $count = DetailObatPengingat::where('status_obat', 'aktif')
        ->whereHas('pengingatObat', function($q) use ($puskesmas) {
            $q->where('status', 'aktif')
              ->whereHas('user', function($q2) use ($puskesmas) {
                  $q2->where('puskesmas', $puskesmas);
              });
        })
        ->count();
    
    $biayaBulanan = $count * 30 * 200; // Asumsi Rp 200/SMS
    echo ucfirst(str_replace('_', ' ', $puskesmas)) . ": {$count} SMS/hari = Rp " . number_format($biayaBulanan) . "/bulan\n";
}