<?php

namespace App\Http\Controllers;

use App\Models\CatatanTekananDarah;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TekananDarahController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'sistol' => 'required|integer|min:50|max:250',
            'diastol' => 'required|integer|min:50|max:150'
        ]);

        // Get latest pengingat obat
        $latestPengingat = \App\Models\PengingatObat::where('user_id', auth()->id())
            ->latest()
            ->first();

        if (!$latestPengingat) {
            return response()->json([
                'success' => false,
                'message' => 'Belum ada pengingat obat yang diatur'
            ]);
        }

        // Check if pengingat is still active
        if ($latestPengingat->status !== 'aktif') {
            return response()->json([
                'success' => false,
                'message' => 'Pengingat obat sudah tidak aktif. Hubungi admin jika ada kendala.'
            ]);
        }

        // Check 91-day limit
        $daysSinceStart = Carbon::parse($latestPengingat->created_at)->diffInDays(Carbon::now('Asia/Jakarta'));
        if ($daysSinceStart >= 91) {
            return response()->json([
                'success' => false,
                'message' => 'Masa input tekanan darah sudah berakhir (91 hari). Hubungi admin jika ada kendala.'
            ]);
        }

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        
        // Check if already input today
        $existing = CatatanTekananDarah::where('user_id', auth()->id())
            ->where('tanggal_input', $today)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah menginput tekanan darah hari ini. Silakan coba lagi besok.'
            ]);
        }

        CatatanTekananDarah::create([
            'user_id' => auth()->id(),
            'pengingat_obat_id' => $latestPengingat->id,
            'sistol' => $request->sistol,
            'diastol' => $request->diastol,
            'tanggal_input' => $today,
            'waktu_input' => Carbon::now('Asia/Jakarta')->toTimeString(),
            'sumber' => 'input_harian'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data tekanan darah berhasil disimpan'
        ]);
    }

    public function getChartData()
    {
        try {
            // Ambil semua data tekanan darah user, urutkan berdasarkan tanggal
            $tekananDarah = CatatanTekananDarah::where('user_id', auth()->id())
                ->orderBy('tanggal_input', 'asc')
                ->get();

            // Siapkan data untuk chart
            $chartData = [
                'labels' => [],
                'sistol' => [],
                'diastol' => []
            ];

            // Jika ada data, format untuk chart
            foreach ($tekananDarah as $data) {
                $chartData['labels'][] = Carbon::parse($data->tanggal_input)->format('d M');
                $chartData['sistol'][] = (int) $data->sistol;
                $chartData['diastol'][] = (int) $data->diastol;
            }

            return response()->json($chartData);
            
        } catch (\Exception $e) {
            \Log::error('Error in getChartData:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'labels' => [],
                'sistol' => [],
                'diastol' => []
            ], 500);
        }
    }

    public function getAdminChartData($userId)
    {
        $user = User::findOrFail($userId);
        $pengingat = $user->pengingatObat()->latest()->first();
        
        if (!$pengingat) {
            return response()->json(['labels' => [], 'sistol' => [], 'diastol' => [], 'data' => []]);
        }
        
        $data = CatatanTekananDarah::where('user_id', $userId)
            ->where('pengingat_obat_id', $pengingat->id)
            ->orderBy('tanggal_input')
            ->get();
        
        $labels = [];
        $sistol = [];
        $diastol = [];
        $rawData = [];
        
        foreach ($data as $item) {
            $labels[] = Carbon::parse($item->tanggal_input)->format('d/m');
            $sistol[] = $item->sistol;
            $diastol[] = $item->diastol;
            $rawData[] = [
                'id' => $item->id,
                'tanggal' => $item->tanggal_input,
                'sistol' => $item->sistol,
                'diastol' => $item->diastol,
                'sumber' => $item->sumber
            ];
        }
        
        return response()->json([
            'labels' => $labels,
            'sistol' => $sistol,
            'diastol' => $diastol,
            'data' => $rawData
        ]);
    }

    public function adminStore(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'sistol' => 'required|integer|min:50|max:250',
                'diastol' => 'required|integer|min:50|max:150',
                'tanggal_input' => 'required|date'
            ]);

            $user = User::findOrFail($request->user_id);
            $pengingat = $user->pengingatObat()->latest()->first();
            
            if (!$pengingat) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pasien belum memiliki pengingat obat'
                ]);
            }

            CatatanTekananDarah::create([
                'user_id' => $request->user_id,
                'pengingat_obat_id' => $pengingat->id,
                'sistol' => $request->sistol,
                'diastol' => $request->diastol,
                'tanggal_input' => $request->tanggal_input,
                'waktu_input' => Carbon::now('Asia/Jakarta')->toTimeString(),
                'sumber' => 'admin_input'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data tekanan darah berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            \Log::error('Admin Store Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
        }
    }

    public function adminUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'sistol' => 'required|integer|min:50|max:250',
                'diastol' => 'required|integer|min:50|max:150'
            ]);

            $catatan = CatatanTekananDarah::findOrFail($id);
            $catatan->update([
                'sistol' => $request->sistol,
                'diastol' => $request->diastol,
                'sumber' => 'admin_edit'
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
        } catch (\Exception $e) {
            \Log::error('Admin Update Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengupdate data: ' . $e->getMessage()], 500);
        }
    }

    public function adminDelete($id)
    {
        try {
            $catatan = CatatanTekananDarah::findOrFail($id);
            $catatan->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            \Log::error('Admin Delete Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()], 500);
        }
    }

    public function generatePDFReport($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $pengingat = $user->pengingatObat()->latest()->first();
            
            if (!$pengingat) {
                return redirect()->back()->with('error', 'Tidak ada data pengingat obat');
            }
        
        $data = CatatanTekananDarah::where('user_id', $userId)
            ->where('pengingat_obat_id', $pengingat->id)
            ->orderBy('tanggal_input')
            ->get();
        
        $chartData = [];
        foreach ($data as $item) {
            $chartData[] = [
                'tanggal' => Carbon::parse($item->tanggal_input)->format('d/m/Y'),
                'sistol' => $item->sistol,
                'diastol' => $item->diastol,
                'sumber' => $item->sumber
            ];
        }
        
        $pdf = Pdf::loadView('admin.reports.tekanan-darah-pdf', [
            'user' => $user,
            'pengingat' => $pengingat,
            'chartData' => $chartData,
            'totalData' => $data->count(),
            'avgSistol' => $data->avg('sistol'),
            'avgDiastol' => $data->avg('diastol'),
            'generatedAt' => Carbon::now()->format('d M Y, H:i')
        ]);
        
            $filename = 'Laporan_Tekanan_Darah_' . $user->name . '_' . Carbon::now()->format('Y-m-d') . '.pdf';
            
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal generate PDF: ' . $e->getMessage());
        }
    }

    public function generateUserPDFReport()
    {
        $user = auth()->user();
        $pengingat = $user->pengingatObat()->with('detailObat')->latest()->first();
        
        $data = CatatanTekananDarah::where('user_id', $user->id)
            ->orderBy('tanggal_input')
            ->get();
        
        $chartData = [];
        foreach ($data as $item) {
            $chartData[] = [
                'tanggal' => Carbon::parse($item->tanggal_input)->format('d/m/Y'),
                'sistol' => $item->sistol,
                'diastol' => $item->diastol
            ];
        }
        
        $pdf = Pdf::loadView('admin.reports.tekanan-darah-pdf', [
            'user' => $user,
            'pengingat' => $pengingat,
            'chartData' => $chartData,
            'totalData' => $data->count(),
            'avgSistol' => $data->avg('sistol'),
            'avgDiastol' => $data->avg('diastol'),
            'generatedAt' => Carbon::now()->format('d M Y, H:i')
        ]);
        
        return $pdf->stream('Laporan_Tekanan_Darah_' . $user->name . '_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
    
    public function viewPDFPage($userId)
    {
        $user = User::findOrFail($userId);
        $pengingat = $user->pengingatObat()->latest()->first();
        
        $data = CatatanTekananDarah::where('user_id', $userId)
            ->where('pengingat_obat_id', $pengingat->id)
            ->orderBy('tanggal_input')
            ->get();
        
        $chartData = [];
        foreach ($data as $item) {
            $chartData[] = [
                'tanggal' => Carbon::parse($item->tanggal_input)->format('d/m/Y'),
                'sistol' => $item->sistol,
                'diastol' => $item->diastol,
                'sumber' => $item->sumber
            ];
        }
        
        $pdf = Pdf::loadView('admin.reports.tekanan-darah-pdf', [
            'user' => $user,
            'pengingat' => $pengingat,
            'chartData' => $chartData,
            'totalData' => $data->count(),
            'avgSistol' => $data->avg('sistol'),
            'avgDiastol' => $data->avg('diastol'),
            'generatedAt' => Carbon::now()->format('d M Y, H:i')
        ]);
        
        $pdfBase64 = base64_encode($pdf->output());
        
        return view('admin.pdf-viewer', compact('user', 'pdfBase64'));
    }
}