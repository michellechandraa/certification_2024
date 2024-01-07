<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', function () {
    return view('home');
});

Route::resource('products', BookController::class);

Route::resource('riwayat', RiwayatController::class);

Route::resource('pinjam', PinjamController::class);

Route::resource('anggota', AnggotaController::class);

Route::patch('/riwayat/{riwayat}', [RiwayatController::class, 'update'])->name('riwayat.update');
