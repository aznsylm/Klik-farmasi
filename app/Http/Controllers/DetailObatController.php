<?php

namespace App\Http\Controllers;

use App\Models\DetailObatPengingat;
use App\Models\PengingatObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailObatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pengingat_obat_id' => 'required|exists:pengingat_obat,id',
            'nama_obat' => 'required|string|max:255',
            'jumlah_obat' => 'required|string|max:100',
            'waktu_minum' => 'required',
            'suplemen' => 'nullable|string|max:255'
        ]);

        // Get next urutan
        $maxUrutan = DetailObatPengingat::where('pengingat_obat_id', $request->pengingat_obat_id)->max('urutan');
        
        $obat = DetailObatPengingat::create([
            'pengingat_obat_id' => $request->pengingat_obat_id,
            'nama_obat' => $request->nama_obat,
            'jumlah_obat' => $request->jumlah_obat,
            'waktu_minum' => $request->waktu_minum,
            'suplemen' => !empty($request->suplemen) ? $request->suplemen : '-',
            'urutan' => ($maxUrutan ?? 0) + 1,
            'status_obat' => 'aktif' // Default status aktif
        ]);

        // Auto-update pengingat status
        $pengingat = PengingatObat::find($request->pengingat_obat_id);
        $hasActiveObat = $pengingat->detailObat()->where('status_obat', 'aktif')->exists();
        $pengingat->update(['status' => $hasActiveObat ? 'aktif' : 'tidak_aktif']);

        return back()->with('obat_success', 'Obat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jumlah_obat' => 'required|string|max:100',
            'waktu_minum' => 'required',
            'suplemen' => 'nullable|string|max:255'
        ]);

        $obat = DetailObatPengingat::findOrFail($id);
        $data = $request->only(['nama_obat', 'jumlah_obat', 'waktu_minum']);
        $data['suplemen'] = !empty($request->suplemen) ? $request->suplemen : '-';
        $obat->update($data);

        // Auto-update pengingat status
        $pengingat = $obat->pengingatObat;
        $hasActiveObat = $pengingat->detailObat()->where('status_obat', 'aktif')->exists();
        $pengingat->update(['status' => $hasActiveObat ? 'aktif' : 'tidak_aktif']);

        return back()->with('obat_success', 'Obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = DetailObatPengingat::findOrFail($id);
        $pengingat = $obat->pengingatObat;
        $obat->delete();

        // Auto-update pengingat status after deletion
        $hasActiveObat = $pengingat->detailObat()->where('status_obat', 'aktif')->exists();
        $pengingat->update(['status' => $hasActiveObat ? 'aktif' : 'tidak_aktif']);

        return back()->with('obat_success', 'Obat berhasil dihapus!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:detail_obat,id',
            'status' => 'required|in:aktif,tidak_aktif'
        ]);

        $obat = DetailObatPengingat::with('pengingatObat')->findOrFail($request->obat_id);
        
        // Check if user owns this obat
        if ($obat->pengingatObat->user_id !== Auth::id()) {
            return back()->with('error', 'Tidak diizinkan mengubah data ini.');
        }

        $obat->update(['status_obat' => $request->status]);

        // Update pengingat status based on obat status
        $pengingat = $obat->pengingatObat;
        $hasActiveObat = $pengingat->detailObat()->where('status_obat', 'aktif')->exists();
        
        $newPengingatStatus = $hasActiveObat ? 'aktif' : 'tidak_aktif';
        $pengingat->update(['status' => $newPengingatStatus]);

        $statusText = $request->status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
        return back()->with('success', "Status obat berhasil diubah menjadi {$statusText}!");
    }

    public function adminUpdateStatus(Request $request)
    {
        $request->validate([
            'obat_id' => 'required|exists:detail_obat,id',
            'status' => 'required|in:aktif,tidak_aktif'
        ]);

        $obat = DetailObatPengingat::with('pengingatObat')->findOrFail($request->obat_id);
        $obat->update(['status_obat' => $request->status]);

        // Update pengingat status based on obat status
        $pengingat = $obat->pengingatObat;
        $hasActiveObat = $pengingat->detailObat()->where('status_obat', 'aktif')->exists();
        
        $newPengingatStatus = $hasActiveObat ? 'aktif' : 'tidak_aktif';
        $pengingat->update(['status' => $newPengingatStatus]);

        $statusText = $request->status === 'aktif' ? 'Aktif' : 'Tidak Aktif';
        return back()->with('success', "Status obat berhasil diubah menjadi {$statusText}!");
    }
}