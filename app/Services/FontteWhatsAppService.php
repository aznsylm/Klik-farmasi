<?php

namespace App\Services;

use App\Models\LogWhatsapp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FontteWhatsAppService
{
    private $apiUrl;
    private $token;

    public function __construct()
    {
        $this->apiUrl = config('services.fonnte.api_url', 'https://api.fonnte.com/send');
        $this->token = config('services.fonnte.token');
    }

    public function kirimPesan($nomorTujuan, $pesan, $userId = null, $jenisPesan = 'pengingat_obat')
    {
        try {
            // Format nomor WhatsApp
            $nomorTujuan = $this->formatNomorWhatsApp($nomorTujuan);

            // Kirim ke API Fonnte
            $response = Http::withHeaders([
                'Authorization' => $this->token
            ])->post($this->apiUrl, [
                'target' => $nomorTujuan,
                'message' => $pesan,
                'countryCode' => '62'
            ]);

            // Ambil data JSON dari API
            $responseData = $response->json();

            // Cek status respons
            $berhasil = $response->successful() && ($responseData['status'] ?? false);

            $status = $berhasil ? 'terkirim' : 'gagal';
            $pesanResponse = $responseData['message'] ?? 'Tidak ada pesan dari API';

            // Simpan ke log database kalau ada userId
            if ($userId) {
                LogWhatsapp::create([
                    'user_id'      => $userId,
                    'pesan'        => $pesan,
                    'jenis_pesan'  => $jenisPesan,
                    'status'       => $status,
                    'response_api' => json_encode($responseData),
                    'dikirim_pada' => now()
                ]);
            }

            // Juga simpan ke log file Laravel (untuk debugging)
            Log::info("Hasil kirim WA ke {$nomorTujuan}", $responseData ?? []);

            return [
                'success'  => $berhasil,
                'message'  => $berhasil ? 'Pesan berhasil dikirim' : "Gagal: {$pesanResponse}",
                'response' => $responseData
            ];

        } catch (\Exception $e) {
            Log::error('Error kirim WhatsApp: ' . $e->getMessage());

            if ($userId) {
                LogWhatsapp::create([
                    'user_id'      => $userId,
                    'pesan'        => $pesan,
                    'jenis_pesan'  => $jenisPesan,
                    'status'       => 'gagal',
                    'response_api' => json_encode(['error' => $e->getMessage()]),
                    'dikirim_pada' => now()
                ]);
            }

            return [
                'success'  => false,
                'message'  => 'Error: ' . $e->getMessage(),
                'response' => null
            ];
        }
    }

    public function buatPesanPengingatObat($namaPasien, $namaObat, $jumlahObat, $waktuMinum, $suplemen = null)
    {
        $motivasi = [
            "Waktunya minum obat nih. Jangan sampai kelewat ya!",
            "Eh, udah waktunya lho. Yuk minum obatnya dulu.",
            "Ingat, obat dulu baru aktivitas lain. Semangat!",
            "Jangan lupa minum obat ya. Badan butuh ini.",
            "Ayo dong, obatnya udah nungguin dari tadi.",
            "Sebentar lagi waktunya. Siap-siap minum obat ya.",
            "Tubuh kita butuh ini. Jangan ditunda-tunda.",
            "Udah jam segini, saatnya minum obat nih.",
            "Minum obat dulu yuk, biar badan tetep fit.",
            "Jangan sampai lupa ya. Kesehatan nomor satu.",
            "Waktunya jagain kesehatan. Ayo minum obat!",
            "Sebentar aja kok, minum obat terus lanjut aktivitas.",
            "Badan udah ngasih sinyal nih. Waktunya obat.",
            "Yuk, luangin waktu sebentar buat minum obat.",
            "Jangan dilewatin ya. Obat ini penting banget.",
            "Udah siap belum? Waktunya minum obat nih.",
            "Ayo semangat! Minum obat dulu baru yang lain.",
            "Ingat pesan dokter? Waktunya minum obat.",
            "Sebentar lagi jam minum obat. Jangan lupa ya!",
            "Tubuh kita udah kerja keras. Kasih yang terbaik dong.",
            "Halo! Sudah siap minum obat belum?",
            "Reminder nih, jangan lupa konsumsi obatnya.",
            "Hai, waktunya rutin minum obat lagi.",
            "Ding dong! Alarm minum obat berbunyi.",
            "Psst, ini pengingat penting buat kesehatan.",
            "Cek jam deh, udah waktunya minum obat.",
            "Hei, jangan sampai terlewat ya jadwalnya.",
            "Yuk konsisten, minum obat tepat waktu.",
            "Badan lagi nunggu asupan obatnya nih.",
            "Alarm kesehatan berbunyi! Waktunya minum obat.",
            "Jangan ditunda lagi, langsung minum aja.",
            "Kesehatan prioritas, yuk minum obatnya.",
            "Sudah waktunya, jangan lupa minum obat.",
            "Rutinitas sehat dimulai dari sekarang.",
            "Obat sudah menunggu, ayo diminum.",
            "Tepat waktu itu penting, terutama untuk kesehatan.",
            "Yuk jaga konsistensi minum obatnya.",
            "Badan butuh asupan rutin, jangan lupa ya.",
            "Sekarang waktunya, minum obat dulu.",
            "Pengingat ramah: sudah jam minum obat.",
            "Halo sehat! Waktunya konsumsi obat rutin.",
            "Jangan sampai lupa, ini penting banget.",
            "Yuk disiplin, minum obat sesuai jadwal.",
            "Badan udah ngasih tanda, waktunya obat.",
            "Sebentar doang kok, minum obat terus lanjut.",
            "Kesehatan nomor satu, jangan diabaikan.",
            "Sudah jam segini, saatnya minum obat.",
            "Yuk rutin, biar badan selalu sehat.",
            "Jangan ditunda, langsung minum sekarang.",
            "Obat menunggu, tubuh juga butuh.",
            "Waktunya datang, jangan sampai terlewat.",
            "Hei, sudah siap belum minum obatnya?",
            "Reminder penting: jangan lupa obat rutin.",
            "Yuk konsisten, demi kesehatan yang lebih baik.",
            "Badan lagi butuh, jangan diabaikan ya.",
            "Sekarang waktunya, ayo minum obat.",
            "Jangan lupa ya, ini untuk kebaikan sendiri.",
            "Sudah jam minum obat, yuk langsung aja.",
            "Kesehatan investasi terbaik, jaga terus.",
            "Waktunya tiba, jangan sampai kelewatan.",
            "Yuk disiplin, minum obat tepat waktu."
        ];
        
        $pesanMotivasi = $motivasi[array_rand($motivasi)];
        
        // Variasi format pesan untuk menghindari deteksi spam
        $formatVariasi = [
            "Sebentar lagi\n{$namaObat} | {$waktuMinum}\n\n{$pesanMotivasi}\n\n— Klik Farmasi",
            "{$waktuMinum} • {$namaObat}\n\n{$pesanMotivasi}\n\nSalam sehat, Klik Farmasi",
            "🔔 {$waktuMinum}\n{$namaObat}\n\n{$pesanMotivasi}\n\n~ Klik Farmasi ~",
            "Jadwal: {$waktuMinum}\nObat: {$namaObat}\n\n{$pesanMotivasi}\n\nKlik Farmasi 🌿",
            "{$namaObat} • {$waktuMinum}\n\n{$pesanMotivasi}\n\nTerima kasih,\nKlik Farmasi"
        ];
        
        $pesan = $formatVariasi[array_rand($formatVariasi)];
        
        return $pesan;
    }

    public function buatPesanReminderTekananDarah($namaPasien)
    {
        return "📊 *Pengingat TEKANAN DARAH*\n\n" .
               "Halo {$namaPasien}! 👋\n\n" .
               "Sudah seminggu Anda belum mencatat tekanan darah. 🩺\n\n" .
               "Yuk, cek dan catat tekanan darah Anda hari ini untuk monitoring kesehatan yang lebih baik! 💙\n\n" .
               "Login ke dashboard Klik Farmasi untuk mencatat: " . url('/user/dashboard') . "\n\n" .
               "_Pesan otomatis dari Klik Farmasi_";
    }

    private function formatNomorWhatsApp($nomor)
    {
        // Hapus karakter non-digit
        $nomor = preg_replace('/[^0-9]/', '', $nomor);
        
        // Jika dimulai dengan 0, ganti dengan 62
        if (substr($nomor, 0, 1) === '0') {
            $nomor = '62' . substr($nomor, 1);
        }
        
        // Jika belum ada kode negara, tambahkan 62
        if (substr($nomor, 0, 2) !== '62') {
            $nomor = '62' . $nomor;
        }
        
        return $nomor;
    }
}