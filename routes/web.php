<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\BahanMentahController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangPemesananController;
use App\Http\Controllers\HasilProduksiController;
use App\Http\Controllers\HotelMadinahController;
use App\Http\Controllers\HotelMekahController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\MitrasController;
use App\Http\Controllers\PaketUmrahController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PesawatController;
use App\Http\Controllers\SupplierController;
use App\Models\HasilProduksi;
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

Route::get('/', function () {
    $hasilProduksis = HasilProduksi::all();
    return view('index', compact('hasilProduksis'));
})->name('index');

// =============================== MITRA ===============================
Route::get('/mitra/register', [MitraController::class, 'registerPage'])->name('mitra.registerPage');
Route::post('/mitra/register', [MitraController::class, 'register'])->name('mitra.register');

Route::get('/mitra/login', [MitraController::class, 'loginPage'])->name('mitra.loginPage');
Route::post('/mitra/login', [MitraController::class, 'login'])->name('mitra.login');
Route::post('/mitra/logout', [MitraController::class, 'logout'])->name('mitra.logout');

Route::get('/mitra/dashboard', [MitraController::class, 'dashboardPage'])->name('mitra.dashboardPage');

Route::get('/mitra/pemesanan', [MitraController::class, 'pemesananPage'])->name('mitra.pemesananPage');
Route::get('/mitra/invoice', [MitraController::class, 'invoicePage'])->name('mitra.invoicePage');
Route::post('/mitra/pemesanan', [PemesananController::class, 'store'])->name('mitra.pemesanan.store');
Route::put('/mitra/pemesanan', [PemesananController::class, 'update'])->name('mitra.pemesanan.update');
Route::delete('/mitra/pemesanan', [PemesananController::class, 'destroy'])->name('mitra.pemesanan.destroy');
Route::get('/mitra/pemesanan/{id}', [MitraController::class, 'detailPemesananPage'])->name('mitra.pemesanan.details');

Route::get('/admin/pemesanan/{id}', [AdminController::class, 'detailPemesananPage'])->name('mitra.pemesanan.details');

Route::get('/admin/invoice/{id}', [AdminController::class, 'invoicePemesananPage'])->name('admin.invoice.details');

Route::get('/mitra/invoice/{id}', [MitraController::class, 'invoicePemesananPage'])->name('mitra.invoice.details');


Route::get('/admin/nota-jalan/{id}', [AdminController::class, 'notaJalanPage'])->name('admin.nota-jalan.details');

Route::get('/mitra/nota-jalan/{id}', [MitraController::class, 'notaJalanPage'])->name('mitra.nota-jalan.details');


// =============================== ADMIN ===============================
Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('admin.loginPage');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard', [AdminController::class, 'dashboardPage'])->name('admin.dashboardPage');

Route::get('/admin/barang', [AdminController::class, 'barangPage'])->name('admin.barangPage');
Route::post('/admin/barang', [BarangController::class, 'store'])->name('admin.barang.store');
Route::put('/admin/barang', [BarangController::class, 'update'])->name('admin.barang.update');
Route::delete('/admin/barang', [BarangController::class, 'destroy'])->name('admin.barang.destroy');

Route::get('/admin/pemesanan', [AdminController::class, 'pemesananPage'])->name('admin.pemesananPage');
Route::get('/admin/invoice', [AdminController::class, 'invoicePage'])->name('admin.invoicePage');
Route::get('/admin/nota-jalan', [AdminController::class, 'notaPage'])->name('admin.notaPage');
Route::get('/mitra/nota-jalan', [MitraController::class, 'notaPage'])->name('mitra.notaPage');
Route::post('/admin/pemesanan', [PemesananController::class, 'store'])->name('admin.pemesanan.store');
Route::put('/admin/pemesanan', [PemesananController::class, 'update'])->name('admin.pemesanan.update');
Route::delete('/admin/pemesanan', [PemesananController::class, 'destroy'])->name('admin.pemesanan.destroy');

Route::post('/admin/barang-pemesanan', [BarangPemesananController::class, 'store'])->name('admin.barangPemesanan.store');
Route::put('/admin/barang-pemesanan', [BarangPemesananController::class, 'update'])->name('admin.barangPemesanan.update');
Route::delete('/admin/barang-pemesanan', [BarangPemesananController::class, 'destroy'])->name('admin.barangPemesanan.destroy');
Route::delete('/mitra/barang-pemesanan', [BarangPemesananController::class, 'destroy'])->name('mitra.barangPemesanan.destroy');
Route::post('/save-purchase-order', [BarangPemesananController::class, 'savePurchaseOrder'])->name('save.purchase.order');
Route::post('/store-purchase-order', [BarangPemesananController::class, 'storePurchaseOrder'])->name('store.purchase.order');
