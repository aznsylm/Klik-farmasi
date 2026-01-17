<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'content',
        'author',
        'published_at',
        'image',
        'slug',
        'article_type',
        'views',
    ];

    protected $casts = [
        'published_at' => 'datetime', 
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function reads()
    {
        return $this->hasMany(ArticleRead::class);
    }

    // Get views count filtered by puskesmas for admin
    public function getViewsByPuskesmas($puskesmas = null)
    {
        if (!$puskesmas && Auth::check()) {
            $puskesmas = Auth::user()->puskesmas;
        }
        
        return $this->reads()
            ->whereHas('user', function($query) use ($puskesmas) {
                $query->where('puskesmas', $puskesmas)
                      ->where('role', 'pasien');
            })
            ->count();
    }

    // Get readers list filtered by puskesmas with access count
    public function getReadersByPuskesmas($puskesmas = null)
    {
        if (!$puskesmas && Auth::check()) {
            $puskesmas = Auth::user()->puskesmas;
        }
        
        return $this->reads()
            ->with('user')
            ->whereHas('user', function($query) use ($puskesmas) {
                $query->where('puskesmas', $puskesmas)
                      ->where('role', 'pasien');
            })
            ->orderBy('access_count', 'desc')
            ->get();
    }
}