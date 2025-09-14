<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogWhatsapp extends Model
{
    protected $table = 'log_whatsapp';

    protected $fillable = [
        'user_id',
        'pesan',
        'jenis_pesan',
        'status',
        'response_api',
        'dikirim_pada'
    ];

    protected $casts = [
        'dikirim_pada' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeTerkirim($query)
    {
        return $query->where('status', 'terkirim');
    }

    public function scopePengingatObat($query)
    {
        return $query->where('jenis_pesan', 'pengingat_obat');
    }
}