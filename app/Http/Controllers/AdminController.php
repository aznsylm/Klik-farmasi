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
        // Hitung total catatan pasien yang belum dibaca untuk sidebar
        $totalCatatanPasien = 0;
        
        if (auth()->user()->role === 'admin') {
            $totalCatatanPasien = PengingatObat::whereHas('user', function($query) {
                $query->where('puskesmas_id', auth()->user()->puskesmas_id);
            })
            ->whereNotNull('catatan')
            ->where('catatan', '!=', '')
            ->where('catatan', '!=', '-')
            ->count();
        }
        
        return view('admin.dashboard', compact('totalCatatanPasien'));
    }
    public function index(Request $request)
    {
        // Default: pasien, kecuali superadmin memilih role lain
        $role = $request->get('role', 'pasien');
        $query = User::where('role', $role);

        // Filter berdasarkan puskesmas untuk admin biasa
        if (auth()->user()->role !== 'super_admin') {
            $query->where('puskesmas_id', auth()->user()->puskesmas_id);
        }
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('nomor_hp', 'like', "%$search%")
                  ->orWhere('jenis_kelamin', 'like', "%$search%")
                  ->orWhere('usia', 'like', "%$search%");
            });
        }
    
        // Tambahkan count untuk catatan yang belum dibaca (hanya untuk admin biasa)
        if (auth()->user()->role === 'admin') {
            $query->withCount(['pengingatObat as catatan_count' => function($q) {
                $q->whereNotNull('catatan')->where('catatan', '!=', '');
            }]);
        }
    
        // Urutkan terbaru di atas
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
    
        if (auth()->user()->role === 'super_admin') {
            return view('superadmin.users', compact('users', 'role'));
        }
        return view('admin.pasien.index', compact('users'));
    }
    public function create(Request $request)
    {
        $role = $request->get('role', 'pasien');
        return view('superadmin.user-create', compact('role'));
    }

    public function show($id)
    {
        $query = User::with('catatanDariAdmin.admin', 'pengingatObat');
        
        // Filter berdasarkan puskesmas untuk admin biasa
        if (auth()->user()->role !== 'super_admin') {
            $query->where('puskesmas_id', auth()->user()->puskesmas_id);
        }
        
        $user = $query->findOrFail($id);
        
        if (auth()->user()->role === 'super_admin') {
            return view('superadmin.user-detail', compact('user'));
        }
        return view('admin.pasien.detail', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        if (auth()->user()->role === 'super_admin') {
            return view('superadmin.user-edit', compact('user'));
        }
        return view('admin.pasien.edit', compact('user'));
    }
    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
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
            'password' => [
                'nullable',
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
        ];
    
        // Hanya super admin yang bisa mengubah role dan puskesmas
        if (auth()->user()->role === 'super_admin') {
            $rules['puskesmas_id'] = 'required|in:kalasan,godean_2,umbulharjo';
        }
    
        $request->validate($rules, [
            'nomor_hp.regex' => 'Nomor HP harus 8-15 digit angka saja',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar. Silakan gunakan nomor lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'puskesmas_id.required' => 'Silakan pilih puskesmas'
        ]);
    
        $data = $request->only(['name', 'email', 'nomor_hp', 'jenis_kelamin', 'usia']);
        
        // Format nomor HP (pastikan ada prefix 62)
        if (isset($data['nomor_hp'])) {
            $nomor_hp = $data['nomor_hp'];
            // Hapus +62 atau 62 di awal jika ada, lalu tambahkan 62
            $nomor_hp = preg_replace('/^(\+62|62)/', '', $nomor_hp);
            $data['nomor_hp'] = '62' . $nomor_hp;
        }
    
        if ($request->filled('password')) {
            $data['password'] = \Hash::make($request->password);
        }
    
        // Simpan puskesmas jika super admin
        if (auth()->user()->role === 'super_admin' && $request->filled('puskesmas_id')) {
            $data['puskesmas_id'] = $request->puskesmas_id;
        }
    
        $user->update($data);
    
        if (auth()->user()->role === 'super_admin') {
            return redirect()->route('superadmin.users', ['role' => $user->role])->with('success', 'Akun berhasil diperbarui.');
        }
        return redirect()->route('admin.pasienDetail', $user->id)->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $role = $user->role;
        $user->delete();
    
        if (auth()->user()->role === 'super_admin') {
            $msg = $role === 'admin' ? 'Admin berhasil dihapus.' : 'Pasien berhasil dihapus.';
            return redirect()->route('superadmin.users', ['role' => $role])->with('success', $msg);
        }
        return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil dihapus.');
    }

    public function addPasien(Request $request)
    {
        // Jika bukan super admin, gunakan puskesmas admin yang login
        $puskesmas_id = auth()->user()->role !== 'super_admin' 
            ? auth()->user()->puskesmas_id 
            : $request->puskesmas_id;

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
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
            'puskesmas_id' => auth()->user()->role === 'super_admin' ? 'required|in:kalasan,godean_2,umbulharjo' : 'nullable'
        ], [
            'nomor_hp.regex' => 'Format nomor HP tidak valid',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password.min' => 'Password minimal 8 karakter',
            'password.regex' => 'Password harus mengandung huruf dan angka',
            'puskesmas_id.required' => 'Silakan pilih puskesmas',
            'email.unique' => 'Email sudah terdaftar',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar'
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
                'puskesmas_id' => $puskesmas_id
            ]);

            if (auth()->user()->role === 'super_admin') {
                return redirect()->route('superadmin.users', ['role' => 'pasien'])
                    ->with('success', 'Pasien berhasil ditambahkan!');
            }
            return redirect()->route('admin.pasien')
                ->with('success', 'Pasien berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menambahkan pasien. Silakan coba lagi.')
                ->withInput();
        }
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => [
                'required',
                'unique:users,nomor_hp',
                'regex:/^[0-9]{8,15}$/'
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:18|max:120',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
            'puskesmas_id' => 'required|in:kalasan,godean_2,umbulharjo'
        ], [
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar. Silakan gunakan nomor lain.',
            'puskesmas_id.required' => 'Silakan pilih puskesmas',
            'puskesmas_id.in' => 'Puskesmas yang dipilih tidak valid'
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
                'password' => \Hash::make($request->password),
                'role' => 'admin',
                'puskesmas_id' => $request->puskesmas_id
            ]);
            return redirect()->route('superadmin.users', ['role' => 'admin'])->with('success', 'Admin baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan admin. Silakan coba lagi.')->withInput();
        }
    }

    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'new_password' => 'required|min:6'
        ]);

        $user = User::findOrFail($id);
        $user->update(['password' => bcrypt($request->new_password)]);

        return back()->with('success', 'Password berhasil diubah!');
    }
}