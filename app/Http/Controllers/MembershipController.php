<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        return view('membership'); 
    }
    public function checkout($tier)
{
    $price = ($tier == 'Gold') ? 100000 : 50000;
    return view('membership_checkout', ['tier' => $tier, 'price' => $price]);
}

public function processPayment(Request $request, $tier)
{
    $user = Auth::user();
    $price = ($tier == 'Gold') ? 100000 : 50000;

    \App\Models\Transaction::create([
        'user_id' => $user->id,
        'product_name' => 'Langganan Membership ' . $tier,
        'qty' => 1,
        'price' => $price,
        'status' => 'Completed'
    ]);

    $user->membership_level = $tier;
    $user->save();

    return redirect('/membership')->with('success', 'Pembayaran berhasil! Anda sekarang paket ' . $tier);
}
}