<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Default: pasien, kecuali superadmin memilih role lain
        $role = $request->get('role', 'pasien');
        $query = User::where('role', $role);
    
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
    
        // Urutkan terbaru di atas
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
    
        if (auth()->user()->role === 'super_admin') {
            return view('superadmin.users', compact('users', 'role'));
        }
        return view('admin.pasien.index', compact('users'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
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
                'regex:/^08[0-9]{8,11}$/',
                'unique:users,nomor_hp,' . $id,
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'password' => [
                'nullable',
                'min:8',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
        ];
    
        // Hanya super admin yang bisa mengubah role
        if (auth()->user()->role === 'super_admin') {
            $rules['role'] = 'required|in:pasien,admin,super_admin';
        }
    
        $request->validate($rules, [
            'nomor_hp.regex' => 'Nomor HP harus diawali 08 dan 10-13 digit, contoh: 081255693035',
        ]);
    
        $data = $request->only(['name', 'email', 'nomor_hp', 'jenis_kelamin', 'usia']);
    
        if ($request->filled('password')) {
            $data['password'] = \Hash::make($request->password);
        }
    
        // Simpan role jika super admin
        if (auth()->user()->role === 'super_admin' && $request->filled('role')) {
            $data['role'] = $request->role;
        }
    
        $user->update($data);
    
        if (auth()->user()->role === 'super_admin') {
            return redirect()->route('superadmin.users')->with('success', 'Akun berhasil diperbarui.');
        }
        return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil diperbarui.');
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

    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => 'required|digits_between:10,15|unique:users,nomor_hp',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:18|max:120',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'password' => \Hash::make($request->password),
            'role' => 'admin',
        ]);
        return back()->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function addPasien(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => [
                'required',
                'regex:/^08[0-9]{8,11}$/',
                'unique:users,nomor_hp',
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'password' => [
                'required',
                'min:8',
                'regex:/[a-zA-Z]/',
                'regex:/[0-9]/'
            ],
        ], [
            'nomor_hp.regex' => 'Nomor HP harus diawali 08 dan 10-13 digit, contoh: 081255693035',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'password' => \Hash::make($request->password),
            'role' => 'pasien',
        ]);
    
        // Redirect sesuai dengan role pengguna
        if (auth()->user()->role === 'super_admin') {
            return redirect()->route('superadmin.users', ['role' => 'pasien'])->with('success', 'Pasien berhasil ditambahkan!');
        }
        
        return redirect()->route('admin.pasien')->with('success', 'Pasien berhasil ditambahkan!');
    } 
}