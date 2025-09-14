<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanAdminPasien extends Model
{
    use HasFactory;

    protected $table = 'catatan_admin_pasien';

    protected $fillable = [
        'user_id',
        'admin_id', 
        'isi_catatan',
        'status_baca'
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}