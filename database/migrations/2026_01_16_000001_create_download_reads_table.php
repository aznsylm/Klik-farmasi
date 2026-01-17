<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('download_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('download_id')->constrained('downloads')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedInteger('access_count')->default(1);
            $table->timestamps();
            
            // Prevent duplicate reads per user per download
            $table->unique(['download_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('download_reads');
    }
};