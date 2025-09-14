<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Update enum values untuk kolom sumber
        DB::statement("ALTER TABLE catatan_tekanan_darah MODIFY COLUMN sumber ENUM('pengingat_awal', 'input_harian', 'admin_input', 'admin_edit') DEFAULT 'input_harian'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE catatan_tekanan_darah MODIFY COLUMN sumber ENUM('pengingat_awal', 'input_harian') DEFAULT 'input_harian'");
    }
};