<?php

namespace App\Http\Controllers;

use App\Models\CatatanAdminPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanAdminController extends Controller
{
    public function simpan(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'isi_catatan' => 'required|string'
        ]);

        CatatanAdminPasien::create([
            'user_id' => $request->user_id,
            'admin_id' => Auth::id(),
            'isi_catatan' => $request->isi_catatan
        ]);

        return redirect()->back()->with('success', 'Catatan berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'isi_catatan' => 'required|string'
        ]);

        $catatan = CatatanAdminPasien::findOrFail($id);
        $catatan->update([
            'isi_catatan' => $request->isi_catatan
        ]);

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui');
    }

    public function hapus($id)
    {
        $catatan = CatatanAdminPasien::findOrFail($id);
        $catatan->delete();

        return redirect()->back()->with('success', 'Catatan berhasil dihapus');
    }

    public function getCatatanPasien()
    {
        $catatan = CatatanAdminPasien::where('user_id', auth()->id())
            ->with('admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($catatan);
    }

    public function tandaiSudahBaca($id)
    {
        $catatan = CatatanAdminPasien::findOrFail($id);
        $catatan->update(['status_baca' => 'sudah_dibaca']);

        return response()->json(['success' => true]);
    }
}