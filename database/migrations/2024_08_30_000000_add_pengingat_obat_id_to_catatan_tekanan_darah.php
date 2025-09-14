<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            $table->foreignId('pengingat_obat_id')->nullable()->after('user_id')
                  ->constrained('pengingat_obat')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('catatan_tekanan_darah', function (Blueprint $table) {
            $table->dropForeign(['pengingat_obat_id']);
            $table->dropColumn('pengingat_obat_id');
        });
    }
};
