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
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('detail_obat_id')->constrained('detail_obat_pengingat')->onDelete('cascade');
            $table->date('tanggal_kirim');
            $table->time('waktu_kirim');
            $table->enum('status', ['sent', 'failed'])->default('sent');
            $table->text('response_message')->nullable();
            $table->timestamps();
            
            // Index untuk performa
            $table->index(['user_id', 'tanggal_kirim']);
            $table->index(['detail_obat_id', 'tanggal_kirim']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};