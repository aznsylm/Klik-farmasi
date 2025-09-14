<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop tabel lama jika ada
        Schema::dropIfExists('catatan_tekanan_darah');
        
        // Buat tabel baru
        Schema::create('catatan_tekanan_darah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('sistol')->unsigned();
            $table->integer('diastol')->unsigned();
            $table->date('tanggal_input');
            $table->time('waktu_input');
            $table->timestamps();
            
            $table->unique(['user_id', 'tanggal_input']);
            $table->index(['user_id', 'tanggal_input']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('catatan_tekanan_darah');
    }
};