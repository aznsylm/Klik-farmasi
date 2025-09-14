<?php

namespace App\Http\Controllers;

use App\Models\DetailObatPengingat;
use Illuminate\Http\Request;

class DetailObatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pengingat_obat_id' => 'required|exists:pengingat_obat,id',
            'nama_obat' => 'required|string|max:255',
            'jumlah_obat' => 'required|string|max:100',
            'waktu_minum' => 'required',
            'suplemen' => 'nullable|string|max:255',
            'status_obat' => 'required|in:aktif,habis,berhenti'
        ]);

        // Get next urutan
        $maxUrutan = DetailObatPengingat::where('pengingat_obat_id', $request->pengingat_obat_id)->max('urutan');
        
        DetailObatPengingat::create([
            'pengingat_obat_id' => $request->pengingat_obat_id,
            'nama_obat' => $request->nama_obat,
            'jumlah_obat' => $request->jumlah_obat,
            'waktu_minum' => $request->waktu_minum,
            'suplemen' => !empty($request->suplemen) ? $request->suplemen : '-',
            'urutan' => ($maxUrutan ?? 0) + 1,
            'status_obat' => $request->status_obat
        ]);

        return back()->with('obat_success', 'Obat berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jumlah_obat' => 'required|string|max:100',
            'waktu_minum' => 'required',
            'suplemen' => 'nullable|string|max:255',
            'status_obat' => 'required|in:aktif,habis,berhenti'
        ]);

        $obat = DetailObatPengingat::findOrFail($id);
        $data = $request->only(['nama_obat', 'jumlah_obat', 'waktu_minum', 'status_obat']);
        $data['suplemen'] = !empty($request->suplemen) ? $request->suplemen : '-';
        $obat->update($data);

        return back()->with('obat_success', 'Obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = DetailObatPengingat::findOrFail($id);
        $obat->delete();

        return back()->with('obat_success', 'Obat berhasil dihapus!');
    }
}