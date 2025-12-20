<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengingatObat;
use Illuminate\Http\Request;

class KeluhanPasienController extends Controller
{
    public function index()
    {
        $adminPuskesmas = auth()->user()->puskesmas;
        
        // Catatan system removed - return empty paginated collection
        $keluhanPasien = new \Illuminate\Pagination\LengthAwarePaginator(
            collect(),
            0,
            10,
            1,
            ['path' => request()->url()]
        );

        return view('admin.keluhan-pasien.index', compact('keluhanPasien'));
    }

    public function show($id)
    {
        $adminPuskesmas = auth()->user()->puskesmas;
        
        $pengingat = PengingatObat::whereHas('user', function($query) use ($adminPuskesmas) {
                $query->where('puskesmas', $adminPuskesmas);
            })
            ->with(['user', 'detailObat'])
            ->findOrFail($id);

        return view('admin.keluhan-pasien.detail', compact('pengingat'));
    }
}