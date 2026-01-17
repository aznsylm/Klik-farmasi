<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadRead extends Model
{
    use HasFactory;

    protected $fillable = [
        'download_id',
        'user_id',
        'access_count'
    ];

    protected $casts = [
        // no additional casts needed
    ];

    public function download()
    {
        return $this->belongsTo(Download::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}