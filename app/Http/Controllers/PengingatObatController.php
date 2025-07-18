<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengingatObat;
use Illuminate\Routing\Controller;
use App\Models\DetailObatPengingat;

class PengingatObatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pengingatList = PengingatObat::with('detailObat')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();
    
        // Ambil pengingat terbaru
        $latestPengingat = $pengingatList->first();

        // Siapkan pengingat obat hari ini
        $obatHariIni = collect();
        $totalObatHariIni = 0;
        $obatDiminum = 0;

        if ($latestPengingat) {
            // Set collection obat hari ini
            $obatHariIni = $latestPengingat->detailObat
                ->where('status_obat', 'aktif')
                ->sortBy('waktu_minum');

            // Hitung total dan yang sudah diminum
            $totalObatHariIni = $latestPengingat->detailObat->count();
            $obatDiminum = $latestPengingat->detailObat
                ->where('status_obat', 'aktif')
                ->count();
        }
    
        return view('user.dashboard', compact(
            'user', 
            'pengingatList',
            'latestPengingat',
            'obatHariIni',
            'totalObatHariIni',
            'obatDiminum'
        ));
    }

    public function create()
    {
        $user = auth()->user();
        
        // Cek pengingat aktif
        $activePengingat = PengingatObat::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->first();

        if ($activePengingat) {
            // Hitung sisa hari
            $tanggalMulai = \Carbon\Carbon::parse($activePengingat->tanggal_mulai);
            $tanggalSelesai = $tanggalMulai->copy()->addDays(30);
            $today = \Carbon\Carbon::now();
            
            if ($today->lt($tanggalSelesai)) {
                // Masih dalam periode aktif
                $sisaHari = $today->diffInDays($tanggalSelesai);
                return redirect()->route('user.dashboard')
                    ->with('error', "Anda masih memiliki pengingat aktif. Silakan tunggu {$sisaHari} hari lagi untuk membuat pengingat baru.");
            }
            
            // Jika sudah lewat 30 hari, update status pengingat lama
            $activePengingat->update(['status' => 'selesai']);
        }

        return view('pages.pengingat');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
    
        // Cek apakah user memiliki pengingat aktif
        $hasActivePengingat = PengingatObat::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->exists();
    
        if ($hasActivePengingat) {
            return redirect()->back()
                ->with('error', 'Anda masih memiliki pengingat aktif. Tidak dapat membuat pengingat baru.')
                ->withInput();
        }

        $request->validate([
            'diagnosa' => 'required',
            'tekananDarah' => 'required',
            'tanggal_mulai' => 'required|date',
            'catatan' => 'nullable',
            'namaObat' => 'required|array',
            'jumlahObat' => 'required|array',
            'waktuMinum' => 'required|array',
            'suplemen' => 'array',
        ]);

        // Simpan ke pengingat_obat
        $pengingat = PengingatObat::create([
            'user_id' => auth()->id(),
            'diagnosa' => $request->diagnosa,
            'tekanan_darah' => $request->tekananDarah,
            'tanggal_mulai' => $request->tanggal_mulai,
            'catatan' => $request->catatan,
            'status' => 'aktif',
        ]);

        // Simpan ke detail_obat_pengingat
        foreach ($request->namaObat as $i => $namaObat) {
            DetailObatPengingat::create([
                'pengingat_obat_id' => $pengingat->id,
                'nama_obat' => $namaObat,
                'jumlah_obat' => $request->jumlahObat[$i],
                'waktu_minum' => $request->waktuMinum[$i],
                'suplemen' => $request->suplemen[$i] ?? null,
                'urutan' => $i + 1,
                'status_obat' => 'aktif',
            ]);
        }

        return redirect()->back()->with('success', 'Pengingat berhasil disimpan!');
    }
}
