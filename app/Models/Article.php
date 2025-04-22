<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    // Menentukan tabel yang digunakan (opsional jika nama tabel sesuai konvensi)
    protected $table = 'articles';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'category',
        'title',
        'summary',
        'link',
    ];
}