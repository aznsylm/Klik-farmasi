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
        // Cek dan drop kolom tanggal_input jika ada
        if (Schema::hasColumn('catatan_tekanan_darah', 'tanggal_input')) {
            // Drop constraints manually first
            try {
                DB::statement('ALTER TABLE catatan_tekanan_darah DROP INDEX catatan_tekanan_darah_user_id_tanggal_input_sumber_unique');
            } catch (\Exception $e) {
                // Ignore if not exists
            }
            
            try {
                DB::statement('ALTER TABLE catatan_tekanan_darah DROP INDEX catatan_tekanan_darah_user_id_tanggal_input_unique');
            } catch (\Exception $e) {
                // Ignore if not exists
            }
            
            // Now drop the column
            Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
                $table->dropColumn('tanggal_input');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            $table->date('tanggal_input')->nullable()->after('diastol');
        });
    }
};
