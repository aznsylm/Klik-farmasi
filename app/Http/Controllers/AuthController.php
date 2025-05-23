<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:8',
        ]);

        // Cek login pakai email atau nomor HP
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_hp';

        $credentials = [
            $login_type => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect sesuai role
            if (Auth::user()->role === 'super_admin') {
                return redirect()->route('superadmin.users');
            } elseif (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withInput()->with('error', 'Login gagal! Email/Nomor HP atau password salah.');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users,email',
            'nomor_hp'      => 'required|digits_between:10,15|unique:users,nomor_hp',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia'          => 'required|integer|min:1|max:120',
            'password'      => [
                'required',
                'min:8',
                'regex:/[a-zA-Z]/', // harus ada huruf
                'regex:/[0-9]/',    // harus ada angka
                'confirmed'
            ],
        ], [
            'password.regex' => 'Password minimal 8 karakter dan harus mengandung huruf & angka.',
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia'          => $request->usia,
            'password'      => Hash::make($request->password),
            'role'          => 'pasien',
        ]);

        // Kembali ke halaman register dengan session sukses
        return back()->with('register_success', true);
    }
    
    public function logout(Request $request)
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
