<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards', compact('rewards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'point_required' => 'required|integer'
        ]);

        Reward::create([
            'name' => $request->name,
            'point_required' => $request->point_required
        ]);

        return redirect()->back()->with('success', 'Reward berhasil ditambahkan');
    }
}