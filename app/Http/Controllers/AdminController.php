<?php
namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }
}