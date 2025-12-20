<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PengingatObat;
use App\Models\DetailObatPengingat;
use App\Models\CatatanTekananDarah;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Data dummy pasien
        $pasienData = [
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@test.com',
                'nomor_hp' => '628123456789',
                'jenis_kelamin' => 'Perempuan',
                'usia' => 35,
                'puskesmas' => 'kalasan',
                'td_data' => [
                    ['sistol' => 120, 'diastol' => 80], // Normal
                    ['sistol' => 125, 'diastol' => 82],
                    ['sistol' => 118, 'diastol' => 78]
                ]
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@test.com',
                'nomor_hp' => '628234567890',
                'jenis_kelamin' => 'Laki-laki',
                'usia' => 45,
                'puskesmas' => 'kalasan',
                'td_data' => [
                    ['sistol' => 150, 'diastol' => 95], // Tinggi
                    ['sistol' => 148, 'diastol' => 92],
                    ['sistol' => 152, 'diastol' => 96]
                ]
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi.sartika@test.com',
                'nomor_hp' => '628345678901',
                'jenis_kelamin' => 'Perempuan',
                'usia' => 28,
                'puskesmas' => 'kalasan',
                'td_data' => [
                    ['sistol' => 185, 'diastol' => 115], // Sangat Tinggi
                    ['sistol' => 180, 'diastol' => 110],
                    ['sistol' => 190, 'diastol' => 118]
                ]
            ],
            [
                'name' => 'Ahmad Wijaya',
                'email' => 'ahmad.wijaya@test.com',
                'nomor_hp' => '628456789012',
                'jenis_kelamin' => 'Laki-laki',
                'usia' => 52,
                'puskesmas' => 'kalasan',
                'td_data' => [
                    ['sistol' => 135, 'diastol' => 85], // Normal
                    ['sistol' => 130, 'diastol' => 82],
                    ['sistol' => 138, 'diastol' => 88]
                ]
            ],
            [
                'name' => 'Ratna Sari',
                'email' => 'ratna.sari@test.com',
                'nomor_hp' => '628567890123',
                'jenis_kelamin' => 'Perempuan',
                'usia' => 38,
                'puskesmas' => 'kalasan',
                'td_data' => [
                    ['sistol' => 165, 'diastol' => 100], // Tinggi
                    ['sistol' => 160, 'diastol' => 98],
                    ['sistol' => 168, 'diastol' => 102]
                ]
            ]
        ];

        foreach ($pasienData as $data) {
            // Buat user pasien
            $user = User::updateOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'nomor_hp' => $data['nomor_hp'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'usia' => $data['usia'],
                    'password' => Hash::make('password123'),
                    'role' => 'pasien',
                    'puskesmas' => $data['puskesmas']
                ]
            );

            // Buat pengingat obat
            $pengingat = PengingatObat::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'diagnosa' => 'Hipertensi-Non-Kehamilan',
                    'tekanan_darah' => $data['td_data'][0]['sistol'] . '/' . $data['td_data'][0]['diastol'],
                    'tanggal_mulai' => now()->format('Y-m-d'),
                    'status' => 'aktif'
                ]
            );

            // Buat detail obat
            DetailObatPengingat::create([
                'pengingat_obat_id' => $pengingat->id,
                'nama_obat' => 'Amlodipine 5mg',
                'jumlah_obat' => 1,
                'waktu_minum' => '08:00',
                'urutan' => 1,
                'status_obat' => 'aktif'
            ]);

            DetailObatPengingat::create([
                'pengingat_obat_id' => $pengingat->id,
                'nama_obat' => 'Captopril 25mg',
                'jumlah_obat' => 1,
                'waktu_minum' => '20:00',
                'urutan' => 2,
                'status_obat' => 'aktif'
            ]);

            // Buat catatan tekanan darah
            foreach ($data['td_data'] as $index => $td) {
                $tanggal = now()->subDays(2 - $index)->format('Y-m-d');
                CatatanTekananDarah::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'tanggal_input' => $tanggal,
                        'sumber' => 'input_harian'
                    ],
                    [
                        'pengingat_obat_id' => $pengingat->id,
                        'sistol' => $td['sistol'],
                        'diastol' => $td['diastol'],
                        'waktu_input' => now()->subDays(2 - $index)->format('H:i'),
                        'created_at' => now()->subDays(2 - $index),
                        'updated_at' => now()->subDays(2 - $index)
                    ]
                );
            }
        }
    }
}