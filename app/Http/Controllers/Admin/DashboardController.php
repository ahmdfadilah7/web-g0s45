<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        $setting = Setting::first();
        if (Auth::user()->role == 'admin') {

            $produk = Produk::orderBy('id', 'DESC')->get();
            $totalpenjualan = Invoice::where('status', 4)
                ->get();
            $jumlahpenjualan = Invoice::where('status', 4)
                ->count();
            $jumlahpesanan = Invoice::where('status', '<>', 0)
                ->count();
            $belumbayar = Invoice::where('status', 1)
                ->where('konfirmasi', 0)->count();
            $menunggukonfirmasi = Invoice::where('status', 1)
                ->where('konfirmasi', 1)->count();
            $diproses = Invoice::where('status', 2)
                ->count();
            $dikirim = Invoice::where('status', 3)
                ->count();
            $selesai = Invoice::where('status', 4)
                ->count();
            $batal = Invoice::where('status', 5)
                ->count();

        } elseif (Auth::user()->role == 'petani') {
            $produk = Produk::where('user_id', Auth::guard('petani')->user()->id)->orderBy('id', 'DESC')->get();
            
            $produk_id = array();
            foreach($produk as $row) {
                if (isset($produk_id[$row->id])) {
                    $produk_id[$row->id] .= $row->id;
                } else {
                    $produk_id[$row->id] = $row->id;
                }
            }

            $transaksi = Transaksi::select('invoice_id')->whereIn('produk_id', $produk_id)->groupBY('invoice_id')->get();
            $invoice_id = array();
            foreach($transaksi as $row) {
                if (isset($invoice_id[$row->invoice_id])) {
                    $invoice_id[$row->invoice_id] .= $row->invoice_id;
                } else {
                    $invoice_id[$row->invoice_id] = $row->invoice_id;
                }
            }
            
            $totalpenjualan = Invoice::whereIn('id', $invoice_id)
                ->where('status', 4)
                ->get();
            $jumlahpenjualan = Invoice::whereIn('id', $invoice_id)
                ->where('status', 4)
                ->count();
            $jumlahpesanan = Invoice::whereIn('id', $invoice_id)
                ->where('status', '<>', 0)
                ->count();
            $belumbayar = Invoice::whereIn('id', $invoice_id)
                ->where('status', 1)
                ->where('konfirmasi', 0)->count();
            $menunggukonfirmasi = Invoice::whereIn('id', $invoice_id)
                ->where('status', 1)
                ->where('konfirmasi', 1)->count();
            $diproses = Invoice::whereIn('id', $invoice_id)
                ->where('status', 2)
                ->count();
            $dikirim = Invoice::whereIn('id', $invoice_id)
                ->where('status', 3)
                ->count();
            $selesai = Invoice::whereIn('id', $invoice_id)
                ->where('status', 4)
                ->count();
            $batal = Invoice::whereIn('id', $invoice_id)
                ->where('status', 5)
                ->count();

        }
        
        return view('admin.dashboard.index', compact(
                'setting', 
                'produk', 
                'jumlahpenjualan', 
                'jumlahpesanan', 
                'totalpenjualan', 
                'belumbayar', 
                'menunggukonfirmasi', 
                'diproses', 
                'dikirim', 
                'selesai', 
                'batal',
            ));
    }
}
