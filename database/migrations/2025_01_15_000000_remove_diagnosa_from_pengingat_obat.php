<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengingat_obat', function (Blueprint $table) {
            $table->dropColumn('diagnosa');
        });
    }

    public function down()
    {
        Schema::table('pengingat_obat', function (Blueprint $table) {
            $table->enum('diagnosa', ['Hipertensi-Non-Kehamilan', 'Hipertensi-Kehamilan', 'Kehamilan'])->after('user_id');
        });
    }
};