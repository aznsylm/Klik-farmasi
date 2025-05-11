<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'summary',
        'content',
        'author',
        'published_at',
        'image',
    ];

    protected $casts = [
        'published_at' => 'datetime', // Konversi ke objek Carbon
    ];
}