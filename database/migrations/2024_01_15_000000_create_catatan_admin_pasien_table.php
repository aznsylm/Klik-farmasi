<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('catatan_admin_pasien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->string('judul');
            $table->text('isi_catatan');
            $table->enum('status_baca', ['belum_dibaca', 'sudah_dibaca'])->default('belum_dibaca');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('catatan_admin_pasien');
    }
};