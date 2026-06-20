<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RedeemCode;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
    public function index() {
        return view('redeem'); 
    }

    public function process(Request $request) {
      
        $redeem = RedeemCode::where('code', $request->code)->where('is_used', false)->first();

       
        if ($redeem) {
            $user = Auth::user();
            
         
            $user->point += $redeem->points;
            $user->save();


            $redeem->update(['is_used' => true]);

            return back()->with('success', 'Berhasil! ' . $redeem->points . ' poin telah ditambahkan.');
        }

        return back()->with('error', 'Kode tidak valid atau sudah digunakan.');
    }
}