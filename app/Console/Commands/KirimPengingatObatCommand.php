<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengingatObat;
use App\Models\DetailObatPengingat;
use App\Models\NotificationLog;
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
        Log::info('Cron pengingat:kirim-obat dipanggil pada ' . $waktuSekarang->toDateTimeString());
        $this->info("Waktu sekarang: " . $waktuSekarang->format('Y-m-d H:i:s'));

        // Ambil daftar waktu_minum unik dari DB (format H:i) untuk obat aktif
        $waktuList = DetailObatPengingat::query()
            ->where('status_obat', 'aktif')
            ->whereHas('pengingatObat', function ($q) use ($tanggalHariIni) {
                $q->where('status', 'aktif')
                  ->where('tanggal_mulai', '<=', $tanggalHariIni);
            })
            ->selectRaw("TIME_FORMAT(waktu_minum, '%H:%i') as waktu")
            ->pluck('waktu')
            ->unique()
            ->values();

        if ($waktuList->isEmpty()) {
            $this->info('Tidak ada waktu obat aktif di database. Keluar.');
            Log::info('Tidak ada waktu obat aktif di DB.');
            return 0;
        }

        $this->info('Waktu obat terdaftar: ' . implode(', ', $waktuList->toArray()));

        // Cari waktu yang tepat ±5 menit dari sekarang (toleransi 4–6 menit)
        $targetObat = null;
        foreach ($waktuList as $waktu) {
            $carbonObat = Carbon::createFromFormat('H:i', $waktu, 'Asia/Jakarta')
                ->setDate($waktuSekarang->year, $waktuSekarang->month, $waktuSekarang->day);

            $diffSeconds = $carbonObat->getTimestamp() - $waktuSekarang->getTimestamp();

            // ±5 menit (300 detik) dengan toleransi ±30 detik
            if ($diffSeconds >= 270 && $diffSeconds <= 330) {
                $targetObat = $waktu;
                break;
            }
        }

        if (!$targetObat) {
            $this->info("Tidak ada jadwal obat yang tepat 5 menit dari sekarang. Keluar.");
            Log::info("No target obat 5 menit dari sekarang ({$waktuSekarang->format('H:i:s')}).");
            return 0;
        }

        $this->info("Ditemukan jadwal obat {$targetObat}. Mengirim pengingat...");
        Log::info("Target pengiriman: {$targetObat} (waktu sekarang: {$waktuSekarang->format('H:i:s')})");

        $pengingatAktif = PengingatObat::with(['user', 'detailObat'])
            ->where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $tanggalHariIni)
            ->get();

        $totalDikirim = 0;

        foreach ($pengingatAktif as $pengingat) {
            $obatWaktuIni = $pengingat->detailObat()
                ->where('status_obat', 'aktif')
                ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$targetObat])
                ->get();

            foreach ($obatWaktuIni as $obat) {
                // cek apakah sudah pernah dikirim hari ini
                $sudahDikirim = NotificationLog::where('user_id', $pengingat->user->id)
                    ->where('detail_obat_id', $obat->id)
                    ->where('tanggal_kirim', $tanggalHariIni)
                    ->where('status', 'sent')
                    ->exists();

                if ($sudahDikirim) {
                    $this->info("Skip - sudah dikirim hari ini: {$pengingat->user->name} - {$obat->nama_obat}");
                    Log::info("Skip pengingat: {$pengingat->user->name} - {$obat->nama_obat}. Sudah dikirim hari ini.");
                    continue;
                }

                $pesan = $this->whatsappService->buatPesanPengingatObat(
                    $pengingat->user->name,
                    $obat->nama_obat,
                    $obat->jumlah_obat,
                    $obat->waktu_minum,
                    $obat->suplemen
                );

                $result = $this->whatsappService->kirimPesan(
                    $pengingat->user->nomor_hp,
                    $pesan,
                    $pengingat->user->id,
                    'pengingat_obat'
                );

                NotificationLog::create([
                    'user_id' => $pengingat->user->id,
                    'detail_obat_id' => $obat->id,
                    'tanggal_kirim' => $tanggalHariIni,
                    'waktu_kirim' => $waktuSekarang->format('H:i:s'),
                    'status' => $result['success'] ? 'sent' : 'failed',
                    'response_message' => $result['message'] ?? null
                ]);

                if ($result['success']) {
                    $this->info("Pengingat dikirim ke {$pengingat->user->name} untuk obat {$obat->nama_obat}");
                    Log::info("Dikirim ke {$pengingat->user->nomor_hp} - {$obat->nama_obat}");
                    $totalDikirim++;
                } else {
                    $this->error("Gagal kirim ke {$pengingat->user->name}: {$result['message']}");
                    Log::error("Gagal kirim ke {$pengingat->user->nomor_hp}: " . json_encode($result));
                }
            }
        }

        $this->info("Selesai! Total pengingat dikirim: {$totalDikirim}");
        Log::info("Selesai pengiriman. total: {$totalDikirim}");
        return 0;
    }
}