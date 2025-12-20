<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use \App\Traits\UseWIBTimezone;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nomor_hp',
        'jenis_kelamin',
        'usia',
        'role',
        'puskesmas',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke tabel baru
    public function pengingatObat(): HasMany
    {
        return $this->hasMany(PengingatObat::class);
    }

    public function catatanTekananDarah(): HasMany
    {
        return $this->hasMany(CatatanTekananDarah::class);
    }

    public function logWhatsapp(): HasMany
    {
        return $this->hasMany(LogWhatsapp::class);
    }

    public function kodePendaftaranDibuat(): HasMany
    {
        return $this->hasMany(KodePendaftaran::class, 'dibuat_oleh');
    }

    public function kodePendaftaranDigunakan(): HasMany
    {
        return $this->hasMany(KodePendaftaran::class, 'digunakan_oleh');
    }


}
