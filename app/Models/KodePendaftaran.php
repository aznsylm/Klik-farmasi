<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KodePendaftaran extends Model
{
    protected $table = 'kode_pendaftaran';

    protected $fillable = [
        'kode',
        'status',
        'dibuat_oleh',
        'digunakan_oleh'
    ];

    public function pembuatKode(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function penggunaKode(): BelongsTo
    {
        return $this->belongsTo(User::class, 'digunakan_oleh');
    }

    public static function generateKode(): string
    {
        do {
            $kode = 'KF-' . date('Y') . '-' . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
        } while (self::where('kode', $kode)->exists());

        return $kode;
    }
}