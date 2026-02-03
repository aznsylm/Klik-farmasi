<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanTekananDarah extends Model
{
    use HasFactory;

    protected $table = 'catatan_tekanan_darah';

    protected $fillable = [
        'user_id',
        'pengingat_obat_id',
        'sistol',
        'diastol',
        'catatan',
        'sumber'
    ];

    protected $casts = [
        'sistol' => 'integer',
        'diastol' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengingatObat()
    {
        return $this->belongsTo(PengingatObat::class);
    }

    public function getStatusAttribute()
    {
        if ($this->sistol < 120 && $this->diastol < 80) {
            return ['status' => 'Normal', 'color' => 'success'];
        } elseif ($this->sistol < 140 && $this->diastol < 90) {
            return ['status' => 'Pre-Hipertensi', 'color' => 'warning'];
        } else {
            return ['status' => 'Hipertensi', 'color' => 'danger'];
        }
    }
}