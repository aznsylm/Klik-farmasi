<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            // Drop unique constraint lama
            $table->dropUnique(['user_id', 'tanggal_input']);
            
            // Tambah unique constraint baru dengan sumber
            $table->unique(['user_id', 'tanggal_input', 'sumber']);
        });
    }

    public function down()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            // Drop unique constraint baru
            $table->dropUnique(['user_id', 'tanggal_input', 'sumber']);
            
            // Restore unique constraint lama
            $table->unique(['user_id', 'tanggal_input']);
        });
    }
};