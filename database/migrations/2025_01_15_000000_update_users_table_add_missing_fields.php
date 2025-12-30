<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nomor_hp')) {
                $table->string('nomor_hp')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'usia')) {
                $table->integer('usia')->nullable()->after('nomor_hp');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nomor_hp')) {
                $table->dropColumn('nomor_hp');
            }
            if (Schema::hasColumn('users', 'usia')) {
                $table->dropColumn('usia');
            }
        });
    }
};