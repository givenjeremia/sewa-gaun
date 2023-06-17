<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('client.landing-page.index');
});

Auth::routes();

// Client
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Client - Gaun
Route::resource('penyewaan-gaun', App\Http\Controllers\PenyewaanGaunController::class);
Route::post('cari-gaun', [App\Http\Controllers\PenyewaanGaunController::class,'cariGaun']);
Route::get('penyewaan-gaun/create/{id}', [App\Http\Controllers\PenyewaanGaunController::class,'create']);
// Client - Gaun 
Route::resource('penyewaan-perias', App\Http\Controllers\PenyewaanPeriasController::class);

// Pemesanan
Route::resource('pemesanan-gaun', App\Http\Controllers\PemesananGaunController::class);
Route::resource('pemesanan-perias', App\Http\Controllers\PemesananPeriasController::class);
// Transaksi 
Route::get('transaksi-gaun', [App\Http\Controllers\PemesananGaunController::class,'index']);
Route::get('transaksi-gaun/{status}', [App\Http\Controllers\PemesananGaunController::class,'indexStatus']);


// Client - Perias
Route::resource('penyewaan-mua', App\Http\Controllers\PenyewaanPeriasController::class);

Route::resource('pembayaran-gaun', App\Http\Controllers\PembayaranGaunController::class);


// Admin
Route::prefix('admin/')->group(function () {
    Route::resource('gaun', App\Http\Controllers\GaunController::class);
    Route::resource('gambar-gaun', App\Http\Controllers\GambarGaunController::class);
    Route::resource('perias', App\Http\Controllers\PeriasController::class);
    Route::resource('gambar-rias', App\Http\Controllers\GambarRiasController::class);
    Route::resource('hasil-rias', App\Http\Controllers\HasilRiasController::class);
    Route::resource('jadwal', App\Http\Controllers\JadwalController::class);
    Route::resource('kategory-perias', App\Http\Controllers\KategoryPeriasController::class);


    // Ajax
    Route::get('gaunAjax', [App\Http\Controllers\GaunController::class,'indexAjax']);
    Route::get('periasAjax', [App\Http\Controllers\PeriasController::class,'indexAjax']);
    Route::get('kategoriPeriasAjax', [App\Http\Controllers\KategoryPeriasController::class,'indexAjax']);


    // Pemesanan
    Route::resource('pemesanan-gaun', App\Http\Controllers\PemesananGaunController::class);
    Route::resource('pemesanan-perias', App\Http\Controllers\PemesananPeriasController::class);

    // Pembayaran
    Route::resource('pembayaran-gaun', App\Http\Controllers\PembayaranGaunController::class);
    Route::resource('pembayaran-perias', App\Http\Controllers\PembayaranPeriasController::class);

    // Transaksi Gaun
    Route::get('transaksi-gaun', [App\Http\Controllers\PembayaranGaunController::class,'index']);
    Route::get('pengambilan-gaun', [App\Http\Controllers\PembayaranGaunController::class,'pengambilanGaun']);
    Route::get('pengembalian-gaun', [App\Http\Controllers\PembayaranGaunController::class,'pengembalianGaun']);

    // Transaksi Perias
    Route::get('transaksi-perias', [App\Http\Controllers\PembayaranPeriasController::class,'index']);



});




