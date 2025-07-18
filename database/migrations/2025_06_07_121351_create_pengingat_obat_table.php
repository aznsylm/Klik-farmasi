<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengingat_obat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('diagnosa', ['Hipertensi-Non-Kehamilan', 'Hipertensi-Kehamilan']);
            $table->string('tekanan_darah');
            $table->enum('status', ['aktif', 'tidak_aktif', 'selesai'])->default('aktif');
            $table->date('tanggal_mulai');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengingat_obat');
    }
};
