<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah kolom jenis_pesan dari ENUM ke VARCHAR(50)
        DB::statement("ALTER TABLE whatsapp_logs MODIFY COLUMN jenis_pesan VARCHAR(50) NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke ENUM jika perlu rollback
        DB::statement("ALTER TABLE whatsapp_logs MODIFY COLUMN jenis_pesan ENUM('pengingat_obat') NOT NULL");
    }
};
