<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Create new whatsapp_logs table
        Schema::create('whatsapp_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('detail_obat_id')->nullable()->constrained('detail_obat')->onDelete('cascade');
            $table->enum('jenis_pesan', ['pengingat_obat', 'reminder_tekanan_darah', 'lainnya'])->default('pengingat_obat');
            $table->text('pesan');
            $table->enum('status', ['sent', 'failed'])->default('sent');
            $table->text('response_message')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'jenis_pesan']);
            $table->index(['detail_obat_id', 'created_at']);
        });

        // Migrate data from notification_logs
        if (Schema::hasTable('notification_logs')) {
            DB::statement("
                INSERT INTO whatsapp_logs (user_id, detail_obat_id, jenis_pesan, pesan, status, response_message, created_at, updated_at)
                SELECT user_id, detail_obat_id, 'pengingat_obat', 'Pengingat minum obat', status, response_message, created_at, updated_at
                FROM notification_logs
            ");
        }

        // Migrate data from log_whatsapp
        if (Schema::hasTable('log_whatsapp')) {
            DB::statement("
                INSERT INTO whatsapp_logs (user_id, detail_obat_id, jenis_pesan, pesan, status, response_message, created_at, updated_at)
                SELECT user_id, NULL, jenis_pesan, pesan, 
                       CASE WHEN status = 'terkirim' THEN 'sent' ELSE 'failed' END,
                       response_api, created_at, updated_at
                FROM log_whatsapp
            ");
        }

        // Drop old tables
        Schema::dropIfExists('notification_logs');
        Schema::dropIfExists('log_whatsapp');
    }

    public function down()
    {
        // Recreate old tables
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('detail_obat_id')->constrained('detail_obat')->onDelete('cascade');
            $table->enum('status', ['sent', 'failed'])->default('sent');
            $table->text('response_message')->nullable();
            $table->timestamps();
        });

        Schema::create('log_whatsapp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('pesan');
            $table->enum('jenis_pesan', ['pengingat_obat', 'reminder_tekanan_darah', 'lainnya'])->default('pengingat_obat');
            $table->enum('status', ['pending', 'terkirim', 'gagal'])->default('pending');
            $table->text('response_api')->nullable();
            $table->timestamps();
        });

        Schema::dropIfExists('whatsapp_logs');
    }
};