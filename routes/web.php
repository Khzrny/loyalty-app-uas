<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Default
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.auth');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| User Profile
|--------------------------------------------------------------------------
*/

Route::get('/profile', [UserController::class, 'profile'])
    ->name('profile');

Route::post('/profile/update', [UserController::class, 'update'])
    ->name('profile.update');

/*
|--------------------------------------------------------------------------
| Rewards
|--------------------------------------------------------------------------
*/

Route::get('/rewards', [RewardController::class, 'index'])
    ->name('rewards.index');

Route::post('/rewards/store', [RewardController::class, 'store'])
    ->name('rewards.store');

/*
|--------------------------------------------------------------------------
| Redeem
|--------------------------------------------------------------------------
*/

Route::post('/redeem/{id}', [RedeemController::class, 'redeem'])
    ->name('redeem.reward');

Route::get('/redeem-history', [RedeemController::class, 'history'])
    ->name('redeem.history');