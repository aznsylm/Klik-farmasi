<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $totalAdmin = User::where('role', 'admin')->count();
        $totalPasien = User::where('role', 'pasien')->count();
        $totalUsers = $totalAdmin + $totalPasien;
        
        return view('superadmin.dashboard', compact('totalAdmin', 'totalPasien', 'totalUsers'));
    }

    public function admin(Request $request)
    {
        $query = User::where('role', 'admin')->orderBy('created_at', 'desc');
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nomor_hp', 'like', "%{$search}%");
            });
        }
        
        $users = $query->paginate(10);
        return view('superadmin.admin', compact('users'));
    }

    public function pasien(Request $request)
    {
        $query = User::where('role', 'pasien')->orderBy('created_at', 'desc');
        
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nomor_hp', 'like', "%{$search}%");
            });
        }
        
        $users = $query->paginate(10);
        return view('superadmin.pasien', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nomor_hp' => 'required|string|max:15|unique:users,nomor_hp',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,pasien',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'puskesmas' => 'required|string|max:255'
        ], [
            'email.unique' => 'Email sudah terdaftar, gunakan email lain!',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar, gunakan nomor lain!',
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'nomor_hp.required' => 'Nomor HP wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'usia.required' => 'Usia wajib diisi!',
            'puskesmas.required' => 'Puskesmas wajib dipilih!'
        ]);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            return back()->with('error', $errorMessage)->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'jenis_kelamin' => $request->jenis_kelamin,
            'usia' => $request->usia,
            'puskesmas' => $request->puskesmas,
            'email_verified_at' => now()
        ]);

        return back()->with('success', ucfirst($request->role) . ' berhasil ditambahkan!');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nomor_hp' => 'required|string|max:15|unique:users,nomor_hp,' . $id,
            'role' => 'required|in:admin,pasien',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'puskesmas' => 'required|string|max:255'
        ];
        
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        $messages = [
            'email.unique' => 'Email sudah terdaftar, gunakan email lain!',
            'nomor_hp.unique' => 'Nomor HP sudah terdaftar, gunakan nomor lain!',
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'nomor_hp.required' => 'Nomor HP wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'usia.required' => 'Usia wajib diisi!',
            'puskesmas.required' => 'Puskesmas wajib dipilih!'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $errorMessage = $validator->errors()->first();
            return back()->with('error', $errorMessage);
        }

        $updateData = $request->only(['name', 'email', 'nomor_hp', 'role', 'jenis_kelamin', 'usia', 'puskesmas']);
        
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        
        $user->update($updateData);

        return back()->with('success', 'Data user berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'superadmin') {
            return back()->with('error', 'SuperAdmin tidak dapat dihapus!');
        }
        
        $user->delete();
        return back()->with('success', 'User berhasil dihapus!');
    }
}