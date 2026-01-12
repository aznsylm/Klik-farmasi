<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PengingatObat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminPuskesmas = auth()->user()->puskesmas ?? 'kalasan';
        
        // Statistik Tekanan Darah
        $tdStats = $this->getTekananDarahStats($adminPuskesmas);
        
        // Count data untuk Features Grid
        $totalPasien = User::where('role', 'pasien')->where('puskesmas', $adminPuskesmas)->count();
        $totalArtikel = \App\Models\Article::count();
        $totalBerita = \App\Models\News::count();
        $totalFaq = \App\Models\Faq::count();
        $totalUnduhan = \App\Models\Download::count();
        $totalTestimoni = \App\Models\Testimonial::count();
        $totalKodePendaftaran = \App\Models\KodePendaftaran::count();
        
        return view('admin.dashboard', compact(
            'tdStats', 'totalPasien', 'totalArtikel', 'totalBerita', 
            'totalFaq', 'totalUnduhan', 'totalTestimoni', 'totalKodePendaftaran'
        ));
    }
    
    private function getTekananDarahStats($puskesmas)
    {
        // Ambil TD terakhir setiap pasien di puskesmas ini
        $latestTD = \DB::select("
            SELECT ctd.user_id, u.name, u.nomor_hp, ctd.sistol, ctd.diastol
            FROM catatan_tekanan_darah ctd
            INNER JOIN users u ON ctd.user_id = u.id
            INNER JOIN (
                SELECT user_id, MAX(created_at) as max_date
                FROM catatan_tekanan_darah
                GROUP BY user_id
            ) latest ON ctd.user_id = latest.user_id AND ctd.created_at = latest.max_date
            WHERE u.puskesmas = ? AND u.role = 'pasien'
        ", [$puskesmas]);
            
        $normal = [];
        $tinggi = [];
        $sangatTinggi = [];
        
        foreach ($latestTD as $td) {
            // Klasifikasi berdasarkan panduan medis yang sesuai dengan dashboard
            if ($td->sistol < 120 && $td->diastol < 80) {
                // Normal: <120 DAN <80
                $normal[] = ['name' => $td->name, 'nomor_hp' => $td->nomor_hp, 'sistol' => $td->sistol, 'diastol' => $td->diastol];
            } elseif (($td->sistol >= 120 && $td->sistol <= 129) || ($td->diastol >= 80 && $td->diastol <= 90)) {
                // Pre Hipertensi: 120-129 ATAU 80-90
                $tinggi[] = ['name' => $td->name, 'nomor_hp' => $td->nomor_hp, 'sistol' => $td->sistol, 'diastol' => $td->diastol];
            } elseif (($td->sistol >= 140 && $td->sistol <= 159) || ($td->diastol >= 90 && $td->diastol <= 99)) {
                // Hipertensi Stage 1: 140-159 ATAU 90-99
                $sangatTinggi[] = ['name' => $td->name, 'nomor_hp' => $td->nomor_hp, 'sistol' => $td->sistol, 'diastol' => $td->diastol];
            }
            // Stage 2 (≥160/100) tidak ditampilkan karena hardcoded 0 di dashboard
        }
        
        return [
            'normal' => ['count' => count($normal), 'patients' => $normal],
            'tinggi' => ['count' => count($tinggi), 'patients' => $tinggi],
            'sangat_tinggi' => ['count' => count($sangatTinggi), 'patients' => $sangatTinggi]
        ];
    }

    public function index(Request $request)
    {
        $query = User::where('role', 'pasien');
        $query->where('puskesmas', auth()->user()->puskesmas);
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nomor_hp', 'like', "%$search%");
            });
        }
    
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        return view('admin.pasien.index', compact('users'));
    }
    public function create(Request $request)
    {
        $role = $request->get('role', 'pasien');
        return view('superadmin.user-create', compact('role'));
    }

    public function show($id, Request $request)
    {
        $query = User::with('pengingatObat');
        $query->where('puskesmas', auth()->user()->puskesmas);
        $user = $query->findOrFail($id);
        
        $period = $request->get('period', 'week');
        $trackingData = $this->getWhatsappTrackingData($user->id, $period);
        
        return view('admin.pasien.detail', compact('user', 'trackingData', 'period'));
    }
    
    public function update(Request $request, $id)
    {
        $user = User::where('puskesmas', auth()->user()->puskesmas)->findOrFail($id);
    
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'nomor_hp' => [
                'required',
                'regex:/^[0-9]{8,15}$/',
                'unique:users,nomor_hp,' . $id,
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'password' => 'nullable|min:8'
        ];
    
        $request->validate($rules, [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nomor_hp.required' => 'Nomor HP wajib diisi',
            'nomor_hp.regex' => 'Format nomor HP tidak valid',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'usia.required' => 'Usia wajib diisi',
            'usia.integer' => 'Usia harus berupa angka',
            'usia.min' => 'Usia minimal 1 tahun',
            'usia.max' => 'Usia maksimal 120 tahun',
            'password.min' => 'Password minimal 8 karakter'
        ]);
    
        $data = $request->only(['name', 'email', 'nomor_hp', 'jenis_kelamin', 'usia']);
        
        if ($request->filled('password')) {
            $data['password'] = \Hash::make($request->password);
        }
    
        $user->update($data);
        
        // Check if request is from detail page (AJAX)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'redirect' => route('admin.pasienDetail', $id)]);
        }
        
        return redirect()->route('admin.pasienDetail', $id)->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil dihapus.');
    }

    public function addPasien(Request $request)
    {
        // Gunakan puskesmas admin yang login
        $puskesmas = auth()->user()->puskesmas;

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => [
                'required',
                'unique:users,nomor_hp',
                'regex:/^[0-9]{8,15}$/'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'password' => [
                'required',
                'min:8'
            ]
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nomor_hp.required' => 'Nomor HP wajib diisi',
            'nomor_hp.regex' => 'Format nomor HP tidak valid',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'usia.required' => 'Usia wajib diisi',
            'usia.integer' => 'Usia harus berupa angka',
            'usia.min' => 'Usia minimal 1 tahun',
            'usia.max' => 'Usia maksimal 120 tahun',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        // Format nomor HP (pastikan ada prefix 62)
        $nomor_hp = $request->nomor_hp;
        // Hapus +62 atau 62 di awal jika ada, lalu tambahkan 62
        $nomor_hp = preg_replace('/^(\+62|62)/', '', $nomor_hp);
        $nomor_hp = '62' . $nomor_hp;

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'nomor_hp' => $nomor_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'usia' => $request->usia,
                'password' => bcrypt($request->password),
                'role' => 'pasien',
                'puskesmas' => $puskesmas
            ]);

            return redirect()->route('admin.pasien')
                ->with('success', 'Pasien berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menambahkan pasien. Silakan coba lagi.')
                ->withInput();
        }
    }



    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:6'
        ]);

        $user = User::findOrFail($id);
        $user->update(['password' => bcrypt($request->new_password)]);

        return redirect()->route('admin.pasienDetail', $user->id)->with('success', 'Password berhasil diubah!');
    }

    private function getWhatsappTrackingData($userId, $period = 'week')
    {
        $user = \App\Models\User::findOrFail($userId);
        $pengingat = $user->pengingatObat()->latest()->first();
        
        if (!$pengingat) {
            return [];
        }

        // Ambil semua obat (aktif dan habis) untuk tracking lengkap
        $obatList = $pengingat->detailObat()->get();
        $trackingData = [];

        foreach ($obatList as $obat) {
            $days = $this->getDaysByPeriod($userId, $obat->id, $period);
            
            // Untuk admin Godean, prioritaskan suplemen di nama tracking
            $displayName = auth()->user()->puskesmas === 'godean_2' 
                ? ($obat->suplemen ?: $obat->nama_obat ?: 'Tidak ada nama')
                : ($obat->nama_obat ?: $obat->suplemen ?: 'Tidak ada nama');
            
            $trackingData[] = [
                'obat' => $obat,
                'display_name' => $displayName,
                'days' => $days,
                'success_rate' => $this->calculateSuccessRate($days)
            ];
        }

        return $trackingData;
    }

    private function getDaysByPeriod($userId, $obatId, $period)
    {
        $days = [];
        
        // Get obat creation date
        $obat = \App\Models\DetailObatPengingat::find($obatId);
        $obatCreatedDate = $obat ? $obat->created_at->toDateString() : null;
        
        if ($period === 'all') {
            // Group by month for all data
            $logs = \App\Models\WhatsappLog::where('user_id', $userId)
                ->where('detail_obat_id', $obatId)
                ->where('jenis_pesan', 'pengingat_obat')
                ->orderBy('created_at', 'desc')
                ->get()
                ->groupBy(function($log) {
                    return $log->created_at->format('Y-m');
                });

            foreach ($logs as $month => $monthLogs) {
                $sent = $monthLogs->where('status', 'sent')->count();
                $failed = $monthLogs->where('status', 'failed')->count();
                
                $days[] = [
                    'date' => $month,
                    'day' => date('M Y', strtotime($month . '-01')),
                    'status' => $sent > $failed ? 'sent' : ($failed > 0 ? 'failed' : 'pending'),
                    'total' => $monthLogs->count(),
                    'sent' => $sent,
                    'failed' => $failed,
                    'is_today' => false
                ];
            }
        } else {
            $dayCount = $period === 'week' ? 7 : 30;
            
            for ($i = $dayCount - 1; $i >= 0; $i--) {
                $date = \Carbon\Carbon::now()->subDays($i)->toDateString();
                $dayName = \Carbon\Carbon::parse($date)->format($period === 'week' ? 'D' : 'd/m');
                
                // Check if this date is before obat was created
                if ($obatCreatedDate && $date < $obatCreatedDate) {
                    $status = 'not_added';
                } else {
                    $log = \App\Models\WhatsappLog::where('user_id', $userId)
                        ->where('detail_obat_id', $obatId)
                        ->where('jenis_pesan', 'pengingat_obat')
                        ->whereDate('created_at', $date)
                        ->first();
                    
                    $status = 'pending';
                    if ($log) {
                        $status = $log->status === 'sent' ? 'sent' : 'failed';
                    } elseif (\Carbon\Carbon::parse($date)->isFuture()) {
                        $status = 'future';
                    }
                }
                
                $days[] = [
                    'date' => $date,
                    'day' => $dayName,
                    'status' => $status,
                    'is_today' => $date === \Carbon\Carbon::now()->toDateString()
                ];
            }
        }
        
        return $days;
    }

    public function checkDuplicate(Request $request)
    {
        $email = $request->input('email');
        $nomorHp = $request->input('nomor_hp');
        $userId = $request->input('user_id'); // For edit mode
        
        $exists = false;
        
        if ($email) {
            $query = User::where('email', $email);
            if ($userId) {
                $query->where('id', '!=', $userId);
            }
            $exists = $query->exists();
        }
        
        if ($nomorHp && !$exists) {
            $query = User::where('nomor_hp', $nomorHp);
            if ($userId) {
                $query->where('id', '!=', $userId);
            }
            $exists = $query->exists();
        }
        
        return response()->json(['exists' => $exists]);
    }

    private function calculateSuccessRate($days)
    {
        if (isset($days[0]['total'])) {
            // Monthly data
            $totalSent = array_sum(array_column($days, 'sent'));
            $totalAll = array_sum(array_column($days, 'total'));
            return $totalAll > 0 ? round(($totalSent / $totalAll) * 100) : 0;
        }
        
        // Daily data - exclude 'not_added' and 'future' from calculation
        $validDays = array_filter($days, fn($day) => !in_array($day['status'], ['future', 'not_added']));
        $total = count($validDays);
        $success = count(array_filter($validDays, fn($day) => $day['status'] === 'sent'));
        
        return $total > 0 ? round(($success / $total) * 100) : 0;
    }
    
    public function getChartData($userId)
    {
        $user = User::where('puskesmas', auth()->user()->puskesmas)->findOrFail($userId);
        
        $data = \App\Models\CatatanTekananDarah::where('user_id', $userId)
            ->orderBy('created_at', 'asc')
            ->get();
        
        $labels = [];
        $sistol = [];
        $diastol = [];
        
        foreach ($data as $record) {
            $labels[] = $record->created_at->format('d/m');
            $sistol[] = $record->sistol;
            $diastol[] = $record->diastol;
        }
        
        return response()->json([
            'labels' => $labels,
            'sistol' => $sistol,
            'diastol' => $diastol
        ]);
    }
}