<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use App\Models\News;
use App\Models\Faq;
use App\Models\Download;

class CleanDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dummy:clean {--articles : Clean dummy articles} {--news : Clean dummy news} {--faqs : Clean dummy FAQs} {--downloads : Clean dummy downloads}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean dummy data from database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('articles')) {
            $count = Article::count();
            if ($this->confirm("Are you sure you want to delete all {$count} articles?")) {
                Article::truncate();
                $this->info('All articles have been deleted.');
            }
        } elseif ($this->option('news')) {
            $count = News::count();
            if ($this->confirm("Are you sure you want to delete all {$count} news items?")) {
                News::truncate();
                $this->info('All news have been deleted.');
            }
        } elseif ($this->option('faqs')) {
            $count = Faq::count();
            if ($this->confirm("Are you sure you want to delete all {$count} FAQ items?")) {
                Faq::truncate();
                $this->info('All FAQs have been deleted.');
            }
        } elseif ($this->option('downloads')) {
            $count = Download::count();
            if ($this->confirm("Are you sure you want to delete all {$count} download items?")) {
                Download::truncate();
                $this->info('All downloads have been deleted.');
            }
        } else {
            $this->info('Available options:');
            $this->info('--articles  : Clean dummy articles');
            $this->info('--news      : Clean dummy news');
            $this->info('--faqs      : Clean dummy FAQs');
            $this->info('--downloads : Clean dummy downloads');
            $this->info('Example: php artisan dummy:clean --downloads');
        }
    }
}
