<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengingatObat;
use App\Models\DetailObatPengingat;
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

        // Cari jadwal obat dalam extended window (30-120 menit sebelum)
        $targetObat = null;
        $windowInfo = null;
        
        foreach ($waktuList as $waktu) {
            $carbonObat = Carbon::createFromFormat('H:i', $waktu, 'Asia/Jakarta')
                ->setDate($waktuSekarang->year, $waktuSekarang->month, $waktuSekarang->day);

            $diffSeconds = $carbonObat->getTimestamp() - $waktuSekarang->getTimestamp();
            $diffMinutes = $diffSeconds / 60;

            // Hitung total jadwal untuk waktu ini
            $totalJadwalWaktu = DetailObatPengingat::query()
                ->where('status_obat', 'aktif')
                ->whereHas('pengingatObat', function ($q) use ($tanggalHariIni) {
                    $q->where('status', 'aktif')
                      ->where('tanggal_mulai', '<=', $tanggalHariIni);
                })
                ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$waktu])
                ->count();

            // Dynamic window berdasarkan jumlah jadwal
            if ($totalJadwalWaktu <= 10 && $diffMinutes >= 30 && $diffMinutes <= 120) {
                $targetObat = $waktu;
                $windowInfo = "Window: 30-120 menit (≤10 jadwal)";
                break;
            } elseif ($totalJadwalWaktu <= 30 && $diffMinutes >= 60 && $diffMinutes <= 120) {
                $targetObat = $waktu;
                $windowInfo = "Window: 60-120 menit (11-30 jadwal)";
                break;
            } elseif ($totalJadwalWaktu <= 50 && $diffMinutes >= 90 && $diffMinutes <= 120) {
                $targetObat = $waktu;
                $windowInfo = "Window: 90-120 menit (31-50 jadwal)";
                break;
            } elseif ($totalJadwalWaktu > 50 && $diffMinutes >= 120 && $diffMinutes <= 150) {
                $targetObat = $waktu;
                $windowInfo = "Window: 120-150 menit (50+ jadwal)";
                break;
            }
        }

        if (!$targetObat) {
            $this->info("Tidak ada jadwal obat dalam window pengiriman. Keluar.");
            Log::info("No target obat dalam extended window ({$waktuSekarang->format('H:i:s')}).");
            return 0;
        }

        $this->info("Ditemukan jadwal obat {$targetObat}. {$windowInfo}");
        Log::info("Target pengiriman: {$targetObat} | {$windowInfo} | Waktu: {$waktuSekarang->format('H:i:s')}");

        $pengingatAktif = PengingatObat::with(['user', 'detailObat'])
            ->where('status', 'aktif')
            ->where('tanggal_mulai', '<=', $tanggalHariIni)
            ->get();

        // Hitung total jadwal untuk menentukan delay
        $totalJadwal = 0;
        foreach ($pengingatAktif as $pengingat) {
            $totalJadwal += $pengingat->detailObat()
                ->where('status_obat', 'aktif')
                ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$targetObat])
                ->count();
        }

        // Batch system: maksimal 10 pesan per run untuk anti-spam
        $maxBatch = 10;
        $actualBatch = min($totalJadwal, $maxBatch);
        
        // Dynamic delay berdasarkan jumlah jadwal
        if ($totalJadwal <= 10) {
            $delay = 60; // 60 detik untuk jadwal sedikit
        } elseif ($totalJadwal <= 30) {
            $delay = 90; // 90 detik untuk jadwal sedang
        } elseif ($totalJadwal <= 50) {
            $delay = 90; // 90 detik untuk jadwal banyak
        } else {
            $delay = 60; // 60 detik untuk jadwal sangat banyak (batch kecil)
        }

        $this->info("Total jadwal: {$totalJadwal}, Batch: {$actualBatch}, Delay: {$delay} detik per pesan");
        Log::info("Anti-spam: {$totalJadwal} total, batch {$actualBatch}, delay {$delay}s");

        // Kumpulkan semua data pengiriman untuk randomize
        $daftarPengiriman = [];
        foreach ($pengingatAktif as $pengingat) {
            $obatWaktuIni = $pengingat->detailObat()
                ->where('status_obat', 'aktif')
                ->whereRaw('TIME_FORMAT(waktu_minum, "%H:%i") = ?', [$targetObat])
                ->get();

            foreach ($obatWaktuIni as $obat) {
                $daftarPengiriman[] = [
                    'pengingat' => $pengingat,
                    'obat' => $obat
                ];
            }
        }

        // Randomize urutan pengiriman
        shuffle($daftarPengiriman);

        $totalDikirim = 0;
        $counter = 0;
        $batchCounter = 0;

        foreach ($daftarPengiriman as $item) {
            // Batasi maksimal pesan per run
            if ($batchCounter >= $maxBatch) {
                $this->info("Batch limit tercapai ({$maxBatch} pesan). Sisa akan diproses run berikutnya.");
                Log::info("Batch limit: {$maxBatch}, sisa: " . ($totalJadwal - $batchCounter));
                break;
            }
            $pengingat = $item['pengingat'];
            $obat = $item['obat'];
            $counter++;
            
            // cek apakah sudah pernah dikirim hari ini
            $sudahDikirim = WhatsappLog::where('user_id', $pengingat->user->id)
                ->where('detail_obat_id', $obat->id)
                ->where('jenis_pesan', 'pengingat_obat')
                ->whereDate('created_at', $tanggalHariIni)
                ->where('status', 'sent')
                ->exists();

            if ($sudahDikirim) {
                $this->info("[{$counter}/{$actualBatch}] Skip - sudah dikirim: {$pengingat->user->name} - {$obat->nama_obat}");
                Log::info("Skip pengingat: {$pengingat->user->name} - {$obat->nama_obat}. Sudah dikirim hari ini.");
                continue;
            }
            
            $batchCounter++;

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

                WhatsappLog::create([
                    'user_id' => $pengingat->user->id,
                    'detail_obat_id' => $obat->id,
                    'jenis_pesan' => 'pengingat_obat',
                    'pesan' => $pesan,
                    'status' => $result['success'] ? 'sent' : 'failed',
                    'response_message' => $result['message'] ?? null
                ]);

                if ($result['success']) {
                    $this->info("[{$batchCounter}/{$actualBatch}] Dikirim ke {$pengingat->user->name} - {$obat->nama_obat}");
                    Log::info("Dikirim ke {$pengingat->user->nomor_hp} - {$obat->nama_obat}");
                    $totalDikirim++;
                } else {
                    $this->error("Gagal kirim ke {$pengingat->user->name}: {$result['message']}");
                    Log::error("Gagal kirim ke {$pengingat->user->nomor_hp}: " . json_encode($result));
                }

            // Anti-spam delay dengan random variation (kecuali pesan terakhir)
            if ($batchCounter < $actualBatch) {
                $randomDelay = $delay + rand(-15, 15); // ±15 detik variasi
                $this->info("Delay {$randomDelay} detik...");
                sleep($randomDelay);
            }
        }

        $sisaPesan = $totalJadwal - $batchCounter;
        $this->info("Selesai! Batch ini: {$totalDikirim} terkirim. Sisa: {$sisaPesan} pesan.");
        Log::info("Batch selesai: {$totalDikirim} terkirim, sisa: {$sisaPesan}");
        return 0;
    }
}