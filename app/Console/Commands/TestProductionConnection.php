<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestProductionConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test-production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test connection to production database and analyze structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing production database connection...');
        
        try {
            $prodConnection = 'production_db';
            
            // Test connection
            $result = DB::connection($prodConnection)->select('SELECT 1 as test');
            $this->info('✅ Production database connection successful!');
            
            // Get table list
            $tables = DB::connection($prodConnection)->select('SHOW TABLES');
            $this->info('📋 Tables found: ' . count($tables));
            
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                $this->line("  - {$tableName}");
            }
            
            // Check users table structure
            $this->newLine();
            $this->info('📊 Users table structure:');
            $columns = DB::connection($prodConnection)->select('DESCRIBE users');
            foreach ($columns as $col) {
                $this->line("  {$col->Field}: {$col->Type}");
            }
            
            // Check pengingat_obat table structure  
            $this->newLine();
            $this->info('📊 Pengingat_obat table structure:');
            $columns = DB::connection($prodConnection)->select('DESCRIBE pengingat_obat');
            foreach ($columns as $col) {
                $this->line("  {$col->Field}: {$col->Type}");
            }
            
            // Count records
            $userCount = DB::connection($prodConnection)->table('users')->count();
            $pengingatCount = DB::connection($prodConnection)->table('pengingat_obat')->count();
            $detailCount = DB::connection($prodConnection)->table('detail_obat_pengingat')->count();
            
            $this->newLine();
            $this->info('📈 Record counts:');
            $this->line("  Users: {$userCount}");
            $this->line("  Pengingat Obat: {$pengingatCount}");  
            $this->line("  Detail Obat Pengingat: {$detailCount}");
            
            // Sample puskesmas_id values
            $puskesmasIds = DB::connection($prodConnection)
                ->table('users')
                ->select('puskesmas_id')
                ->distinct()
                ->pluck('puskesmas_id')
                ->filter()
                ->sort()
                ->values();
            
            $this->newLine();
            $this->info('🏥 Puskesmas IDs found: ' . $puskesmasIds->implode(', '));
            
            // Sample users with puskesmas_id
            $this->newLine();
            $this->info('👥 Sample users:');
            $sampleUsers = DB::connection($prodConnection)
                ->table('users')
                ->select('id', 'name', 'email', 'puskesmas_id')
                ->limit(5)
                ->get();
                
            foreach ($sampleUsers as $user) {
                $this->line("  ID {$user->id}: {$user->name} ({$user->email}) - Puskesmas ID: {$user->puskesmas_id}");
            }
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Connection failed: ' . $e->getMessage());
            return 1;
        }
    }
}
