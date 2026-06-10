<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\MembershipController;

Route::get('/', function () {
    return redirect('/login');
});


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

Route::get('/profile', [UserController::class, 'profile'])
    ->name('profile');

Route::post('/profile/update', [UserController::class, 'update'])
    ->name('profile.update');

Route::get('/rewards', [RewardController::class, 'index'])
    ->name('rewards.index');

Route::post('/rewards/store', [RewardController::class, 'store'])
    ->name('rewards.store');

Route::post('/redeem/{id}', [RedeemController::class, 'redeem'])
    ->name('redeem.reward');

Route::get('/redeem-history', [RedeemController::class, 'history'])
    ->name('redeem.history');

Route::get('/admin', [AdminController::class, 'dashboard']);

Route::get('/admin/laporan', [ReportController::class, 'index']);

Route::get('/points', [PointController::class, 'index']);

Route::get('/membership', [MembershipController::class, 'index']);    