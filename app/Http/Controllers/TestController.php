<?php

namespace App\Http\Controllers;

use App\Services\FontteWhatsAppService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testWhatsApp()
    {
        $waService = new FontteWhatsAppService();
        
        // Test 1: Pesan sederhana
        $result1 = $waService->kirimPesan('082255693035', 'Halo! Test dari Klik Farmasi 🚀');
        
        // Test 2: Template pengingat obat
        $pesan2 = $waService->buatPesanPengingatObat('Budi', 'Amlodipine 5mg', '1 tablet', 'Pagi');
        $result2 = $waService->kirimPesan('082255693035', $pesan2);
        
        // Test 3: Template reminder tekanan darah
        $pesan3 = $waService->buatPesanReminderTekananDarah('Budi');
        $result3 = $waService->kirimPesan('082255693035', $pesan3);
        
        return response()->json([
            'message' => 'Testing WhatsApp Service Complete',
            'results' => [
                'test_simple_message' => $result1,
                'test_medicine_reminder' => $result2,
                'test_blood_pressure_reminder' => $result3
            ]
        ]);
    public function testPengingat()
    {
        // Jalankan command pengingat secara manual
        \Artisan::call('pengingat:kirim-obat');
        
        $output = \Artisan::output();
        
        return response()->json([
            'message' => 'Test pengingat selesai',
            'output' => $output,
            'timestamp' => now()->format('Y-m-d H:i:s')
        ]);
    }
}