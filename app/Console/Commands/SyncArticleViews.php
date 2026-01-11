<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;

class SyncArticleViews extends Command
{
    protected $signature = 'articles:sync-views';
    protected $description = 'Sync article views with new tracking system';

    public function handle()
    {
        $this->info('Syncing article views...');
        
        Article::chunk(100, function ($articles) {
            foreach ($articles as $article) {
                // Reset views to 0 for fresh start with new tracking
                $article->update(['views' => 0]);
            }
        });
        
        $this->info('Article views synced successfully!');
        return 0;
    }
}