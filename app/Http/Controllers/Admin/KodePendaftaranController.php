<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodePendaftaran;
use Illuminate\Http\Request;

class KodePendaftaranController extends Controller
{
    public function index()
    {
        $kodeList = KodePendaftaran::with(['pembuatKode', 'penggunaKode'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.kode-pendaftaran.index', compact('kodeList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_kode' => 'required|integer|min:1|max:50'
        ]);

        $kodeList = [];
        for ($i = 0; $i < $request->jumlah_kode; $i++) {
            $kodeList[] = [
                'kode' => KodePendaftaran::generateKode(),
                'status' => 'aktif',
                'dibuat_oleh' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        KodePendaftaran::insert($kodeList);

        return redirect()->route('admin.kode-pendaftaran.index')
            ->with('success', "Berhasil membuat {$request->jumlah_kode} kode pendaftaran baru");
    }

    public function updateStatus(Request $request, KodePendaftaran $kodePendaftaran)
    {
        $request->validate([
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $kodePendaftaran->update([
            'status' => $request->status
        ]);

        return redirect()->back()
            ->with('success', 'Status kode berhasil diperbarui');
    }
}