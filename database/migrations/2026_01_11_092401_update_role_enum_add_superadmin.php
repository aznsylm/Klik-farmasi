<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // First update any existing 'super_admin' to 'admin' temporarily
        DB::table('users')->where('role', 'super_admin')->update(['role' => 'admin']);
        
        // Then modify the ENUM
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('superadmin', 'admin', 'pasien') DEFAULT 'pasien'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'admin', 'pasien') DEFAULT 'pasien'");
    }
};