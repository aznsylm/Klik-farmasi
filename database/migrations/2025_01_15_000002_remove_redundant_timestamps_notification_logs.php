<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('notification_logs', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kirim', 'waktu_kirim']);
        });
    }

    public function down()
    {
        Schema::table('notification_logs', function (Blueprint $table) {
            $table->date('tanggal_kirim')->after('detail_obat_id');
            $table->time('waktu_kirim')->after('tanggal_kirim');
        });
    }
};