<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Form tambah transaksi
    public function index()
    {
        return view('transaksi');
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'product_name'   => 'required|array',
            'product_name.*' => 'required|string',
            'qty.*'          => 'required|integer|min:1',
            'price.*'        => 'required|numeric|min:0',
        ]);

        // Buat transaksi baru dengan status pending
        $transaction = Transaction::create([
            'user_id'     => Auth::id(),
            'total_price' => 0,
            'total_point' => 0,
            'status'      => 'pending',
        ]);

        $total = 0;

        foreach ($request->product_name as $i => $name) {
            $qty      = $request->qty[$i];
            $price    = $request->price[$i];
            $subtotal = $qty * $price;
            $total   += $subtotal;

            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_name'   => $name,
                'qty'            => $qty,
                'price'          => $price,
                'subtotal'       => $subtotal,
            ]);
        }

        $transaction->update(['total_price' => $total]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dibuat! Silakan checkout.');
    }

    // Riwayat transaksi user
    public function riwayat()
    {
        $transaksi = Transaction::with('details')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('riwayat-transaksi', compact('transaksi'));
    }
}