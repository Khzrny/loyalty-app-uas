<?php

namespace App\Http\Controllers;

use App\Models\Redeem;
use App\Models\Reward;
use Illuminate\Http\Request;

class RedeemController extends Controller
{
    public function redeem($id)
    {
        $reward = Reward::findOrFail($id);

        Redeem::create([
            'user_name' => 'Arkan',
            'reward_id' => $reward->id,
            'points_used' => $reward->point_required
        ]);

        return redirect()->back()->with('success', 'Reward berhasil diredeem');
    }

    public function history()
    {
        $redeems = Redeem::with('reward')->latest()->get();

        return view('redeem-history', compact('redeems'));
    }
}