<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing data: 'habis' dan 'dihentikan' -> 'tidak_aktif'
        DB::statement("UPDATE detail_obat SET status_obat = 'tidak_aktif' WHERE status_obat IN ('habis', 'dihentikan')");
        
        // Ubah ENUM: hapus 'habis' dan 'dihentikan', tambah 'tidak_aktif'
        DB::statement("ALTER TABLE detail_obat MODIFY COLUMN status_obat ENUM('aktif', 'tidak_aktif') NOT NULL DEFAULT 'aktif'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke ENUM lama
        DB::statement("ALTER TABLE detail_obat MODIFY COLUMN status_obat ENUM('aktif', 'habis', 'dihentikan') NOT NULL DEFAULT 'aktif'");
        
        // Kembalikan data: 'tidak_aktif' -> 'habis'
        DB::statement("UPDATE detail_obat SET status_obat = 'habis' WHERE status_obat = 'tidak_aktif'");
    }
};
