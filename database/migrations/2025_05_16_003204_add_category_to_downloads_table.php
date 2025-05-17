<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->enum('category', ['modul', 'flayer'])->default('modul')->after('file_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
