<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_admin_pasien', function (Blueprint $table) {
            $table->dropColumn('judul');
        });
    }

    public function down()
    {
        Schema::table('catatan_admin_pasien', function (Blueprint $table) {
            $table->string('judul')->after('admin_id');
        });
    }
};