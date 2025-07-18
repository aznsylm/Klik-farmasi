<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailObatPengingat extends Model
{
    protected $table = 'detail_obat_pengingat';
    protected $guarded = [];

    public function pengingatObat()
    {
        return $this->belongsTo(PengingatObat::class, 'pengingat_obat_id');
    }
}
