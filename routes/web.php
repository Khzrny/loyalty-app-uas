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
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CheckoutController;


Route::get('/', function () { return redirect('/login'); });

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');

Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
Route::post('/rewards/store', [RewardController::class, 'store'])->name('rewards.store');
Route::post('/redeem/{id}', [RedeemController::class, 'redeem'])->name('redeem.reward');
Route::get('/redeem-history', [RedeemController::class, 'history'])->name('redeem.history');

// Rute Redeem Baru
Route::get('/redeem', [RedeemController::class, 'index'])->name('redeem.index');
Route::post('/redeem', [RedeemController::class, 'process'])->name('redeem.process');

Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/admin/laporan', [ReportController::class, 'index']);

Route::get('/points', [PointController::class, 'index']);

Route::get('/membership', [MembershipController::class, 'index']);    

Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaksi.index');
Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');
Route::get('/riwayat-transaksi', [TransactionController::class, 'riwayat'])->name('riwayat.index');

Route::get('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout');

Route::get('/membership/confirm/{tier}', [MembershipController::class, 'checkout']);
Route::post('/membership/pay/{tier}', [MembershipController::class, 'processPayment']);
Route::post('/transaksi/poin', [TransactionController::class, 'purchaseWithPoints'])->name('transaksi.poin');
Route::post('/transaksi/confirm/{id}', [TransactionController::class, 'confirmTransaction'])->name('transaksi.confirm');