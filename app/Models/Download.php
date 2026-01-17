<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Download extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image', 'file_link'];

    public function reads()
    {
        return $this->hasMany(DownloadRead::class);
    }

    // Get views count filtered by puskesmas for admin
    public function getViewsByPuskesmas($puskesmas = null)
    {
        if (!$puskesmas && Auth::check()) {
            $puskesmas = Auth::user()->puskesmas;
        }
        
        return $this->reads()
            ->whereHas('user', function($query) use ($puskesmas) {
                $query->where('puskesmas', $puskesmas)
                      ->where('role', 'pasien');
            })
            ->count();
    }

    // Get readers list filtered by puskesmas with access count
    public function getReadersByPuskesmas($puskesmas = null)
    {
        if (!$puskesmas && Auth::check()) {
            $puskesmas = Auth::user()->puskesmas;
        }
        
        return $this->reads()
            ->with('user')
            ->whereHas('user', function($query) use ($puskesmas) {
                $query->where('puskesmas', $puskesmas)
                      ->where('role', 'pasien');
            })
            ->orderBy('access_count', 'desc')
            ->get();
    }
}