<?php

use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\BiayaAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriProdukController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\PengirimanController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PetaniController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\RekeningController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TentangController as AdminTentangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TentangController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('produk', [ProdukController::class, 'index'])->name('produk');
Route::get('produk/search', [ProdukController::class, 'search'])->name('produk.search');
Route::get('produk/komoditas/{slug}', [ProdukController::class, 'komoditas'])->name('produk.komoditas');
Route::get('produk/detail/{slug}', [ProdukController::class, 'show'])->name('produk.detail');
Route::get('tentang', [TentangController::class, 'index'])->name('tentang');
Route::get('kontak', [KontakController::class, 'index'])->name('kontak');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proseslogin', [AuthController::class, 'proses_login'])->name('prosesLogin');
Route::post('prosesregister', [AuthController::class, 'proses_register'])->name('prosesRegister');
Route::get('logout/{slug}', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth:pelanggan', 'role:pelanggan']], function(){

    Route::get('keranjang', [KeranjangController::class, 'index'])->name('keranjang');
    Route::post('keranjang/store', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::get('keranjang/checkout/{kode_invoice}', [KeranjangController::class, 'checkout'])->name('keranjang.checkout');
    Route::get('keranjang/pengiriman/{pengiriman}/{kode_invoice}', [KeranjangController::class, 'pengiriman'])->name('keranjang.pengiriman');
    Route::get('keranjang/invoice/{kode_invoice}', [KeranjangController::class, 'invoice'])->name('keranjang.invoice');
    Route::post('keranjang/prosesInvoice/{kode_invoice}', [KeranjangController::class, 'proses_invoice'])->name('keranjang.prosesInvoice');
    Route::get('keranjang/bayar/{kode_invoice}', [KeranjangController::class, 'bayar'])->name('keranjang.bayar');
    Route::post('keranjang/prosesPembayaran', [KeranjangController::class, 'proses_pembayaran'])->name('keranjang.prosesPembayaran');
    Route::post('keranjang/updateJumlah/{id}', [KeranjangController::class, 'update_jumlah'])->name('keranjang.updatejumlah');
    Route::get('keranjang/delete/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.delete');

    Route::get('pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('pesanan/invoice/{kode_invoice}', [PesananController::class, 'invoice'])->name('pesanan.invoice');
    Route::get('pesanan/getListBelumBayar', [PesananController::class, 'listBelumBayar'])->name('pesanan.listbelumbayar');
    Route::get('pesanan/getListMenungguKonfirmasi', [PesananController::class, 'listMenungguKonfirmasi'])->name('pesanan.listmenunggukonfirmasi');
    Route::get('pesanan/getListDiproses', [PesananController::class, 'listDiproses'])->name('pesanan.listdiproses');
    Route::get('pesanan/getListDikirim', [PesananController::class, 'listDikirim'])->name('pesanan.listdikirim');
    Route::get('pesanan/getListSelesai', [PesananController::class, 'listSelesai'])->name('pesanan.listselesai');
    Route::get('pesanan/getListBatal', [PesananController::class, 'listBatal'])->name('pesanan.listbatal');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

});

Route::group(['middleware' => ['auth:petani', 'role:petani']], function(){
    
    Route::get('petani/dashboard', [DashboardController::class, 'index'])->name('petani.dashboard');

    Route::get('petani/pesanan', [AdminPesananController::class, 'index'])->name('petani.pesanan');
    Route::post('petani/pesanan/export', [AdminPesananController::class, 'export'])->name('petani.pesanan.export');
    Route::get('petani/pesanan/exportsemua', [AdminPesananController::class, 'export_semua'])->name('petani.pesanan.exportsemua');
    Route::get('petani/pesanan/invoice/{kode_invoice}', [AdminPesananController::class, 'invoice'])->name('petani.pesanan.invoice');
    Route::get('petani/pesanan/selesai/invoice/{kode_invoice}', [AdminPesananController::class, 'invoice'])->name('petani.pesanan.selesai.invoice');
    Route::get('petani/pesanan/batal/invoice/{kode_invoice}', [AdminPesananController::class, 'invoice'])->name('petani.pesanan.batal.invoice');
    Route::get('petani/pesanan/konfirmasi/{kode_invoice}', [AdminPesananController::class, 'konfirmasi'])->name('petani.pesanan.konfirmasi');
    Route::get('petani/pesanan/kirim/{kode_invoice}', [AdminPesananController::class, 'kirim'])->name('petani.pesanan.kirim');
    Route::get('petani/pesanan/diselesaikan/{kode_invoice}', [AdminPesananController::class, 'diselesaikan'])->name('petani.pesanan.diselesaikan');
    Route::get('petani/pesanan/dibatalkan/{kode_invoice}', [AdminPesananController::class, 'dibatalkan'])->name('petani.pesanan.dibatalkan');
    Route::get('petani/pesanan/selesai', [AdminPesananController::class, 'selesai'])->name('petani.pesanan.selesai');
    Route::get('petani/pesanan/batal', [AdminPesananController::class, 'batal'])->name('petani.pesanan.batal');
    Route::get('petani/pesanan/getListData', [AdminPesananController::class, 'listData'])->name('petani.pesanan.list');
    Route::get('petani/pesanan/getListSelesai', [AdminPesananController::class, 'listSelesai'])->name('petani.pesanan.listselesai');
    Route::get('petani/pesanan/getListBatal', [AdminPesananController::class, 'listBatal'])->name('petani.pesanan.listbatal');

    Route::get('petani/kategoriproduk', [KategoriProdukController::class, 'index'])->name('petani.kategoriproduk');
    Route::get('petani/kategoriproduk/getListData', [KategoriProdukController::class, 'listData'])->name('petani.kategoriproduk.list');
    Route::get('petani/kategoriproduk/add', [KategoriProdukController::class, 'create'])->name('petani.kategoriproduk.add');
    Route::post('petani/kategoriproduk/store', [KategoriProdukController::class, 'store'])->name('petani.kategoriproduk.store');
    Route::get('petani/kategoriproduk/edit/{id}', [KategoriProdukController::class, 'edit'])->name('petani.kategoriproduk.edit');
    Route::put('petani/kategoriproduk/update/{id}', [KategoriProdukController::class, 'update'])->name('petani.kategoriproduk.update');
    Route::get('petani/kategoriproduk/delete/{id}', [KategoriProdukController::class, 'destroy'])->name('petani.kategoriproduk.delete');

    Route::get('petani/produk', [AdminProdukController::class, 'index'])->name('petani.produk');
    Route::get('petani/produk/getListData', [AdminProdukController::class, 'listData'])->name('petani.produk.list');
    Route::get('petani/produk/add', [AdminProdukController::class, 'create'])->name('petani.produk.add');
    Route::post('petani/produk/store', [AdminProdukController::class, 'store'])->name('petani.produk.store');
    Route::get('petani/produk/edit/{id}', [AdminProdukController::class, 'edit'])->name('petani.produk.edit');
    Route::put('petani/produk/update/{id}', [AdminProdukController::class, 'update'])->name('petani.produk.update');
    Route::get('petani/produk/delete/{id}', [AdminProdukController::class, 'destroy'])->name('petani.produk.delete');

});

Route::group(['middleware' => ['auth:admin', 'role:admin']], function(){

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/pesanan', [AdminPesananController::class, 'index'])->name('admin.pesanan');
    Route::post('admin/pesanan/export', [AdminPesananController::class, 'export'])->name('admin.pesanan.export');
    Route::get('admin/pesanan/exportsemua', [AdminPesananController::class, 'export_semua'])->name('admin.pesanan.exportsemua');
    Route::get('admin/pesanan/invoice/{kode_invoice}', [AdminPesananController::class, 'invoice'])->name('admin.pesanan.invoice');
    Route::get('admin/pesanan/selesai/invoice/{kode_invoice}', [AdminPesananController::class, 'invoice'])->name('admin.pesanan.selesai.invoice');
    Route::get('admin/pesanan/batal/invoice/{kode_invoice}', [AdminPesananController::class, 'invoice'])->name('admin.pesanan.batal.invoice');
    Route::get('admin/pesanan/konfirmasi/{kode_invoice}', [AdminPesananController::class, 'konfirmasi'])->name('admin.pesanan.konfirmasi');
    Route::get('admin/pesanan/kirim/{kode_invoice}', [AdminPesananController::class, 'kirim'])->name('admin.pesanan.kirim');
    Route::get('admin/pesanan/diselesaikan/{kode_invoice}', [AdminPesananController::class, 'diselesaikan'])->name('admin.pesanan.diselesaikan');
    Route::get('admin/pesanan/dibatalkan/{kode_invoice}', [AdminPesananController::class, 'dibatalkan'])->name('admin.pesanan.dibatalkan');
    Route::get('admin/pesanan/selesai', [AdminPesananController::class, 'selesai'])->name('admin.pesanan.selesai');
    Route::get('admin/pesanan/batal', [AdminPesananController::class, 'batal'])->name('admin.pesanan.batal');
    Route::get('admin/pesanan/getListData', [AdminPesananController::class, 'listData'])->name('admin.pesanan.list');
    Route::get('admin/pesanan/getListSelesai', [AdminPesananController::class, 'listSelesai'])->name('admin.pesanan.listselesai');
    Route::get('admin/pesanan/getListBatal', [AdminPesananController::class, 'listBatal'])->name('admin.pesanan.listbatal');

    Route::get('admin/kategoriproduk', [KategoriProdukController::class, 'index'])->name('admin.kategoriproduk');
    Route::get('admin/kategoriproduk/getListData', [KategoriProdukController::class, 'listData'])->name('admin.kategoriproduk.list');
    Route::get('admin/kategoriproduk/add', [KategoriProdukController::class, 'create'])->name('admin.kategoriproduk.add');
    Route::post('admin/kategoriproduk/store', [KategoriProdukController::class, 'store'])->name('admin.kategoriproduk.store');
    Route::get('admin/kategoriproduk/edit/{id}', [KategoriProdukController::class, 'edit'])->name('admin.kategoriproduk.edit');
    Route::put('admin/kategoriproduk/update/{id}', [KategoriProdukController::class, 'update'])->name('admin.kategoriproduk.update');
    Route::get('admin/kategoriproduk/delete/{id}', [KategoriProdukController::class, 'destroy'])->name('admin.kategoriproduk.delete');

    Route::get('admin/produk', [AdminProdukController::class, 'index'])->name('admin.produk');
    Route::get('admin/produk/getListData', [AdminProdukController::class, 'listData'])->name('admin.produk.list');
    Route::get('admin/produk/show/{id}', [AdminProdukController::class, 'show'])->name('admin.produk.show');

    Route::get('admin/tentang', [AdminTentangController::class, 'index'])->name('admin.tentang');
    Route::get('admin/tentang/getListData', [AdminTentangController::class, 'listData'])->name('admin.tentang.list');
    Route::get('admin/tentang/add', [AdminTentangController::class, 'create'])->name('admin.tentang.add');
    Route::post('admin/tentang/store', [AdminTentangController::class, 'store'])->name('admin.tentang.store');
    Route::get('admin/tentang/edit/{id}', [AdminTentangController::class, 'edit'])->name('admin.tentang.edit');
    Route::put('admin/tentang/update/{id}', [AdminTentangController::class, 'update'])->name('admin.tentang.update');

    Route::get('admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan');
    Route::get('admin/pelanggan/getListData', [PelangganController::class, 'listData'])->name('admin.pelanggan.list');
    Route::get('admin/pelanggan/delete/{id}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.delete');

    Route::get('admin/petani', [PetaniController::class, 'index'])->name('admin.petani');
    Route::get('admin/petani/getListData', [PetaniController::class, 'listData'])->name('admin.petani.list');
    Route::get('admin/petani/add', [PetaniController::class, 'create'])->name('admin.petani.add');
    Route::post('admin/petani/store', [PetaniController::class, 'store'])->name('admin.petani.store');
    Route::get('admin/petani/edit/{id}', [PetaniController::class, 'edit'])->name('admin.petani.edit');
    Route::put('admin/petani/update/{id}', [PetaniController::class, 'update'])->name('admin.petani.update');
    Route::get('admin/petani/delete/{id}', [PetaniController::class, 'destroy'])->name('admin.petani.delete');

    Route::get('admin/administrator', [AdministratorController::class, 'index'])->name('admin.administrator');
    Route::get('admin/administrator/getListData', [AdministratorController::class, 'listData'])->name('admin.administrator.list');
    Route::get('admin/administrator/add', [AdministratorController::class, 'create'])->name('admin.administrator.add');
    Route::post('admin/administrator/store', [AdministratorController::class, 'store'])->name('admin.administrator.store');
    Route::get('admin/administrator/edit/{id}', [AdministratorController::class, 'edit'])->name('admin.administrator.edit');
    Route::put('admin/administrator/update/{id}', [AdministratorController::class, 'update'])->name('admin.administrator.update');
    Route::get('admin/administrator/delete/{id}', [AdministratorController::class, 'destroy'])->name('admin.administrator.delete');

    Route::get('admin/rekening', [RekeningController::class, 'index'])->name('admin.rekening');
    Route::get('admin/rekening/getListData', [RekeningController::class, 'listData'])->name('admin.rekening.list');
    Route::get('admin/rekening/add', [RekeningController::class, 'create'])->name('admin.rekening.add');
    Route::post('admin/rekening/store', [RekeningController::class, 'store'])->name('admin.rekening.store');
    Route::get('admin/rekening/edit/{id}', [RekeningController::class, 'edit'])->name('admin.rekening.edit');
    Route::put('admin/rekening/update/{id}', [RekeningController::class, 'update'])->name('admin.rekening.update');
    Route::get('admin/rekening/delete/{id}', [RekeningController::class, 'destroy'])->name('admin.rekening.delete');

    Route::get('admin/pengiriman', [PengirimanController::class, 'index'])->name('admin.pengiriman');
    Route::get('admin/pengiriman/getListData', [PengirimanController::class, 'listData'])->name('admin.pengiriman.list');
    Route::get('admin/pengiriman/add', [PengirimanController::class, 'create'])->name('admin.pengiriman.add');
    Route::post('admin/pengiriman/store', [PengirimanController::class, 'store'])->name('admin.pengiriman.store');
    Route::get('admin/pengiriman/edit/{id}', [PengirimanController::class, 'edit'])->name('admin.pengiriman.edit');
    Route::put('admin/pengiriman/update/{id}', [PengirimanController::class, 'update'])->name('admin.pengiriman.update');
    Route::get('admin/pengiriman/delete/{id}', [PengirimanController::class, 'destroy'])->name('admin.pengiriman.delete');

    Route::get('admin/biayaadmin', [BiayaAdminController::class, 'index'])->name('admin.biayaadmin');
    Route::get('admin/biayaadmin/getListData', [BiayaAdminController::class, 'listData'])->name('admin.biayaadmin.list');
    Route::get('admin/biayaadmin/edit/{id}', [BiayaAdminController::class, 'edit'])->name('admin.biayaadmin.edit');
    Route::put('admin/biayaadmin/update/{id}', [BiayaAdminController::class, 'update'])->name('admin.biayaadmin.update');

    Route::get('admin/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::get('admin/setting/getListData', [SettingController::class, 'listData'])->name('admin.setting.list');
    Route::get('admin/setting/edit/{id}', [SettingController::class, 'edit'])->name('admin.setting.edit');
    Route::put('admin/setting/update/{id}', [SettingController::class, 'update'])->name('admin.setting.update');

});
