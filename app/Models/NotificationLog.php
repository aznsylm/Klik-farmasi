<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $fillable = [
        'user_id',
        'detail_obat_id', 
        'tanggal_kirim',
        'waktu_kirim',
        'status',
        'response_message'
    ];

    protected $casts = [
        'tanggal_kirim' => 'date',
        'waktu_kirim' => 'datetime:H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailObat()
    {
        return $this->belongsTo(DetailObatPengingat::class, 'detail_obat_id');
    }
}