<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-detail', compact('user')); // Buat view untuk detail user
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-edit', compact('user')); // Buat view untuk edit user
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        $user->update($request->only(['name', 'email']));

        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus.');
    }
}