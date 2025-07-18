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
        Schema::create('detail_obat_pengingat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengingat_obat_id')->constrained('pengingat_obat')->onDelete('cascade');
            $table->string('nama_obat');
            $table->string('jumlah_obat');
            $table->time('waktu_minum');
            $table->string('suplemen')->nullable();
            $table->integer('urutan')->default(1);
            $table->enum('status_obat', ['aktif', 'habis', 'dihentikan'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_obat_pengingat');
    }
};
