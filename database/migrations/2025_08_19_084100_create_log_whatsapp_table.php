<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_whatsapp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('pesan');
            $table->enum('jenis_pesan', ['pengingat_obat', 'reminder_tekanan_darah', 'lainnya'])->default('pengingat_obat');
            $table->enum('status', ['pending', 'terkirim', 'gagal'])->default('pending');
            $table->text('response_api')->nullable();
            $table->timestamp('dikirim_pada')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_whatsapp');
    }
};