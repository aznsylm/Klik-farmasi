<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'source', 'link', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime', // Konversi otomatis ke objek Carbon
    ];
}