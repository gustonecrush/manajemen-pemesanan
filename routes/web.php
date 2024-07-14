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

Route::get('/admin/export/suppliers', [AdminDashboardController::class, 'exportSuppliers'])->name('admin.export.suppliers');
Route::get('/admin/export/raw-materials', [AdminDashboardController::class, 'exportRawMaterials'])->name('admin.export.raw_materials');
Route::get('/admin/export/production-results', [AdminDashboardController::class, 'exportProductionResults'])->name('admin.export.production_results');


Route::get('/admin/dashboard2', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard2');
Route::get('/admin/dashboard/data', [AdminDashboardController::class, 'getData'])->name('admin.dashboard.data');
Route::get('/admin/admins', [AdminDashboardController::class, 'index'])->name('admin.admins');
Route::post('/admin/admins', [AdminDashboardController::class, 'store'])->name('admin.admins.store');
Route::put('/admin/admins', [AdminDashboardController::class, 'update'])->name('admin.admins.update');
Route::delete('/admin/admins', [AdminDashboardController::class, 'destroy'])->name('admin.admins.delete');


Route::get('/admin/login', [AdminAuthController::class, 'index']);
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::get('/admin/hotel-mekah', [HotelMekahController::class, 'index'])->name('admin.hotel-mekah');
Route::post('/admin/hotel-mekah', [HotelMekahController::class, 'store'])->name('admin.hotel-mekah.store');
Route::post('/admin/hotel-mekah/update', [HotelMekahController::class, 'update'])->name('admin.hotel-mekah.update');
Route::delete('/admin/hotel-mekah/{id}', [HotelMekahController::class, 'destroy'])->name('admin.hotel-mekah.delete');

Route::get('/admin/hotel-madinah', [HotelMadinahController::class, 'index'])->name('admin.hotel-madinah');
Route::post('/admin/hotel-madinah', [HotelMadinahController::class, 'store'])->name('admin.hotel-madinah.store');
Route::put('/admin/hotel-madinah', [HotelMadinahController::class, 'update'])->name('admin.hotel-madinah.update');
Route::delete('/admin/hotel-madinah/{id}', [HotelMadinahController::class, 'destroy'])->name('admin.hotel-madinah.delete');

Route::get('/admin/bahan-mentah', [BahanMentahController::class, 'index'])->name('admin.bahan-mentah');
Route::post('/admin/bahan-mentah', [BahanMentahController::class, 'store'])->name('admin.bahan-mentah.store');
Route::put('/admin/bahan-mentah', [BahanMentahController::class, 'update'])->name('admin.bahan-mentah.update');
Route::delete('/admin/bahan-mentah', [BahanMentahController::class, 'destroy'])->name('admin.bahan-mentah.delete');

Route::get('/admin/supplier', [SupplierController::class, 'index'])->name('admin.supplier');
Route::post('/admin/supplier', [SupplierController::class, 'store'])->name('admin.supplier.store');
Route::put('/admin/supplier', [SupplierController::class, 'update'])->name('admin.supplier.update');
Route::delete('/admin/supplier/{id}', [SupplierController::class, 'destroy'])->name('admin.supplier.delete');

Route::get('/admin/hasil-produksi', [HasilProduksiController::class, 'index'])->name('admin.hasil-produksi');
Route::post('/admin/hasil-produksi', [HasilProduksiController::class, 'store'])->name('admin.hasil-produksi.store');
Route::put('/admin/hasil-produksi', [HasilProduksiController::class, 'update'])->name('admin.hasil-produksi.update');
Route::delete('/admin/hasil-produksi', [HasilProduksiController::class, 'destroy'])->name('admin.hasil-produksi.delete');

Route::get('/admin/paket-umrah', [PaketUmrahController::class, 'index'])->name('admin.paket-umrah');
Route::post('/admin/paket-umrah', [PaketUmrahController::class, 'store'])->name('admin.paket-umrah.store');
Route::put('/admin/paket-umrah', [PaketUmrahController::class, 'update'])->name('admin.paket-umrah.update');
Route::delete('/admin/paket-umrah', [PaketUmrahController::class, 'destroy'])->name('admin.paket-umrah.delete');

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
