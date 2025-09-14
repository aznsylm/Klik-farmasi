<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengingatObat;
use Illuminate\Http\Request;

class KeluhanPasienController extends Controller
{
    public function index()
    {
        $adminPuskesmas = auth()->user()->puskesmas_id;
        
        $keluhanPasien = PengingatObat::whereNotNull('catatan')
            ->whereHas('user', function($query) use ($adminPuskesmas) {
                $query->where('puskesmas_id', $adminPuskesmas);
            })
            ->with(['user', 'detailObat'])
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.keluhan-pasien.index', compact('keluhanPasien'));
    }

    public function show($id)
    {
        $adminPuskesmas = auth()->user()->puskesmas_id;
        
        $pengingat = PengingatObat::whereHas('user', function($query) use ($adminPuskesmas) {
                $query->where('puskesmas_id', $adminPuskesmas);
            })
            ->with(['user', 'detailObat'])
            ->findOrFail($id);

        return view('admin.keluhan-pasien.detail', compact('pengingat'));
    }
}