<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Setting;
use App\Models\Tentang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    // Menampilkan halaman tentang
    public function index()
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
        $tentang = Tentang::first();

        return view('tentang.index', compact('setting', 'tentang', 'transaksi'));
    }
}
