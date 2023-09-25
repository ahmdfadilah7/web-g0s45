<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Menampilkan halaman home
    public function index()
    {
        $setting = Setting::first();
        $kategori = KategoriProduk::orderBy('id', 'desc')->get();
        $produk = Produk::orderBy('id', 'desc')->limit(8)->get();
        if (Auth::guard('pelanggan')->user() <> '') {
            $invoice = Invoice::where('status', 0)->where('user_id', Auth::guard('pelanggan')->user()->id)->first();
        } else {
            $invoice = '';
        }
        if ($invoice <> '') {
            $transaksi = Transaksi::where('invoice_id', $invoice->id)->count();
        } else {
            $transaksi = 0;
        }

        return view('home.index', compact('setting', 'kategori', 'produk', 'invoice', 'transaksi'));
    }
}
