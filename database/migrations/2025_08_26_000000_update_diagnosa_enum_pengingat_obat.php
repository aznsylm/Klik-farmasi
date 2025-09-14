<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE pengingat_obat MODIFY COLUMN diagnosa ENUM('Hipertensi-Non-Kehamilan', 'Hipertensi-Kehamilan', 'Kehamilan')");
    }

    public function down()
    {
        DB::statement("ALTER TABLE pengingat_obat MODIFY COLUMN diagnosa ENUM('Hipertensi-Non-Kehamilan', 'Hipertensi-Kehamilan')");
    }
};