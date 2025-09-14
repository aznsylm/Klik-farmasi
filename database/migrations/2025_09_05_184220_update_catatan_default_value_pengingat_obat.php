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
    public function up(): void
    {
        // Update existing null values to "-"
        DB::table('pengingat_obat')
            ->whereNull('catatan')
            ->update(['catatan' => '-']);
        
        // Change column type to string with default value "-"
        Schema::table('pengingat_obat', function (Blueprint $table) {
            $table->string('catatan', 3000)->default('-')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengingat_obat', function (Blueprint $table) {
            $table->text('catatan')->nullable()->change();
        });
        
        // Revert "-" values back to null
        DB::table('pengingat_obat')
            ->where('catatan', '-')
            ->update(['catatan' => null]);
    }
};