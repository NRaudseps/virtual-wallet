<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');

Route::get('/wallet/create', function () {
   return view('wallet.create');
});
Route::post('/wallet/create', [WalletController::class, 'create'])->name('wallet.create');

Route::get('/wallet/rename', function (){
    return view('wallet.rename');
});
Route::put('/wallet/rename', [WalletController::class, 'rename'])->name('wallet.rename');
Route::delete('/wallet/delete', [WalletController::class, 'delete'])->name('wallet.delete');
Route::get('/wallet/{id}', [WalletController::class, 'show'])->name('wallet.show');

Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
Route::put('/transaction/setAsFraudulent', [TransactionController::class, 'setAsFraudulent']);
Route::delete('/transaction/delete', [TransactionController::class, 'delete'])->name('transaction.delete');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
