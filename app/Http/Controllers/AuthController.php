<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KodePendaftaran;

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

        // Tentukan apakah input email atau nomor HP
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_hp';
        
        // Jika nomor HP, pastikan formatnya benar
        if ($login_type === 'nomor_hp') {
            if (!preg_match('/^62[0-9]{9,13}$/', $request->login)) {
                return back()->withInput()->with('error', 'Login gagal! Periksa kembali email/nomor HP dan password Anda.');
            }
        }

        $credentials = [
            $login_type => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
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

        return back()->withInput()->with('error', 'Login gagal! Periksa kembali email/nomor HP dan password Anda.');
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
            'nomor_hp'      => 'required|digits_between:8,15|unique:users,nomor_hp',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia'          => 'required|integer|min:1|max:120',
            'puskesmas'  => 'required|in:kalasan,godean_2,umbulharjo',
            'kode_pendaftaran' => 'required|string',
            'password'      => [
                'required',
                'min:8',
                'regex:/[a-zA-Z]/', // harus ada huruf
                'regex:/[0-9]/',    // harus ada angka
                'confirmed'
            ],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_hp.required' => 'Nomor HP wajib diisi.',
            'nomor_hp.digits_between' => 'Nomor HP harus 8-15 digit.',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'usia.required' => 'Usia wajib diisi.',
            'usia.integer' => 'Usia harus berupa angka.',
            'usia.min' => 'Usia minimal 1 tahun.',
            'usia.max' => 'Usia maksimal 120 tahun.',
            'puskesmas.required' => 'Puskesmas wajib dipilih.',
            'puskesmas.in' => 'Pilihan puskesmas tidak valid.',
            'kode_pendaftaran.required' => 'Kode pendaftaran wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf dan angka.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Validasi kode pendaftaran
        $kodePendaftaran = KodePendaftaran::where('kode', $request->kode_pendaftaran)
            ->where('status', 'aktif')
            ->first();

        if (!$kodePendaftaran) {
            return back()->withInput()->withErrors([
                'kode_pendaftaran' => 'Kode pendaftaran tidak valid atau sudah terpakai.'
            ]);
        }

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'nomor_hp'      => '62' . $request->nomor_hp, // Tambah prefix 62
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia'          => $request->usia,
            'puskesmas'  => $request->puskesmas,
            'password'      => Hash::make($request->password),
            'role'          => 'pasien',
        ]);

        // Update status kode pendaftaran
        $kodePendaftaran->update([
            'status' => 'terpakai',
            'digunakan_oleh' => $user->id
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
