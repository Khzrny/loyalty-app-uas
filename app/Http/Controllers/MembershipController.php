<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class MembershipController extends Controller
{
    public function index() {
        return view('membership');
    }

    public function checkout($tier) {
        $price = ($tier == 'Gold') ? 100000 : 50000;
        return view('membership_checkout', ['tier' => $tier, 'price' => $price]);
    }

    public function processPayment(Request $request, $tier)
{
    $user = \Illuminate\Support\Facades\Auth::user();
    $price = ($tier == 'Gold') ? 100000 : 50000;

    \App\Models\Transaction::create([
        'user_id' => $user->id,
        'total_price' => $price, 
        'status' => 'Completed'
    ]);

    // Update level user
    $user->membership_level = $tier;
    $user->save();

    return redirect('/membership')->with('success', 'Pembayaran berhasil!');
}
}