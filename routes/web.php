<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

use App\Http\Controllers\OutboundController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\CreateDeliveryController;
use App\Http\Controllers\CreateReceivingController;
use App\Http\Controllers\Request\ApprovalController;
use App\Http\Controllers\Request\ApprovalDeliveryController;

Auth::routes();
//web route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/outbound', [OutboundController::class, 'index'])->name('order-deliveries.index');
Route::get('/createdelivery', [CreateDeliveryController::class, 'index'])->name('deliveries.index');
Route::get('/createreceiving', [CreateReceivingController::class, 'index'])->name('receiving.index');
Route::get('/outbound/{id}', [OutboundController::class, 'show'])->name('deliveries.show');
Route::get('/inbound', [InboundController::class, 'index'])->name('inbound.index');

//Approval
Route::get('/approvalreceiving', [ApprovalController::class, 'index'])->name('approval.index');
Route::post('/approval/approve/{id}', [ApprovalController::class, 'approve'])->name('approval.approve');
Route::post('/approval/reject/{id}', [ApprovalController::class, 'reject'])->name('approval.reject');
Route::get('/approvaldelivery', [ApprovalDeliveryController::class, 'index'])->name('approvaldel.index');
Route::post('/approval/approvedelivery/{id}', [ApprovalDeliveryController::class, 'approve'])->name('approvaldel.approve');
Route::post('/approval/rejectdelivery/{id}', [ApprovalDeliveryController::class, 'reject'])->name('approvaldel.reject');
//ajax/api/proses route
Route::get('/outbound/data', [OutboundController::class, 'getData']);
Route::post('/createdelivery', [CreateDeliveryController::class, 'store'])->name('deliveries.store');
Route::delete('/deliveries/{id}', [OutboundController::class, 'destroy'])->name('deliveries.destroy');
Route::post('/inbound/store', [CreateReceivingController::class, 'store'])->name('inbound.store');
Route::delete('/inbound/{id}', [InboundController::class, 'destroy'])->name('inbound.destroy');
Route::get('/inbound/{id}', [InboundController::class, 'show'])->name('receiving.show');



//menu
Route::get('/api/menus', [MenuController::class, 'getMenusData']);
// jikalau url gak ada
Route::fallback(function () {
    return redirect('/home');
});