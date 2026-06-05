<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/profile');
        }

        $users = User::all();

        return view('admin.laporan', compact('users'));
    }
}