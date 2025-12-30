<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Update role column to only allow 'admin' and 'pasien'
        // Super admin will be managed separately via environment
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'pasien') DEFAULT 'pasien'");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Restore original enum with super_admin
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'admin', 'pasien') DEFAULT 'pasien'");
    }
};