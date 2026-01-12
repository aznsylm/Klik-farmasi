<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengingatObat;
use App\Models\DetailObat;
use App\Models\WhatsappLog;
use Carbon\Carbon;

class DebugPengingatCommand extends Command
{
    protected $signature = 'debug:pengingat {waktu?}';
    protected $description = 'Debug pengingat obat untuk waktu tertentu';

    public function handle()
    {
        $waktuSekarang = Carbon::now('Asia/Jakarta');
        $tanggalHariIni = $waktuSekarang->toDateString();
        
        $waktuInput = $this->argument('waktu');
        if ($waktuInput) {
            $waktuTarget = $waktuInput;
        } else {
            $waktuTarget = $waktuSekarang->addMinutes(5)->format('H:i');
        }
        
        $this->info("=== DEBUG PENGINGAT OBAT ===");
        $this->info("Waktu sekarang: " . $waktuSekarang->format('Y-m-d H:i:s'));
        $this->info("Target waktu: {$waktuTarget}");
        $this->info("Tanggal: {$tanggalHariIni}");
        $this->line("");

        // 1. Cek semua pengingat aktif
        $this->info("1. CEK PENGINGAT AKTIF:");
        $pengingatAktif = PengingatObat::where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $tanggalHariIni)
            ->get();
            
        $this->info("Total pengingat aktif: " . $pengingatAktif->count());
        foreach ($pengingatAktif as $p) {
            $this->line("- ID: {$p->id}, User: {$p->user->name}, Status: {$p->status}");
        }
        $this->line("");

        // 2. Cek detail obat untuk waktu target
        $this->info("2. CEK DETAIL OBAT UNTUK WAKTU {$waktuTarget}:");
        foreach ($pengingatAktif as $pengingat) {
            $obatWaktuIni = $pengingat->detailObat()
                ->where('status_obat', 'aktif')
                ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$waktuTarget])
                ->get();
                
            $this->info("Pengingat ID {$pengingat->id} ({$pengingat->user->name}):");
            if ($obatWaktuIni->isEmpty()) {
                $this->line("  - Tidak ada obat untuk waktu {$waktuTarget}");
            } else {
                foreach ($obatWaktuIni as $obat) {
                    $this->line("  - Obat: {$obat->nama_obat}, Waktu: {$obat->waktu_minum}, Status: {$obat->status_obat}");
                }
            }
        }
        $this->line("");

        // 3. Cek log WhatsApp hari ini
        $this->info("3. CEK LOG WHATSAPP HARI INI:");
        $logs = WhatsappLog::whereDate('created_at', $tanggalHariIni)
            ->where('jenis_pesan', 'pengingat_obat')
            ->get();
            
        $this->info("Total log hari ini: " . $logs->count());
        foreach ($logs as $log) {
            $this->line("- User ID: {$log->user_id}, Detail Obat ID: {$log->detail_obat_id}, Status: {$log->status}, Waktu: {$log->created_at}");
        }
        $this->line("");

        // 4. Cek semua waktu obat yang ada
        $this->info("4. SEMUA WAKTU OBAT AKTIF:");
        $semuaWaktu = DetailObat::where('status_obat', 'aktif')
            ->whereHas('pengingatObat', function ($q) use ($tanggalHariIni) {
                $q->where('status', 'aktif')
                  ->where('tanggal_mulai', '<=', $tanggalHariIni);
            })
            ->selectRaw('TIME_FORMAT(waktu_minum, "%H:%i") as waktu, COUNT(*) as jumlah')
            ->groupBy('waktu')
            ->get();
            
        foreach ($semuaWaktu as $waktu) {
            $this->line("- Waktu: {$waktu->waktu}, Jumlah obat: {$waktu->jumlah}");
        }

        return 0;
    }
}