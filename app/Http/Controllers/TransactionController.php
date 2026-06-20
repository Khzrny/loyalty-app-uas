<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaksi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'   => 'required|array',
            'product_name.*' => 'required|string',
            'qty.*'          => 'required|integer|min:1',
            'price.*'        => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::create([
            'user_id'     => Auth::id(),
            'total_price' => 0,
            'total_point' => 0,
            'status'      => 'pending',
        ]);

        $total = 0;
        $totalPoint = 0;

        foreach ($request->product_name as $i => $name) {
            $qty      = $request->qty[$i];
            $price    = $request->price[$i];
            $subtotal = $qty * $price;

            $total += $subtotal;
            $totalPoint += ($qty * 10);

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_name'   => $name,
                'qty'            => $qty,
                'price'          => $price,
                'subtotal'       => $subtotal,
            ]);
        }

        $transaction->update([
            'total_price' => $total,
            'total_point' => $totalPoint,
        ]);

        return redirect()->route('riwayat.index')
            ->with('success', 'Transaksi berhasil dibuat! Silakan checkout.');
    }

    public function purchaseWithPoints(Request $request)
    {
        $request->validate([
            'product_name'   => 'required|array',
            'product_name.*' => 'required|string',
            'qty.*'          => 'required|integer|min:1',
            'points_needed'  => 'required|array',
        ]);

        $totalPointsNeeded = 0;
        foreach ($request->product_name as $i => $name) {
            $totalPointsNeeded += ($request->qty[$i] * $request->points_needed[$i]);
        }

        $transaction = Transaction::create([
            'user_id'     => Auth::id(),
            'total_price' => 0,
            'total_point' => $totalPointsNeeded,
            'status'      => 'pending',
        ]);

        foreach ($request->product_name as $i => $name) {
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_name'   => $name,
                'qty'            => $request->qty[$i],
                'price'          => 0,
                'subtotal'       => 0,
            ]);
        }

        return redirect()->route('riwayat.index')
            ->with('success', 'Transaksi berhasil dibuat! Silakan klik Konfirmasi Checkout untuk memproses poin.');
    }

    public function confirmTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $user = Auth::user();

        if ($user->point < $transaction->total_point) {
            return back()->with('error', 'Poin tidak cukup untuk checkout!');
        }

        $user->point -= $transaction->total_point;
        $user->save();

        $transaction->update(['status' => 'completed']);

        return redirect()->route('riwayat.index')
            ->with('success', 'Checkout berhasil! Poin telah dikurangi.');
    }

    public function riwayat()
    {
        $transaksi = Transaction::with('details')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('riwayat-transaksi', compact('transaksi'));
    }
}