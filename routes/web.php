<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

use App\Http\Controllers\OutboundController;
use App\Http\Controllers\CreateDeliveryController;


Auth::routes();
//web route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/outbound', [OutboundController::class, 'index']);
Route::get('/createdelivery', [CreateDeliveryController::class, 'index'])->name('deliveries.index');

//ajax/api/proses route
Route::get('/outbound/data', [OutboundController::class, 'getData']);
Route::post('/createdelivery', [CreateDeliveryController::class, 'store'])->name('deliveries.store');

//menu
Route::get('/api/menus', [MenuController::class, 'getMenusData']);
// jikalau url gak ada
Route::fallback(function () {
    return redirect('/home');
});