<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            $table->enum('sumber', ['pengingat_awal', 'input_harian'])->default('input_harian')->after('waktu_input');
        });
    }

    public function down()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            $table->dropColumn('sumber');
        });
    }
};