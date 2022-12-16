<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardKainController;
use App\Http\Controllers\DashboardProdukController;
use App\Http\Controllers\DashboardRevisiController;
use App\Http\Controllers\DashboardTuntasController;
use App\Http\Controllers\DashboardPegawaiController;
use App\Http\Controllers\DashboardPesananController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardProduksiController;
use App\Http\Controllers\DashboardKeranjangController;
use App\Http\Controllers\DashboardVerifikasiController;

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

Route::get('/typehead_autocomplate/action', [SearchController::class, 'autocompleteSearch'])->name('typehead_autocomplate.action');




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
Route::post('/dashboard/data-terlaris', [DashboardController::class, 'dataProdukTerlaris']);
// end cetak pertanggal

// tampil halaman laporan
Route::get('/dashboard/laporan/pesanan', [LaporanController::class, 'index'])->middleware('auth');

// login
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// searching method
// customer
Route::post('/getcustomer', [SearchController::class, 'getcustomer'])->name('getcustomer');
Route::post('/gettelpon', [SearchController::class, 'gettelpon'])->name('gettelpon');
// produk
Route::post('/data-produk', [SearchController::class, 'dataproduk'])->name('data-produk');
// Route::post('/foto-produk', [SearchController::class, 'fotoproduk'])->name('foto-produk');
Route::post('/data-kategori', [SearchController::class, 'datakategori'])->name('data-kategori');
// kain
Route::post('/data-kain', [SearchController::class, 'datakain'])->name('data-kain');
// akhir searching


// proses order
Route::get('/dashboard/batal/pesan', [DashboardKeranjangController::class, 'batal'])->middleware('auth');
Route::get('/dashboard/batal/pesan/{keranjang:id}', [DashboardKeranjangController::class, 'showbatal'])->middleware('auth');
Route::get('/dashboard/order', [DashboardKeranjangController::class, 'index'])->middleware('auth');
Route::get('/dashboard/order/create', [DashboardKeranjangController::class, 'create'])->middleware('auth');
Route::post('/dashboard/order/store', [DashboardKeranjangController::class, 'store'])->middleware('auth');
Route::get('/dashboard/order/create/{keranjang:id}', [DashboardKeranjangController::class, 'tambahpesanan'])->middleware('auth');
Route::post('/dashboard/order/pesanan', [DashboardKeranjangController::class, 'storepesanan'])->middleware('auth');
Route::get('/dashboard/order/show/{keranjang:id}', [DashboardKeranjangController::class, 'show'])->middleware('auth');
Route::get('/dashboard/order/edit/{keranjang:id}', [DashboardKeranjangController::class, 'editkeranjang'])->middleware('auth');
Route::put('/dashboard/order/editkeranjang/{keranjang:id}', [DashboardKeranjangController::class, 'updatekeranjang'])->middleware('auth');
Route::put('/dashboard/order/batal/{keranjang:id}', [DashboardKeranjangController::class, 'batalpesan'])->middleware('auth');
Route::get('/dashboard/order/edit/pesanan/{pesanan:id}', [DashboardKeranjangController::class, 'editpesanan'])->middleware('auth');
Route::put('/dashboard/order/edit/pesanansave/{pesanan:id}', [DashboardKeranjangController::class, 'editpesanansave'])->middleware('auth');
Route::get('/dashboard/order/invoice/{keranjang:id}', [LaporanController::class, 'invoice'])->middleware('auth');
// Route::get('/dashboard/order/test', [DashboardKeranjangController::class, 'test'])->middleware('auth');
// akhir code proses order

// proses produksi
Route::get('/dashboard/prosesproduksi', [DashboardProduksiController::class, 'index'])->middleware('auth');
Route::get('/dashboard/prosesproduksi/mulai/{keranjang:id}', [DashboardProduksiController::class, 'mulaiproduksi'])->middleware('auth');
Route::post('/dashboard/prosesproduksi/mulai/klik/{keranjang:id}', [DashboardProduksiController::class, 'saveproduksi'])->middleware('auth');
Route::get('/dashboard/prosesproduksi/edit/{pesanan:id}', [DashboardProduksiController::class, 'edit']);
Route::put('/dashboard/prosesproduksi/update/{pesanan:id}', [DashboardProduksiController::class, 'update']);
Route::get('/dashboard/prosesproduksi/lihatrincian/{pesanan:id}', [DashboardProduksiController::class, 'lihatrincian']);
Route::get('/dashboard/keranjang/produksi/proses', [DashboardProduksiController::class, 'produksiberlangsung'])->middleware('auth');
Route::get('/dashboard/keranjang/produksi/prosesselesai/{produksi:id}', [DashboardProduksiController::class, 'selesai_produksi'])->middleware('auth');
Route::get('/dashboard/batal/produksi/detail/{produksi:id}', [DashboardProduksiController::class, 'detail_batal_produksi'])->middleware('auth');
Route::get('/dashboard/prosesproduksi/modalselesai/{pesanan:id}', [DashboardProduksiController::class, 'modalselesai']);
Route::put('/dashboard/prosesproduksi/modalselesaisave/{pesanan:id}', [DashboardProduksiController::class, 'modalselesaisave']);
Route::post('/dashboard/prosesproduksi/simpan/{keranjang:id}', [DashboardProduksiController::class, 'selesaisimpan'])->middleware('auth');
Route::get('/dashboard/batalpengerjaan', [DashboardProduksiController::class, 'produksibatal'])->middleware('auth');
Route::get('/dashboard/barang/selesai', [DashboardProduksiController::class, 'data_selesai_produksi'])->middleware('auth');
Route::get('/dashboard/barang/selesai/detail/{produksi:id}', [DashboardProduksiController::class, 'detail_selesai_produksi'])->middleware('auth');
// akhir code proses produksi

//verifikasi
Route::get('/dashboard/verifikasi', [DashboardProduksiController::class, 'verifikasi'])->middleware('auth');
Route::get('/dashboard/verifikasi/formverif/{produksi:id}', [DashboardProduksiController::class, 'mulaiverif'])->middleware('auth');
Route::post('/dashboard/verifikasi/selesai/{keranjang:id}', [DashboardProduksiController::class, 'simpanverifikasi'])->middleware('auth');
//akhir verifikasi route

// verifikasi selesai
Route::get('/dashboard/tuntas', [DashboardProduksiController::class, 'tuntas'])->middleware('auth');
Route::get('/dashboard/tuntas/detail/{keranjang:id}', [DashboardProduksiController::class, 'detail_tuntas'])->middleware('auth');

Route::resource('/dashboard/produk', DashboardProdukController::class)->middleware('auth');

Route::resource('/dashboard/kain', DashboardKainController::class)->middleware('auth');

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
