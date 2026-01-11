<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengingatObat extends Model
{
    protected $table = 'pengingat_obat';
    protected $fillable = [
        'user_id',
        'tekanan_darah',
        'tanggal_mulai',
        'status', 
    ];

    public function detailObat()
    {
        return $this->hasMany(DetailObatPengingat::class, 'pengingat_obat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function catatanTekananDarah()
    {
        return $this->hasMany(CatatanTekananDarah::class, 'pengingat_obat_id');
    }
}
