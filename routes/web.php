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
use App\Http\Controllers\OperationController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\SetPergerakanController;
use App\Http\Controllers\SetRealisasiController;
use App\Http\Controllers\InspectionController;

Auth::routes();
//web route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/outbound', [OutboundController::class, 'index'])->name('order-deliveries.index');
Route::get('/createdelivery', [CreateDeliveryController::class, 'index'])->name('deliveries.index');
Route::get('/createreceiving', [CreateReceivingController::class, 'index'])->name('receiving.index');
Route::get('/outbound/{id}', [OutboundController::class, 'show'])->name('deliveries.show');
Route::get('/inbound', [InboundController::class, 'index'])->name('inbound.index');
Route::get('/operation_list', [OperationController::class, 'index'])->name('operation.index');
Route::get('/gatein', [GateController::class, 'index'])->name('gate.index');
Route::get('/set_pergerakan', [SetPergerakanController::class, 'index'])->name('setpergerakan.index');
Route::get('/set_realisasi', [SetRealisasiController::class, 'index'])->name('setrealisasi.index');
Route::get('/set_inspeksi', [InspectionController::class, 'index'])->name('inspection.index');


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
Route::get('/gatein/search', [GateController::class, 'search'])->name('gate.search');
Route::put('/gatein/set-gate-in/{id}', [GateController::class, 'setGateIn'])->name('gate.setGateIn');
Route::get('/search-pergerakan', [SetPergerakanController::class, 'search'])->name('pergerakan.search');
Route::post('/pergerakan/store', [SetPergerakanController::class, 'store'])->name('pergerakan.store');
Route::get('/search-realisasi', [SetRealisasiController::class, 'search'])->name('realisasi.search');
Route::post('/set-realisasi', [SetRealisasiController::class, 'store'])->name('realisasi.store');
Route::get('/search-inspeksi', [InspectionController::class, 'search'])->name('inspection.search');



//menu
Route::get('/api/menus', [MenuController::class, 'getMenusData']);
// jikalau url gak ada
Route::fallback(function () {
    return redirect('/home');
});