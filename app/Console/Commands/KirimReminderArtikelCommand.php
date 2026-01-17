<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Article;
use App\Services\FontteWhatsAppService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class KirimReminderArtikelCommand extends Command
{
    protected $signature = 'reminder:kirim-artikel';
    protected $description = 'Kirim reminder baca artikel ke pasien setiap 3 hari (batch 5 pasien per jam)';

    private $whatsappService;

    public function __construct(FontteWhatsAppService $whatsappService)
    {
        parent::__construct();
        $this->whatsappService = $whatsappService;
    }

    public function handle()
    {
        $this->info('Memulai pengiriman reminder artikel...');
        Log::info('Cron reminder:kirim-artikel dipanggil pada ' . now()->toDateTimeString());

        // Cek apakah ada artikel di database
        $totalArtikel = Article::count();
        if ($totalArtikel === 0) {
            $this->info('Tidak ada artikel di database. Skip pengiriman.');
            Log::info('Tidak ada artikel tersedia untuk reminder');
            return 0;
        }

        // Ambil pasien yang eligible (sudah 3 hari sejak reminder terakhir atau belum pernah)
        $eligibleUsers = $this->getEligibleUsers();

        if ($eligibleUsers->isEmpty()) {
            $this->info('Tidak ada pasien yang perlu dikirim reminder hari ini.');
            Log::info('Tidak ada pasien eligible untuk reminder artikel');
            return 0;
        }

        $this->info("Ditemukan {$eligibleUsers->count()} pasien eligible.");
        
        // Ambil batch 5 pasien pertama
        $batch = $eligibleUsers->take(5);
        $this->info("Memproses batch: {$batch->count()} pasien");

        $totalDikirim = 0;
        $totalGagal = 0;

        foreach ($batch as $user) {
            try {
                // Ambil 1 artikel random dari database
                $artikel = Article::inRandomOrder()->first();
                
                if (!$artikel) {
                    $this->warn("Artikel tidak ditemukan, skip user {$user->name}");
                    continue;
                }

                // Tentukan kategori untuk URL berdasarkan article_type
                $kategori = strtolower($artikel->article_type) === 'hipertensi kehamilan' 
                    ? 'hipertensi-kehamilan' 
                    : 'hipertensi-non-kehamilan';

                // Buat link artikel: https://klikfarmasi.com/artikel/{kategori}/{slug}
                $link = "https://klikfarmasi.com/artikel/{$kategori}/{$artikel->slug}";

                // Buat pesan
                $pesan = $this->whatsappService->buatPesanReminderArtikel($artikel->title, $link);

                // Kirim WA
                $result = $this->whatsappService->kirimPesan(
                    $user->nomor_hp,
                    $pesan,
                    $user->id,
                    'reminder_artikel'
                );

                if ($result['success']) {
                    $this->info("✓ Dikirim ke {$user->name} - {$artikel->title}");
                    Log::info("Reminder artikel dikirim ke {$user->nomor_hp} - {$artikel->title}");
                    $totalDikirim++;
                } else {
                    $this->error("✗ Gagal kirim ke {$user->name}: {$result['message']}");
                    Log::error("Gagal kirim reminder artikel ke {$user->nomor_hp}: " . json_encode($result));
                    $totalGagal++;
                }

                // Delay 30 detik antar pesan untuk anti-spam
                if ($batch->last()->id !== $user->id) {
                    sleep(30);
                }

            } catch (\Exception $e) {
                $this->error("Error untuk user {$user->name}: {$e->getMessage()}");
                Log::error("Error kirim reminder artikel ke user {$user->id}: " . $e->getMessage());
                $totalGagal++;
            }
        }

        $this->info("Selesai! Terkirim: {$totalDikirim}, Gagal: {$totalGagal}");
        Log::info("Reminder artikel selesai: {$totalDikirim} terkirim, {$totalGagal} gagal");
        return 0;
    }

    private function getEligibleUsers()
    {
        // Ambil pasien yang:
        // 1. Belum pernah dapat reminder & sudah 3 hari sejak daftar
        // 2. Sudah pernah dapat & sudah 3 hari sejak reminder terakhir
        // 3. BELUM dapat reminder hari ini (PENTING!)
        
        $threeDaysAgo = now()->subDays(3);
        $today = now()->toDateString();

        return User::where('role', 'pasien')
            ->where(function($query) use ($threeDaysAgo) {
                // Kondisi 1: Belum pernah dapat reminder & sudah 3 hari sejak daftar
                $query->whereDoesntHave('whatsappLogs', function($log) {
                    $log->where('jenis_pesan', 'reminder_artikel')
                        ->where('status', 'sent');
                })
                ->where('created_at', '<=', $threeDaysAgo);
            })
            ->orWhere(function($query) use ($threeDaysAgo) {
                // Kondisi 2: Sudah pernah dapat & sudah 3 hari dari reminder terakhir
                $query->whereHas('whatsappLogs', function($log) use ($threeDaysAgo) {
                    $log->select(DB::raw('MAX(created_at) as last_sent'))
                        ->where('jenis_pesan', 'reminder_artikel')
                        ->where('status', 'sent')
                        ->groupBy('user_id')
                        ->having('last_sent', '<=', $threeDaysAgo);
                });
            })
            // FILTER PENTING: Exclude pasien yang sudah dapat reminder HARI INI
            ->whereDoesntHave('whatsappLogs', function($log) use ($today) {
                $log->where('jenis_pesan', 'reminder_artikel')
                    ->where('status', 'sent')
                    ->whereDate('created_at', $today);
            })
            ->get();
    }
}
