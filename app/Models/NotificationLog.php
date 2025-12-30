<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationLog extends Model
{
    protected $fillable = [
        'user_id',
        'detail_obat_id', 
        'status',
        'response_message'
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