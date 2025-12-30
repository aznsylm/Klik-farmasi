<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kode_pendaftaran', function (Blueprint $table) {
            if (Schema::hasColumn('kode_pendaftaran', 'catatan')) {
                $table->dropColumn('catatan');
            }
            if (Schema::hasColumn('kode_pendaftaran', 'digunakan_pada')) {
                $table->dropColumn('digunakan_pada');
            }
        });
    }

    public function down()
    {
        Schema::table('kode_pendaftaran', function (Blueprint $table) {
            $table->text('catatan')->nullable()->after('digunakan_oleh');
            $table->timestamp('digunakan_pada')->nullable()->after('catatan');
        });
    }
};