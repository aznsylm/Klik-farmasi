<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengingatObat;
use Illuminate\Routing\Controller;
use App\Models\DetailObatPengingat;
use App\Models\CatatanTekananDarah;
use Carbon\Carbon;

class PengingatObatController extends Controller
{
    public function showForm()
    {
        // Jika user belum login (guest)
        if (!auth()->check()) {
            return view('pages.pengingat');
        }

        $user = auth()->user();
        
        // Jika bukan pasien (admin/super_admin) - hanya bisa lihat
        if ($user->role !== 'pasien') {
            return view('pages.pengingat', ['readOnly' => true]);
        }

        // Jika pasien - cek pengingat aktif
        $activePengingat = PengingatObat::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->first();

        if ($activePengingat) {
            // Cek apakah masih ada obat aktif
            $hasActiveObat = $activePengingat->detailObat()->where('status_obat', 'aktif')->exists();
            
            if ($hasActiveObat) {
                // Masih ada obat aktif - redirect ke dashboard
                return redirect()->route('pasien.dashboard')
                    ->with('info', 'Anda masih memiliki pengingat aktif. Ubah status obat menjadi tidak aktif untuk membuat pengingat baru.');
            } else {
                // Tidak ada obat aktif - update status pengingat jadi tidak_aktif
                $activePengingat->update(['status' => 'tidak_aktif']);
                // Tampilkan form untuk pengingat baru
                return view('pages.pengingat');
            }
        }

        // Pasien belum ada pengingat aktif - tampilkan form
        return view('pages.pengingat');
    }
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

        // Catatan system removed - set to 0
        $catatanBelumBaca = 0;
    
        return view('pasien.dashboard', compact(
            'user', 
            'pengingatList',
            'latestPengingat',
            'obatHariIni',
            'totalObatHariIni',
            'obatDiminum',
            'catatanBelumBaca'
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
            // Cek apakah masih ada obat aktif
            $hasActiveObat = $activePengingat->detailObat()->where('status_obat', 'aktif')->exists();
            
            if ($hasActiveObat) {
                // Masih ada obat aktif - tidak boleh buat pengingat baru
                return redirect()->route('pasien.dashboard')
                    ->with('error', 'Anda masih memiliki pengingat aktif. Ubah status obat menjadi tidak aktif untuk membuat pengingat baru.');
            } else {
                // Tidak ada obat aktif - update status pengingat jadi tidak_aktif
                $activePengingat->update(['status' => 'tidak_aktif']);
            }
        }

        return view('pages.pengingat');
    }

    public function store(Request $request)
    {
        // Validasi hanya pasien yang bisa simpan
        if (!auth()->check() || auth()->user()->role !== 'pasien') {
            return redirect()->route('login')
                ->with('error', 'Anda harus masuk sebagai pasien untuk menggunakan fitur ini. Silahkan Hubungi Admin');
        }

        $user = auth()->user();
    
        // Cek apakah user memiliki pengingat aktif
        $activePengingat = PengingatObat::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->first();
    
        if ($activePengingat) {
            // Cek apakah masih ada obat aktif
            $hasActiveObat = $activePengingat->detailObat()->where('status_obat', 'aktif')->exists();
            
            if ($hasActiveObat) {
                // Masih ada obat aktif - tidak boleh buat pengingat baru
                return redirect()->back()
                    ->with('error', 'Anda masih memiliki pengingat aktif. Ubah status obat menjadi tidak aktif untuk membuat pengingat baru.')
                    ->withInput();
            } else {
                // Tidak ada obat aktif - update status pengingat lama jadi tidak_aktif
                $activePengingat->update(['status' => 'tidak_aktif']);
            }
        }

        $rules = [
            'sistol' => 'required|integer|min:50|max:250',
            'diastol' => 'required|integer|min:50|max:150',
            'tanggal_mulai' => 'nullable|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:3000',
            'namaObat' => 'required|array|min:1|max:5',
            'jumlahObat' => 'required|array|min:1|max:5',
            'waktuMinum' => 'required|array|min:1|max:5',
            'suplemen' => 'nullable|array',
        ];
        
        $request->validate($rules);
        
        // Combine sistol and diastol
        $request->merge([
            'tekananDarah' => $request->sistol . '/' . $request->diastol
        ]);

        // Simpan ke pengingat_obat
        $pengingat = PengingatObat::create([
            'user_id' => auth()->id(),
            'tekanan_darah' => $request->tekananDarah,
            'tanggal_mulai' => $request->tanggal_mulai ?: \Carbon\Carbon::tomorrow('Asia/Jakarta')->toDateString(),
            'catatan' => $request->catatan ?: '-',
            'status' => 'aktif',
        ]);

        // Simpan tekanan darah awal ke catatan_tekanan_darah
        try {
            // Cek apakah sudah ada catatan hari ini dengan sumber pengingat_awal
            $today = Carbon::now('Asia/Jakarta')->toDateString();
            $existingRecord = CatatanTekananDarah::where('user_id', auth()->id())
                ->whereDate('created_at', $today)
                ->where('sumber', 'pengingat_awal')
                ->first();
            
            if ($existingRecord) {
                // Update existing record
                $existingRecord->update([
                    'pengingat_obat_id' => $pengingat->id,
                    'sistol' => $request->sistol,
                    'diastol' => $request->diastol,
                ]);
                \Log::info('Updated existing blood pressure record:', ['id' => $existingRecord->id]);
            } else {
                // Create new record
                $bloodPressureData = CatatanTekananDarah::create([
                    'user_id' => auth()->id(),
                    'pengingat_obat_id' => $pengingat->id,
                    'sistol' => $request->sistol,
                    'diastol' => $request->diastol,
                    'sumber' => 'pengingat_awal'
                ]);
                \Log::info('Created new blood pressure record:', ['id' => $bloodPressureData->id]);
            }
            
        } catch (\Exception $e) {
            \Log::error('Error saving initial blood pressure:', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'sistol' => $request->sistol,
                'diastol' => $request->diastol
            ]);
        }

        // Simpan ke detail_obat - Universal untuk semua jenis
        foreach ($request->namaObat as $i => $namaObat) {
            DetailObatPengingat::create([
                'pengingat_obat_id' => $pengingat->id,
                'nama_obat' => $namaObat,
                'jumlah_obat' => $request->jumlahObat[$i],
                'waktu_minum' => $request->waktuMinum[$i],
                'suplemen' => !empty($request->suplemen[$i]) ? $request->suplemen[$i] : '-',
                'urutan' => $i + 1,
                'status_obat' => 'aktif',
            ]);
        }

        return redirect()->route('pasien.dashboard')->with('success', 'Pengingat berhasil disimpan! Anda akan mendapat notifikasi WhatsApp mulai besok.');
    }
}
