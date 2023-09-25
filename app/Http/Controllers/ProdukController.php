<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    // Menampilkan halaman produk
    public function index()
    {
        $setting = Setting::first();
        $kategori = KategoriProduk::orderBy('id', 'desc')->get();
        $produk = Produk::orderBy('id', 'desc')->simplePaginate(9);
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

        return view('produk.index', compact('setting', 'kategori', 'produk', 'transaksi'));
    }

    // Menampilkan halaman komoditas produk
    public function komoditas($slug)
    {
        $setting = Setting::first();
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
        $kategori = KategoriProduk::orderBy('id', 'desc')->get();
        $slug = str_replace('-', ' ', $slug);
        $checkkategori = KategoriProduk::where('kategori', $slug)->first();
        if ($slug == 'semua') {
            $produk = Produk::orderBy('id', 'desc')->simplePaginate(9);
        } else {
            $produk = Produk::where('kategoriproduk_id', $checkkategori->id)->orderBy('id', 'desc')->simplePaginate(9);
        }

        return view('produk.index', compact('setting', 'kategori', 'produk', 'transaksi'));
    }

    // Menampilkan halaman search produk
    public function search(Request $request)
    {
        $setting = Setting::first();
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
        $kategori = KategoriProduk::orderBy('id', 'desc')->get();
        $keyword = $request->get('keyword');
        $produk = Produk::where('nama', 'LIKE', '%'.$keyword.'%')->orWhere('slug', 'LIKE', '%'.$keyword.'%')->orderBy('id', 'desc')->simplePaginate(9);

        return view('produk.index', compact('setting', 'kategori', 'produk', 'transaksi'));
    }

    // Menampilkan halaman detail produk
    public function show($slug)
    {
        $setting = Setting::first();
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
        $kategori = KategoriProduk::orderBy('id', 'desc')->get();
        $produk = Produk::where('slug', $slug)->first();
        $produk_lain = Produk::where('slug', '<>', $slug)->get();

        return view('produk.detail', compact('setting', 'kategori', 'produk', 'produk_lain', 'transaksi'));
    }
}
