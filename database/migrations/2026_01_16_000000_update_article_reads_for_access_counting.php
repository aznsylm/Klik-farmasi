<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('article_reads', function (Blueprint $table) {
            // Remove read_at column
            if (Schema::hasColumn('article_reads', 'read_at')) {
                $table->dropColumn('read_at');
            }
            
            // Add access_count column
            if (!Schema::hasColumn('article_reads', 'access_count')) {
                $table->unsignedInteger('access_count')->default(1)->after('user_id');
            }
        });
    }

    public function down()
    {
        Schema::table('article_reads', function (Blueprint $table) {
            // Remove access_count column
            if (Schema::hasColumn('article_reads', 'access_count')) {
                $table->dropColumn('access_count');
            }
            
            // Add back read_at column
            if (!Schema::hasColumn('article_reads', 'read_at')) {
                $table->timestamp('read_at')->useCurrent()->after('user_id');
            }
        });
    }
};