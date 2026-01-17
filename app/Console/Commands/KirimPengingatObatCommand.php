<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengingatObat;
use App\Models\DetailObat;
use App\Models\WhatsappLog;
use App\Services\FontteWhatsAppService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class KirimPengingatObatCommand extends Command
{
    protected $signature = 'pengingat:kirim-obat';
    protected $description = 'Kirim pengingat minum obat via WhatsApp 5 menit sebelum waktu minum';

    private $whatsappService;

    public function __construct(FontteWhatsAppService $whatsappService)
    {
        parent::__construct();
        $this->whatsappService = $whatsappService;
    }

    public function handle()
    {
        $this->info('Memulai pengiriman pengingat obat...');
        $waktuSekarang = Carbon::now('Asia/Jakarta');
        $tanggalHariIni = $waktuSekarang->toDateString();
        $waktuTarget = $waktuSekarang->addMinutes(5)->format('H:i');
        
        Log::info('Cron pengingat:kirim-obat dipanggil pada ' . $waktuSekarang->toDateTimeString());
        $this->info("Waktu sekarang: " . $waktuSekarang->format('Y-m-d H:i:s'));
        $this->info("Mencari obat dengan jadwal: {$waktuTarget}");

        // Ambil pengingat aktif dengan obat yang jadwalnya 5 menit lagi
        $pengingatAktif = PengingatObat::with(['user', 'detailObat'])
            ->where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $tanggalHariIni)
            ->whereHas('detailObat', function ($q) use ($waktuTarget) {
                $q->where('status_obat', 'aktif')
                  ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$waktuTarget]);
            })
            ->get();

        if ($pengingatAktif->isEmpty()) {
            $this->info('Tidak ada jadwal obat untuk waktu ini.');
            Log::info("Tidak ada jadwal obat untuk {$waktuTarget}");
            return 0;
        }

        $totalDikirim = 0;
        $totalGagal = 0;

        foreach ($pengingatAktif as $pengingat) {
            $obatWaktuIni = $pengingat->detailObat()
                ->where('status_obat', 'aktif')
                ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$waktuTarget])
                ->get();

            foreach ($obatWaktuIni as $obat) {
                // Cek apakah sudah pernah dikirim hari ini
                $sudahDikirim = WhatsappLog::where('user_id', $pengingat->user->id)
                    ->where('detail_obat_id', $obat->id)
                    ->where('jenis_pesan', 'pengingat_obat')
                    ->whereDate('created_at', $tanggalHariIni)
                    ->where('status', 'sent')
                    ->exists();

                if ($sudahDikirim) {
                    $this->info("Skip - sudah dikirim: {$pengingat->user->name} - {$obat->nama_obat}");
                    continue;
                }

                // Buat pesan dengan template random
                $pesan = $this->whatsappService->buatPesanPengingatObat(
                    $obat->nama_obat,
                    $obat->waktu_minum,
                    $obat->suplemen
                );

                // Kirim pesan
                $result = $this->whatsappService->kirimPesan(
                    $pengingat->user->nomor_hp,
                    $pesan,
                    $pengingat->user->id,
                    'pengingat_obat'
                );

                // Simpan log
                WhatsappLog::create([
                    'user_id' => $pengingat->user->id,
                    'detail_obat_id' => $obat->id,
                    'jenis_pesan' => 'pengingat_obat',
                    'pesan' => $pesan,
                    'status' => $result['success'] ? 'sent' : 'failed',
                    'response_message' => $result['message'] ?? null
                ]);

                if ($result['success']) {
                    $this->info("✓ Dikirim ke {$pengingat->user->name} - {$obat->nama_obat}");
                    Log::info("Dikirim ke {$pengingat->user->nomor_hp} - {$obat->nama_obat}");
                    $totalDikirim++;
                } else {
                    $this->error("✗ Gagal kirim ke {$pengingat->user->name}: {$result['message']}");
                    Log::error("Gagal kirim ke {$pengingat->user->nomor_hp}: " . json_encode($result));
                    $totalGagal++;
                }

                // Delay 30 detik antar pesan untuk anti-spam
                sleep(30);
            }
        }

        $this->info("Selesai! Terkirim: {$totalDikirim}, Gagal: {$totalGagal}");
        Log::info("Pengingat selesai: {$totalDikirim} terkirim, {$totalGagal} gagal");
        return 0;
    }
}