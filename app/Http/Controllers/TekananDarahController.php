<?php

namespace App\Http\Controllers;

use App\Models\CatatanTekananDarah;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TekananDarahController extends Controller
{
    public function userIndex()
    {
        $recentRecords = CatatanTekananDarah::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('pasien.tekanan-darah', compact('recentRecords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sistol' => 'required|integer|min:50|max:250',
            'diastol' => 'required|integer|min:50|max:150'
        ]);

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        
        // Check if already input today (anti-redundansi)
        $existing = CatatanTekananDarah::where('user_id', auth()->id())
            ->whereDate('created_at', $today)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah menginput tekanan darah hari ini. Silakan coba lagi besok atau edit data yang sudah ada.'
            ]);
        }

        CatatanTekananDarah::create([
            'user_id' => auth()->id(),
            'pengingat_obat_id' => null, // Tidak terikat pengingat obat
            'sistol' => $request->sistol,
            'diastol' => $request->diastol,
            'sumber' => 'input_harian',
            'created_at' => Carbon::now('Asia/Jakarta'),
            'updated_at' => Carbon::now('Asia/Jakarta')
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data tekanan darah berhasil disimpan'
        ]);
    }

    public function userUpdate(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'sistol' => 'required|integer|min:50|max:250',
                'diastol' => 'required|integer|min:50|max:150'
            ]);

            $catatan = CatatanTekananDarah::where('id', $id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$catatan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $catatan->sistol = $validated['sistol'];
            $catatan->diastol = $validated['diastol'];
            $catatan->sumber = 'input_harian';
            $catatan->save();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diupdate'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('User Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getChartData()
    {
        try {
            // Ambil semua data tekanan darah user, urutkan berdasarkan tanggal
            $tekananDarah = CatatanTekananDarah::where('user_id', auth()->id())
                ->orderBy('created_at', 'asc')
                ->get();

            // Siapkan data untuk chart
            $chartData = [
                'labels' => [],
                'sistol' => [],
                'diastol' => []
            ];

            // Jika ada data, format untuk chart
            foreach ($tekananDarah as $data) {
                $chartData['labels'][] = Carbon::parse($data->created_at)->format('d M');
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
        
        $data = CatatanTekananDarah::where('user_id', $userId)
            ->orderBy('created_at')
            ->get();
        
        $labels = [];
        $sistol = [];
        $diastol = [];
        $rawData = [];
        
        foreach ($data as $item) {
            $labels[] = Carbon::parse($item->created_at)->format('d/m');
            $sistol[] = $item->sistol;
            $diastol[] = $item->diastol;
            $rawData[] = [
                'id' => $item->id,
                'tanggal' => $item->created_at->format('Y-m-d'),
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

    public function getAdminRecords($userId, Request $request)
    {
        $perPage = 10;
        $page = $request->get('page', 1);
        
        $query = CatatanTekananDarah::where('user_id', $userId)
            ->orderBy('created_at', 'desc');
            
        $total = $query->count();
        $records = $query->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
        
        return response()->json([
            'data' => $records,
            'current_page' => (int) $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => ceil($total / $perPage)
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

            $targetDate = Carbon::parse($request->tanggal_input)->toDateString();
            
            // Check if already exists on target date (anti-redundansi)
            $existing = CatatanTekananDarah::where('user_id', $request->user_id)
                ->whereDate('created_at', $targetDate)
                ->first();
                
            if ($existing) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sudah ada data tekanan darah di tanggal tersebut'
                ]);
            }

            $catatan = CatatanTekananDarah::create([
                'user_id' => $request->user_id,
                'pengingat_obat_id' => null, // Tidak terikat pengingat obat
                'sistol' => $request->sistol,
                'diastol' => $request->diastol,
                'sumber' => 'admin_input'
            ]);
            
            // Set created_at to match tanggal_input
            $catatan->created_at = $request->tanggal_input;
            $catatan->save();

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
                'diastol' => 'required|integer|min:50|max:150',
                'tanggal_input' => 'required|date'
            ]);

            $catatan = CatatanTekananDarah::findOrFail($id);
            $catatan->update([
                'sistol' => $request->sistol,
                'diastol' => $request->diastol,
                'sumber' => 'admin_edit'
            ]);
            
            // Update created_at to match tanggal_input since we removed tanggal_input column
            $catatan->created_at = $request->tanggal_input;
            $catatan->save();

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
            
            $data = CatatanTekananDarah::where('user_id', $userId)
                ->orderBy('created_at')
                ->get();
        
            $chartData = [];
            foreach ($data as $item) {
                // Klasifikasi berdasarkan panduan medis
                if ($item->sistol < 120 && $item->diastol < 80) {
                    $category = 'NORMAL';
                } elseif ($item->sistol >= 120 && $item->sistol <= 129 && $item->diastol < 80) {
                    $category = 'PRE HIPERTENSI';
                } elseif (($item->sistol >= 130 && $item->sistol <= 139) || ($item->diastol >= 80 && $item->diastol <= 89)) {
                    $category = 'HIPERTENSI STAGE 1';
                } else {
                    $category = 'HIPERTENSI STAGE 2';
                }
                
                $chartData[] = [
                    'tanggal' => Carbon::parse($item->created_at)->format('d/m/Y'),
                    'sistol' => $item->sistol,
                    'diastol' => $item->diastol,
                    'kategori' => $category
                ];
            }
        
            $stats = [
                'total' => $data->count(),
                'avg_sistol' => $data->count() > 0 ? round($data->avg('sistol'), 1) : 0,
                'avg_diastol' => $data->count() > 0 ? round($data->avg('diastol'), 1) : 0,
                'max_sistol' => $data->count() > 0 ? $data->max('sistol') : 0,
                'max_diastol' => $data->count() > 0 ? $data->max('diastol') : 0
            ];
        
            $pdf = Pdf::loadView('components.tekanan-darah-pdf', [
                'user' => $user,
                'pengingat' => $pengingat,
                'chartData' => $chartData,
                'stats' => $stats,
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
            ->orderBy('created_at')
            ->get();
        
        $chartData = [];
        $sistolData = [];
        $diastolData = [];
        
        foreach ($data as $item) {
            // Klasifikasi berdasarkan panduan medis
            if ($item->sistol < 120 && $item->diastol < 80) {
                $category = 'NORMAL';
            } elseif ($item->sistol >= 120 && $item->sistol <= 129 && $item->diastol < 80) {
                $category = 'PRE HIPERTENSI';
            } elseif (($item->sistol >= 130 && $item->sistol <= 139) || ($item->diastol >= 80 && $item->diastol <= 89)) {
                $category = 'HIPERTENSI STAGE 1';
            } else {
                $category = 'HIPERTENSI STAGE 2';
            }
            
            $chartData[] = [
                'tanggal' => Carbon::parse($item->created_at)->format('d/m/Y'),
                'sistol' => $item->sistol,
                'diastol' => $item->diastol,
                'kategori' => $category
            ];
            
            $sistolData[] = $item->sistol;
            $diastolData[] = $item->diastol;
        }
        
        // Statistik
        $stats = [
            'total' => $data->count(),
            'avg_sistol' => $data->count() > 0 ? round($data->avg('sistol'), 1) : 0,
            'avg_diastol' => $data->count() > 0 ? round($data->avg('diastol'), 1) : 0,
            'max_sistol' => $data->count() > 0 ? $data->max('sistol') : 0,
            'max_diastol' => $data->count() > 0 ? $data->max('diastol') : 0,
            'min_sistol' => $data->count() > 0 ? $data->min('sistol') : 0,
            'min_diastol' => $data->count() > 0 ? $data->min('diastol') : 0,
        ];
        
        $pdf = Pdf::loadView('components.tekanan-darah-pdf', [
            'user' => $user,
            'pengingat' => $pengingat,
            'chartData' => $chartData,
            'stats' => $stats,
            'generatedAt' => Carbon::now()->format('d M Y, H:i')
        ]);
        
        return $pdf->stream('Laporan_Tekanan_Darah_' . $user->name . '_' . Carbon::now()->format('Y-m-d') . '.pdf');
    }
    
    public function getExistingDates($userId)
    {
        $dates = CatatanTekananDarah::where('user_id', $userId)
            ->get()
            ->map(function($item) {
                return Carbon::parse($item->created_at)->format('Y-m-d');
            })
            ->unique()
            ->values()
            ->toArray();
            
        return response()->json(['dates' => $dates]);
    }

    public function viewPDFPage($userId)
    {
        $user = User::findOrFail($userId);
        $pengingat = $user->pengingatObat()->latest()->first();
        
        $data = CatatanTekananDarah::where('user_id', $userId)
            ->where('pengingat_obat_id', $pengingat->id)
            ->orderBy('created_at')
            ->get();
        
        $chartData = [];
        foreach ($data as $item) {
            $chartData[] = [
                'tanggal' => Carbon::parse($item->created_at)->format('d/m/Y'),
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