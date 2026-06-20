<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedeemCode extends Model
{
    // Ini penting supaya Laravel mengizinkan input data
    protected $fillable = ['code', 'points', 'is_used'];
}