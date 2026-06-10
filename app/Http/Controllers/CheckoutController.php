<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout($id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($transaction->status == 'completed') {
            return redirect()->route('riwayat.index')
                ->with('error', 'Transaksi sudah di-checkout.');
        }

        $point = $transaction->total_point;

        $transaction->update([
        'status' => 'completed',
        ]);

        $user = Auth::user();
        $user->increment('point', $point);

        return redirect()->route('riwayat.index')
            ->with('success', "Checkout berhasil! Kamu mendapat $point point.");
    }
}