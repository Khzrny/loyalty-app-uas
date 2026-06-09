<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;

class PointController extends Controller
{
    public function index()
    {
        $poin = Point::where('user_id', 1)->first();

        $totalPoin = $poin ? $poin->total_point : 0;

        return view('point-dashboard', ['totalPoin' => $totalPoin]);
    }
}