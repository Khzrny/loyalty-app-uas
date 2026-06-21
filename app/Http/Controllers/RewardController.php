<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Transaction::with('details')
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->where('total_price', 0)
            ->latest()
            ->get();

        return view('rewards', compact('rewards'));
    }
}