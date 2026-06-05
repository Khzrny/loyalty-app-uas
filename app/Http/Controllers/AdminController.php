<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/profile');
        }

        $users = User::all();
        $totalUsers = User::count();

        return view('admin.dashboard-admin', compact('users', 'totalUsers'));
    }
}