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
        $pesan = "*PENGINGAT PENTING - MINUM OBAT*\n\n" .
                 "Halo Bapak/Ibu {$namaPasien}! 👋\n\n" .
                 "⚠️ *PERHATIAN: 5 MENIT LAGI WAKTUNYA MINUM OBAT*\n\n" .
                 "Detail Obat Hipertensi:\n" .
                 "Nama: *{$namaObat}*\n" .
                 "Waktu: *{$waktuMinum}*\n";
        
        // Tambahkan suplemen jika ada
        if ($suplemen) {
            $pesan .= "Suplemen: *{$suplemen}*\n";
        }
        
        $pesan .= "\n*Siapkan obat Anda sekarang!*\n" .
                  "Jangan lupa minum dengan air putih\n" .
                  "Perhatikan aturan makan (sebelum/sesudah makan)\n\n" .
                  "Konsistensi minum obat adalah kunci kesembuhan Anda! 💪\n\n" .
                  "Butuh bantuan? Hubungi Admin Klik Farmasi\n" .
                  "_Pesan otomatis dari Klik Farmasi - Platform Kesehatan Digital_";
        
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