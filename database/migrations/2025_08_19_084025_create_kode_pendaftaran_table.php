<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kode_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique();
            $table->enum('status', ['aktif', 'terpakai', 'nonaktif'])->default('aktif');
            $table->unsignedBigInteger('dibuat_oleh');
            $table->unsignedBigInteger('digunakan_oleh')->nullable();
            $table->timestamp('digunakan_pada')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('digunakan_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kode_pendaftaran');
    }
};