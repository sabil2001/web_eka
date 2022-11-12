<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\DashboardPesananController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardProduksiController;

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
    return view('login');
});

Route::get('/filterDate', [DashboardController::class, 'filtertanggal']);

// profile
Route::get('/dashboard/profile', [ProfileController::class, 'index']);
Route::put('/dashboard/profile/edit/{user}', [ProfileController::class, 'update']);
Route::put('/dashboard/profile/edit_pass/{user}', [ProfileController::class, 'edit_pass']);
// profile

// cetak invoice
Route::get('/dashboard/pesanan/invoice/{pesanan:id}', [DashboardController::class, 'invoice']);
// end cetak invoice

// cetak pertanggal
Route::get('/dashboard/laporan/pesanan-pertanggal/{tglawal}/{tglakhir}', [LaporanController::class, 'cetakPesanan']);
// end cetak pertanggal

// tampil halaman laporan
Route::get('/dashboard/laporan/pesanan', [LaporanController::class, 'index'])->middleware('auth');

// login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');


Route::resource('/dashboard/pegawai', DashboardPegawaiController::class)->middleware('master');

Route::resource('/dashboard/customer', DashboardCustomerController::class)->middleware('auth');

Route::resource('/dashboard/pesanan', DashboardPesananController::class)->middleware('auth');

Route::get('/dashboard/produksi/{pesanan:id}', [DashboardProduksiController::class, 'create']);
Route::post('/dashboard/produksi/{pesanan:id}', [DashboardProduksiController::class, 'store']);

Route::get('/dashboard/produksi/edit/{pesanan:id}', [DashboardProduksiController::class, 'edit']);
Route::put('/dashboard/produksi/edit/{produksi:id}', [DashboardProduksiController::class, 'update']);

Route::get('/dashboard/produksi/form/{pesanan:id}', [DashboardProduksiController::class, 'finish']);
Route::put('/dashboard/produksi/finish/{produksi:id}', [DashboardProduksiController::class, 'save']);

Route::get('/dashboard/pesanan/verifikasi/{pesanan:id}', [DashboardProduksiController::class, 'checkverif']);
Route::post('/dashboard/pesanan/verifikasi/{produksi:id}', [DashboardProduksiController::class, 'verifikasi']);

Route::get('/dashboard/pesanan/editverifikasi/{pesanan:id}', [DashboardProduksiController::class, 'editverifikasi']);
Route::put('/dashboard/pesanan/saveeditverifikasi/{produksi:id}', [DashboardProduksiController::class, 'saveeditverifikasi']);
