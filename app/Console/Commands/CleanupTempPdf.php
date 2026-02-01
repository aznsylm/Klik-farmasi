<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class CleanupTempPdf extends Command
{
    protected $signature = 'cleanup:temp-pdf';
    protected $description = 'Clean up temporary PDF files older than 24 hours';

    public function handle()
    {
        $tempDir = storage_path('app/temp/pdf');
        
        if (!is_dir($tempDir)) {
            $this->info('Temp PDF directory does not exist.');
            return;
        }

        $files = glob($tempDir . '/*.pdf');
        $deletedCount = 0;
        $cutoffTime = Carbon::now()->subDay(); // 24 hours ago

        foreach ($files as $file) {
            $fileTime = Carbon::createFromTimestamp(filemtime($file));
            
            if ($fileTime->lt($cutoffTime)) {
                unlink($file);
                $deletedCount++;
            }
        }

        $this->info("Cleaned up {$deletedCount} temporary PDF files.");
    }
}