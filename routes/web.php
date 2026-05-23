<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RedeemController;

Route::get('/', function () {
    return redirect('/rewards');
});

Route::get('/rewards', [RewardController::class, 'index'])
    ->name('rewards.index');

Route::post('/rewards/store', [RewardController::class, 'store'])
    ->name('rewards.store');

Route::post('/redeem/{id}', [RedeemController::class, 'redeem'])
    ->name('redeem.reward');

Route::get('/redeem-history', [RedeemController::class, 'history'])
    ->name('redeem.history');