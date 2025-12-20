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
    public function stopPengobatan($id)
    {
        $pengingat = PengingatObat::findOrFail($id);
        
        // Cek apakah user adalah admin
        if (!auth()->user() || !in_array(auth()->user()->role, ['admin', 'super_admin'])) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Update status pengingat
        $pengingat->update([
            'status' => 'tidak_aktif',
            'updated_at' => now()
        ]);
        
        $pasienName = $pengingat->user->name ?? 'Pasien';
        
        return redirect()->back()->with('success', "Pengobatan {$pasienName} telah dihentikan. Input tekanan darah otomatis dinonaktifkan.");
    }
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
            // Cek apakah sudah 91 hari
            $tanggalMulai = Carbon::parse($activePengingat->tanggal_mulai);
            $tanggalSelesai = $tanggalMulai->copy()->addDays(91);
            $today = Carbon::now();
            
            if ($today->gte($tanggalSelesai)) {
                // Sudah >= 91 hari - update status jadi selesai
                $activePengingat->update(['status' => 'selesai']);
                // Tampilkan form untuk pengingat baru
                return view('pages.pengingat');
            } else {
                // Masih dalam periode aktif - redirect ke dashboard
                $sisaHari = $today->diffInDays($tanggalSelesai);
                return redirect()->route('user.dashboard')
                    ->with('info', "Anda masih memiliki pengingat aktif. Sisa waktu: {$sisaHari} hari lagi.");
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
    
        return view('user.dashboard', compact(
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
            // Hitung sisa hari
            $tanggalMulai = \Carbon\Carbon::parse($activePengingat->tanggal_mulai);
            $tanggalSelesai = $tanggalMulai->copy()->addDays(91);
            $today = \Carbon\Carbon::now();
            
            if ($today->lt($tanggalSelesai)) {
                // Masih dalam periode aktif
                $sisaHari = $today->diffInDays($tanggalSelesai);
                return redirect()->route('user.dashboard')
                    ->with('error', "Anda masih memiliki pengingat aktif. Silakan tunggu {$sisaHari} hari lagi untuk membuat pengingat baru.");
            }
            
            // Jika sudah >= 91 hari, update status pengingat lama
            $activePengingat->update(['status' => 'selesai']);
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
            // Cek apakah sudah 91 hari
            $tanggalMulai = Carbon::parse($activePengingat->tanggal_mulai);
            $tanggalSelesai = $tanggalMulai->copy()->addDays(91);
            $today = Carbon::now();
            
            if ($today->gte($tanggalSelesai)) {
                // Sudah >= 91 hari - update status jadi selesai
                $activePengingat->update(['status' => 'selesai']);
            } else {
                // Masih aktif - tidak boleh buat baru
                return redirect()->back()
                    ->with('error', 'Anda masih memiliki pengingat aktif. Tidak dapat membuat pengingat baru.')
                    ->withInput();
            }
        }

        $isKehamilan = $request->diagnosa === 'Kehamilan';
        
        $rules = [
            'diagnosa' => 'required|in:Hipertensi-Non-Kehamilan,Hipertensi-Kehamilan,Kehamilan',
            'sistol' => 'required|integer|min:50|max:250',
            'diastol' => 'required|integer|min:50|max:150',
            'tanggal_mulai' => 'nullable|date|after_or_equal:today',
            'catatan' => 'nullable|string|max:3000',
            'jumlahObat' => 'required|array',
            'waktuMinum' => 'required|array',
            'suplemen' => 'array',
        ];
        
        // Untuk non-kehamilan, namaObat wajib
        if (!$isKehamilan) {
            $rules['namaObat'] = 'required|array';
        }
        
        // Untuk kehamilan, suplemen wajib
        if ($isKehamilan) {
            $rules['suplemen'] = 'required|array';
        }
        
        $request->validate($rules);
        
        // Combine sistol and diastol
        $request->merge([
            'tekananDarah' => $request->sistol . '/' . $request->diastol
        ]);

        // Simpan ke pengingat_obat
        $pengingat = PengingatObat::create([
            'user_id' => auth()->id(),
            'diagnosa' => $request->diagnosa,
            'tekanan_darah' => $request->tekananDarah,
            'tanggal_mulai' => $request->tanggal_mulai ?: \Carbon\Carbon::tomorrow('Asia/Jakarta')->toDateString(),
            'catatan' => $request->catatan ?: '-',
            'status' => 'aktif',
        ]);

        // Simpan tekanan darah awal ke catatan_tekanan_darah
        try {
            $tanggalHariIni = Carbon::now('Asia/Jakarta')->toDateString();
            
            // Hapus data tekanan darah yang mungkin sudah ada di tanggal yang sama dengan sumber pengingat_awal
            $deleted = CatatanTekananDarah::where('user_id', auth()->id())
                ->where('tanggal_input', $tanggalHariIni)
                ->where('sumber', 'pengingat_awal')
                ->delete();
            
            \Log::info('Deleted existing pengingat_awal records:', [
                'user_id' => auth()->id(),
                'date' => $tanggalHariIni,
                'deleted_count' => $deleted
            ]);
            
            $bloodPressureData = CatatanTekananDarah::create([
                'user_id' => auth()->id(),
                'pengingat_obat_id' => $pengingat->id,
                'sistol' => $request->sistol,
                'diastol' => $request->diastol,
                'tanggal_input' => $tanggalHariIni,
                'waktu_input' => Carbon::now('Asia/Jakarta')->toTimeString(),
                'sumber' => 'pengingat_awal'
            ]);
            
            \Log::info('Successfully saved initial blood pressure:', [
                'user_id' => auth()->id(),
                'bp_id' => $bloodPressureData->id,
                'sistol' => $request->sistol,
                'diastol' => $request->diastol
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error saving initial blood pressure:', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => [
                    'sistol' => $request->sistol,
                    'diastol' => $request->diastol,
                    'tanggal_input' => $tanggalHariIni
                ]
            ]);
            // Continue execution - don't fail the whole process
        }

        // Simpan ke detail_obat_pengingat
        $isKehamilan = $request->diagnosa === 'Kehamilan';
        
        foreach ($request->jumlahObat as $i => $jumlahObat) {
            DetailObatPengingat::create([
                'pengingat_obat_id' => $pengingat->id,
                'nama_obat' => $isKehamilan ? 'Tidak ada' : $request->namaObat[$i],
                'jumlah_obat' => $jumlahObat,
                'waktu_minum' => $request->waktuMinum[$i],
                'suplemen' => !empty($request->suplemen[$i]) ? $request->suplemen[$i] : '-',
                'urutan' => $i + 1,
                'status_obat' => 'aktif',
            ]);
        }

        return redirect()->route('user.dashboard')->with('success', 'Pengingat berhasil disimpan! Anda akan mendapat notifikasi WhatsApp mulai besok.');
    }
}
