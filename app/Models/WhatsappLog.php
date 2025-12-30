<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhatsappLog extends Model
{
    protected $fillable = [
        'user_id',
        'detail_obat_id',
        'jenis_pesan',
        'pesan',
        'status',
        'response_message'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detailObat(): BelongsTo
    {
        return $this->belongsTo(DetailObatPengingat::class, 'detail_obat_id');
    }

    public function scopeTerkirim($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopePengingatObat($query)
    {
        return $query->where('jenis_pesan', 'pengingat_obat');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}