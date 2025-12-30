<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('log_whatsapp', function (Blueprint $table) {
            $table->dropColumn('dikirim_pada');
        });
    }

    public function down()
    {
        Schema::table('log_whatsapp', function (Blueprint $table) {
            $table->timestamp('dikirim_pada')->nullable()->after('response_api');
        });
    }
};