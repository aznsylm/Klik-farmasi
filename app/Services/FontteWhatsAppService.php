<?php

namespace App\Services;

use App\Models\WhatsappLog;
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

            $status = $berhasil ? 'sent' : 'failed';
            $pesanResponse = $responseData['message'] ?? 'Tidak ada pesan dari API';

            // Simpan ke log database kalau ada userId
            if ($userId) {
                WhatsappLog::create([
                    'user_id'         => $userId,
                    'detail_obat_id'  => null,
                    'jenis_pesan'     => $jenisPesan,
                    'pesan'           => $pesan,
                    'status'          => $status,
                    'response_message' => json_encode($responseData)
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
                WhatsappLog::create([
                    'user_id'         => $userId,
                    'detail_obat_id'  => null,
                    'jenis_pesan'     => $jenisPesan,
                    'pesan'           => $pesan,
                    'status'          => 'failed',
                    'response_message' => json_encode(['error' => $e->getMessage()])
                ]);
            }

            return [
                'success'  => false,
                'message'  => 'Error: ' . $e->getMessage(),
                'response' => null
            ];
        }
    }

    public function buatPesanPengingatObat($namaObat, $waktuMinum, $suplemen = null)
    {
        // Deteksi konteks: obat, suplemen, atau keduanya
        $adaObat = !empty($namaObat) && $namaObat !== '-' && strtolower($namaObat) !== 'tidak ada';
        $adaSuplemen = !empty($suplemen) && $suplemen !== '-' && strtolower($suplemen) !== 'tidak ada';
        
        // Buat list item dengan bold
        $itemLines = [];
        if ($adaObat) $itemLines[] = "*{$namaObat}*";
        if ($adaSuplemen) $itemLines[] = "*{$suplemen}*";
        $namaLengkap = implode("\n", $itemLines);
        
        // Tentukan kata kunci berdasarkan konteks
        if ($adaObat && $adaSuplemen) {
            $jenis = 'obat dan suplemen';
            $jenisShort = 'obat & suplemen';
        } elseif ($adaSuplemen && !$adaObat) {
            $jenis = 'suplemen';
            $jenisShort = 'suplemen';
        } else {
            $jenis = 'obat';
            $jenisShort = 'obat';
        }
        
        // Motivasi universal (bisa untuk obat/suplemen/keduanya)
        $motivasi = [
            "Waktunya minum {$jenis} nih. Jangan sampai kelewat ya!",
            "Eh, udah waktunya lho. Yuk minum {$jenisShort}nya dulu.",
            "Jangan lupa minum {$jenis} ya. Badan butuh ini.",
            "Tubuh kita butuh ini. Jangan ditunda-tunda.",
            "Udah jam segini, saatnya minum {$jenis} nih.",
            "Jangan sampai lupa ya. Kesehatan nomor satu.",
            "Waktunya jagain kesehatan. Ayo minum {$jenisShort}!",
            "Sebentar aja kok, minum {$jenis} terus lanjut aktivitas.",
            "Yuk, luangin waktu sebentar buat minum {$jenis}.",
            "Jangan dilewatin ya. Ini penting banget.",
            "Udah siap belum? Waktunya minum {$jenis} nih.",
            "Ingat pesan dokter? Waktunya minum {$jenis}.",
            "Sebentar lagi waktunya. Jangan lupa ya!",
            "Tubuh kita udah kerja keras. Kasih yang terbaik dong.",
            "Halo! Sudah siap minum {$jenis} belum?",
            "Reminder nih, jangan lupa konsumsinya.",
            "Hai, waktunya rutin minum {$jenis} lagi.",
            "Ding dong! Alarm kesehatan berbunyi.",
            "Psst, ini pengingat penting buat kesehatan.",
            "Cek jam deh, udah waktunya nih.",
            "Hei, jangan sampai terlewat ya jadwalnya.",
            "Yuk konsisten, minum {$jenis} tepat waktu.",
            "Badan lagi nunggu asupannya nih.",
            "Alarm kesehatan berbunyi! Waktunya minum {$jenis}.",
            "Jangan ditunda lagi, langsung minum aja.",
            "Kesehatan prioritas, yuk minum {$jenisShort}nya.",
            "Sudah waktunya, jangan lupa ya.",
            "Rutinitas sehat dimulai dari sekarang.",
            "Tepat waktu itu penting, terutama untuk kesehatan.",
            "Yuk jaga konsistensi minum {$jenisShort}nya.",
            "Badan butuh asupan rutin, jangan lupa ya.",
            "Sekarang waktunya, minum {$jenis} dulu.",
            "Pengingat ramah: sudah waktunya nih.",
            "Halo sehat! Waktunya konsumsi rutin.",
            "Jangan sampai lupa, ini penting banget.",
            "Yuk disiplin, sesuai jadwal ya.",
            "Badan udah ngasih tanda, waktunya nih.",
            "Sebentar doang kok, terus lanjut aktivitas.",
            "Kesehatan nomor satu, jangan diabaikan.",
            "Sudah jam segini, saatnya minum {$jenis}.",
            "Yuk rutin, biar badan selalu sehat.",
            "Jangan ditunda, langsung minum sekarang.",
            "Waktunya datang, jangan sampai terlewat.",
            "Hei, sudah siap belum?",
            "Reminder penting: jangan lupa rutin ya.",
            "Yuk konsisten, demi kesehatan yang lebih baik.",
            "Badan lagi butuh, jangan diabaikan ya.",
            "Sekarang waktunya, ayo minum {$jenis}.",
            "Jangan lupa ya, ini untuk kebaikan sendiri.",
            "Sudah waktunya, yuk langsung aja.",
            "Kesehatan investasi terbaik, jaga terus.",
            "Waktunya tiba, jangan sampai kelewatan.",
            "Yuk disiplin, tepat waktu ya."
        ];
        
        $pesanMotivasi = $motivasi[array_rand($motivasi)];
        
        // Format waktu dengan bold
        $waktuBold = "*" . substr($waktuMinum, 0, 5) . "*";
        
        // Variasi format pesan untuk menghindari deteksi spam
        $formatVariasi = [
            "{$namaLengkap}\n{$waktuBold}\n\n{$pesanMotivasi}\n\n— Klik Farmasi",
            "{$namaLengkap}\n{$waktuBold}\n\n{$pesanMotivasi}\n\nSalam sehat, Klik Farmasi",
            "{$namaLengkap}\n{$waktuBold}\n\n{$pesanMotivasi}\n\n~ Klik Farmasi ~",
            "{$namaLengkap}\n{$waktuBold}\n\n{$pesanMotivasi}\n\nKlik Farmasi",
            "{$namaLengkap}\n{$waktuBold}\n\n{$pesanMotivasi}\n\nTerima kasih,\nKlik Farmasi"
        ];
        
        $pesan = $formatVariasi[array_rand($formatVariasi)];
        
        return $pesan;
    }

    public function buatPesanReminderArtikel($judulArtikel, $linkArtikel)
    {
        $hooks = [
            "Hai! Jangan lupa baca artikel kesehatan hari ini ya!",
            "Yuk, tingkatkan pengetahuan tentang hipertensi!",
            "Ada artikel menarik nih, jangan sampai terlewat!",
            "Baca artikel ini buat jaga kesehatan kamu!",
            "Artikel baru menanti! Yuk dibaca!",
            "Luangkan waktu sebentar untuk baca artikel ini ya!",
            "Pengetahuan adalah kunci kesehatan. Yuk baca!",
            "Artikel kesehatan spesial buat kamu!",
            "Jangan lewatkan artikel penting ini!",
            "Yuk update pengetahuan kesehatan kamu!",
            "Artikel ini bisa bantu kamu lebih sehat!",
            "Sempatkan baca artikel ini ya!",
        ];
        
        $hook = $hooks[array_rand($hooks)];
        
        $formatVariasi = [
            "{$hook}\n\n*{$judulArtikel}*\n\n{$linkArtikel}\n\n— Klik Farmasi",
            "{$hook}\n\n*{$judulArtikel}*\n\n{$linkArtikel}\n\nSalam sehat, Klik Farmasi",
            "{$hook}\n\n*{$judulArtikel}*\n\n{$linkArtikel}\n\n~ Klik Farmasi ~",
            "{$hook}\n\n*{$judulArtikel}*\n\nBaca selengkapnya:\n{$linkArtikel}\n\nKlik Farmasi",
            "{$hook}\n\n*{$judulArtikel}*\n\n{$linkArtikel}\n\nTerima kasih,\nKlik Farmasi"
        ];
        
        return $formatVariasi[array_rand($formatVariasi)];
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