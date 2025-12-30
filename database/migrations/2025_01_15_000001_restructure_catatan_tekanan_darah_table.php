<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            // Drop unique constraint first if exists
            try {
                $table->dropUnique(['user_id', 'tanggal_input', 'sumber']);
            } catch (Exception $e) {
                // Constraint might not exist, continue
            }
            
            // Drop old columns if exist
            if (Schema::hasColumn('catatan_tekanan_darah', 'tekanan_darah')) {
                $table->dropColumn('tekanan_darah');
            }
            if (Schema::hasColumn('catatan_tekanan_darah', 'tanggal_cek')) {
                $table->dropColumn('tanggal_cek');
            }
            if (Schema::hasColumn('catatan_tekanan_darah', 'tanggal_input')) {
                $table->dropColumn('tanggal_input');
            }
            if (Schema::hasColumn('catatan_tekanan_darah', 'waktu_input')) {
                $table->dropColumn('waktu_input');
            }
            
            // Add new columns if not exist
            if (!Schema::hasColumn('catatan_tekanan_darah', 'sistol')) {
                $table->integer('sistol')->after('pengingat_obat_id');
            }
            if (!Schema::hasColumn('catatan_tekanan_darah', 'diastol')) {
                $table->integer('diastol')->after('sistol');
            }
        });
    }

    public function down()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            $table->string('tekanan_darah', 10)->after('pengingat_obat_id');
            $table->date('tanggal_cek')->after('diastol');
            if (Schema::hasColumn('catatan_tekanan_darah', 'sistol')) {
                $table->dropColumn('sistol');
            }
            if (Schema::hasColumn('catatan_tekanan_darah', 'diastol')) {
                $table->dropColumn('diastol');
            }
        });
    }
};