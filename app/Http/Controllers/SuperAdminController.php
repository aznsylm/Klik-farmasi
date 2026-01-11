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
        $query = User::where('role', 'admin');
        
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
        $query = User::where('role', 'pasien');
        
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
            'nomor_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,pasien',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'puskesmas' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
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
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'nomor_hp' => 'required|string|max:15',
            'role' => 'required|in:admin,pasien',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'required|integer|min:1|max:120',
            'puskesmas' => 'nullable|string|max:255'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user->update($request->only(['name', 'email', 'nomor_hp', 'role', 'jenis_kelamin', 'usia', 'puskesmas']));

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