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

// Route::get('/', function () {
//     return view('client.landing-page.index');
// });

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Client
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Client - Gaun
    Route::resource('penyewaan-gaun', App\Http\Controllers\PenyewaanGaunController::class);
    Route::post('cari-gaun', [App\Http\Controllers\PenyewaanGaunController::class, 'cariGaun']);
    Route::post('kategori-gaun', [App\Http\Controllers\PenyewaanGaunController::class, 'filterKategori']);

    Route::get('penyewaan-gaun/create/{id}', [App\Http\Controllers\PenyewaanGaunController::class, 'create']);
    // Client - Gaun 
    Route::resource('penyewaan-perias', App\Http\Controllers\PenyewaanPeriasController::class);
    Route::get('penyewaan-perias/create/{id}', [App\Http\Controllers\PenyewaanPeriasController::class, 'create']);
    Route::post('cari-perias', [App\Http\Controllers\PenyewaanPeriasController::class, 'cariPerias']);
    Route::post('kategori-perias', [App\Http\Controllers\PenyewaanPeriasController::class, 'filterKategori']);


    // Pemesanan
    Route::resource('pemesanan-gaun', App\Http\Controllers\PemesananGaunController::class);
    Route::resource('pemesanan-perias', App\Http\Controllers\PemesananPeriasController::class);
    // Transaksi 
    Route::get('transaksi-gaun', [App\Http\Controllers\PemesananGaunController::class, 'index']);
    Route::get('transaksi-gaun/{status}', [App\Http\Controllers\PemesananGaunController::class, 'indexStatus']);
    Route::get('detail-transaksi/{id}', [App\Http\Controllers\PemesananGaunController::class, 'detailTransaksi']);


    Route::get('transaksi-perias', [App\Http\Controllers\PemesananPeriasController::class, 'index']);
    Route::get('transaksi-perias/{status}', [App\Http\Controllers\PemesananPeriasController::class, 'indexStatus']);
    Route::get('detail-transaksi-perias/{id}', [App\Http\Controllers\PemesananPeriasController::class, 'detailTransaksi']);

    Route::get('transaksi-paket', [App\Http\Controllers\PemesananPaketController::class, 'index']);
    Route::get('transaksi-paket/{status}', [App\Http\Controllers\PemesananPaketController::class, 'indexStatus']);
    Route::get('detail-transaksi-paket/{id}', [App\Http\Controllers\PemesananPaketController::class, 'detailTransaksi']);


    // Client - Perias
    Route::resource('penyewaan-mua', App\Http\Controllers\PenyewaanPeriasController::class);

    Route::resource('pembayaran-gaun', App\Http\Controllers\PembayaranGaunController::class);
    Route::get('gaun-invoice/{id}', [App\Http\Controllers\PembayaranGaunController::class,'cetakInvoice']);

    Route::resource('pembayaran-perias', App\Http\Controllers\PembayaranPeriasController::class);
    Route::get('perias-invoice/{id}', [App\Http\Controllers\PembayaranPeriasController::class,'cetakInvoice']);

    // Rating 
    Route::resource('rating-review', App\Http\Controllers\RatingReviewController::class);

    Route::get('paket/create/{id}', [App\Http\Controllers\PaketController::class, 'create']);
    Route::resource('pemesanan-paket', App\Http\Controllers\PemesananPaketController::class);
    Route::post('pembayaran-paket', [App\Http\Controllers\PemesananPaketController::class, 'pembayaranPaket']);
    Route::get('paket-invoice/{id}', [App\Http\Controllers\PemesananPaketController::class,'cetakInvoice']);


    // Jadwal
    Route::get('list-jadwal', [App\Http\Controllers\HomeController::class, 'indexJadwal']);
    Route::get('list-jadwal-ajax', [App\Http\Controllers\HomeController::class, 'indexJadwalAjax']);
    Route::get('jadwal-sort/{start}/{end}', [App\Http\Controllers\HomeController::class, 'sortByDate']);
    Route::get('get-detail-gaun/{tanggal}', [App\Http\Controllers\JadwalController::class, 'getDetailGaun']);
    Route::get('get-detail-perias/{tanggal}', [App\Http\Controllers\JadwalController::class, 'getDetailPerias']);

    Route::resource('komplain', App\Http\Controllers\KomplainController::class);
    Route::get('komplain/create/{jenis}/{id}', [App\Http\Controllers\KomplainController::class, 'create']);

    Route::resource('rating-review', App\Http\Controllers\RatingReviewController::class);
    Route::get('rating-review/create/{jenis}/{id}', [App\Http\Controllers\RatingReviewController::class, 'create']);



    // Admin
    Route::prefix('admin/')->group(function () {
        Route::resource('gaun', App\Http\Controllers\GaunController::class);
        Route::resource('gambar-gaun', App\Http\Controllers\GambarGaunController::class);
        Route::resource('perias', App\Http\Controllers\PeriasController::class);
        Route::resource('gambar-rias', App\Http\Controllers\GambarRiasController::class);
        Route::resource('hasil-rias', App\Http\Controllers\HasilRiasController::class);
        Route::resource('jadwal', App\Http\Controllers\JadwalController::class);
        Route::get('jadwals/{jenis}', [App\Http\Controllers\JadwalController::class, 'index']);
        Route::post('jadwal-ajax', [App\Http\Controllers\JadwalController::class, 'indexAjax']);
        Route::get('jadwal-sort-gaun/{sort_by}', [App\Http\Controllers\JadwalController::class, 'jadwalSortGaun']);
        Route::get('jadwal-sort-perias/{sort_by}', [App\Http\Controllers\JadwalController::class, 'jadwalSortPerias']);
        Route::get('get-detail-gaun/{tanggal}', [App\Http\Controllers\JadwalController::class, 'getDetailGaun']);
        Route::get('get-detail-perias/{tanggal}', [App\Http\Controllers\JadwalController::class, 'getDetailPerias']);
        Route::resource('kategory-perias', App\Http\Controllers\KategoryPeriasController::class);
        Route::resource('kategory-gaun', App\Http\Controllers\KategoriGaunController::class);

        // Ajax
        Route::get('gaunAjax', [App\Http\Controllers\GaunController::class, 'indexAjax']);
        Route::get('periasAjax', [App\Http\Controllers\PeriasController::class, 'indexAjax']);
        Route::get('kategoriPeriasAjax', [App\Http\Controllers\KategoryPeriasController::class, 'indexAjax']);
        Route::get('kategoriGaunAjax', [App\Http\Controllers\KategoriGaunController::class, 'indexAjax']);
        Route::get('paketAjax', [App\Http\Controllers\PaketController::class, 'indexAjax']);

        // Pemesanan
        Route::resource('pemesanan-gaun', App\Http\Controllers\PemesananGaunController::class);
        Route::resource('pemesanan-perias', App\Http\Controllers\PemesananPeriasController::class);

        // Pembayaran
        Route::resource('pembayaran-gaun', App\Http\Controllers\PembayaranGaunController::class);
        Route::resource('pembayaran-perias', App\Http\Controllers\PembayaranPeriasController::class);

        // Transaksi Gaun
        Route::get('transaksi-gaun', [App\Http\Controllers\PembayaranGaunController::class, 'index']);
        Route::get('transaksi-gaun-ajax', [App\Http\Controllers\PembayaranGaunController::class, 'indexAjax']);
        Route::post('transaksi-gaun-verify', [App\Http\Controllers\PembayaranGaunController::class, 'verifyPembayaran']);
        Route::get('transaksi-gaun-verify-form/{id}', [App\Http\Controllers\PembayaranGaunController::class, 'formVerifPembayaran']);
        // Pengambilan
        Route::get('pengambilan-gaun', [App\Http\Controllers\PembayaranGaunController::class, 'pengambilanGaun']);
        Route::get('pengambilan-gaun-ajax', [App\Http\Controllers\PembayaranGaunController::class, 'pengambilanGaunAjax']);
        Route::post('pengambilan-update-status', [App\Http\Controllers\PembayaranGaunController::class, 'updatePengambilan']);

        Route::get('pengembalian-gaun', [App\Http\Controllers\PembayaranGaunController::class, 'pengembalianGaun']);
        Route::get('pengembalian-gaun-ajax', [App\Http\Controllers\PembayaranGaunController::class, 'pengembalianGaunAjax']);
        Route::post('pengembalian-update-status', [App\Http\Controllers\PembayaranGaunController::class, 'updatePengembalian']);



        // Transaksi Perias
        Route::get('transaksi-perias', [App\Http\Controllers\PembayaranPeriasController::class, 'index']);
        Route::get('transaksi-perias-ajax', [App\Http\Controllers\PembayaranPeriasController::class, 'indexAjax']);
        Route::post('transaksi-perias-verify', [App\Http\Controllers\PembayaranPeriasController::class, 'verifyPembayaran']);
        Route::get('transaksi-perias-verify-form/{id}', [App\Http\Controllers\PembayaranPeriasController::class, 'formVerifPembayaran']);

        // Paket
        Route::resource('paket', App\Http\Controllers\PaketController::class);

        Route::get('transaksi-paket', [App\Http\Controllers\PemesananPaketController::class, 'indexTransaksi']);
        Route::get('transaksi-paket-ajax', [App\Http\Controllers\PemesananPaketController::class, 'indexTransaksiAjax']);
        Route::post('transaksi-paket-verify', [App\Http\Controllers\PemesananPaketController::class, 'verifyPembayaran']);
        Route::get('transaksi-paket-verify-form/{id}', [App\Http\Controllers\PemesananPaketController::class, 'formVerifPembayaran']);
        Route::get('transaksi-paket-detail/{id}', [App\Http\Controllers\PemesananPaketController::class, 'detailTransaksiAdmin']);
    });
});
