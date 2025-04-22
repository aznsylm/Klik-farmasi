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
        Schema::table('news', function (Blueprint $table) {
            $table->datetime('published_at')->change();
        });
    }

    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('published_at')->change();
        });
    }
};
