<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/detail/{id}', [DashboardController::class, 'detail'])->name('peminjaman.detail');
Route::get('/peminjaman/detail/{id}', [DashboardController::class, 'detail'])->name('peminjaman.detail.coy');

// Route::namespace("App\Http\Controllers")->prefix("siswa")->group(function () {
//     Route::get('/all', "SiswaController@index")->name('siswa.index');
// });

Route::resource('siswa', SiswaController::class);
Route::resource('buku', BukuController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::resource('pengembalian', PengembalianController::class);


// Validasi add / edit buku
Route::post('/buku/validate/add', [BukuController::class, 'validateAddBook'])->name('buku.validate.add');
Route::post('/buku/validate/edit', [BukuController::class, 'validateEditBook'])->name('buku.validate.edit');

// Validasi peminjaman baru
Route::post('/peminjaman/validate', [PeminjamanController::class, 'validatePeminjaman'])->name('peminjaman.validate');

// Get Detail Peminjaman
Route::post('/peminjaman/confirm', [PeminjamanController::class, 'getDetail'])->name('peminjaman.confirm');

// Get Detail Pengembalian
Route::get('/pengembalian/peminjaman/detail/{id}', [PengembalianController::class, 'getDetail'])->name('pengembalian.proses');
