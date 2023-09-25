<?php

namespace App\Http\Controllers;

use App\Helpers\AllHelper;
use App\Models\Invoice;
use App\Models\Pembayaran;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PesananController extends Controller
{
    // Menampilkan halaman pesanan
    public function index()
    {
        $setting = Setting::first();
        $invoice = Invoice::where('status', 0)->where('user_id', Auth::guard('pelanggan')->user()->id)->first();
        if ($invoice <> '') {
            $transaksi = Transaksi::where('invoice_id', $invoice->id)->count();
        } else {
            $transaksi = 0;
        }
        $belumbayar = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 1)
            ->where('konfirmasi', 0)->count();
        $menunggukonfirmasi = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 1)
            ->where('konfirmasi', 1)->count();
        $diproses = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 2)
            ->count();
        $dikirim = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 3)
            ->count();
        $selesai = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 4)
            ->count();
        $batal = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 5)
            ->count();

        return view('pesanan.index', compact('setting', 'invoice', 'transaksi', 'belumbayar', 'menunggukonfirmasi', 'diproses', 'dikirim', 'selesai', 'batal'));
    }

    // Proses menampilkan data transaksi dengan datatable
    public function listBelumBayar()
    {
        $data = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 1)
            ->where('konfirmasi', 0);
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                }
                return $bukti;
            })
            ->addColumn('produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $value) {
                    $produk .= $value->produk->nama.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('harga_produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->produk->harga).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('jumlah', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $value) {
                    $produk .= $value->jumlah.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('subtotal', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->total).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('ongkir', function($row) {
                $hrg = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $hrg;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-danger">Pesanan belum dibayar</span>';

                return $status;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mb-2" title="Lihat Invoice" style="margin-right: 10px">
                        <i class="fa fa-eye"></i>
                    </a>';
                $btn .= '<a href="'.route('keranjang.invoice', $row->kode_invoice).'" class="btn btn-success btn-sm mr-2" title="Bayar">
                        <i class="fa fa-file"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menampilkan data transaksi dengan datatable
    public function listMenungguKonfirmasi()
    {
        $data = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 1)
            ->where('konfirmasi', 1);
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                }
                return $bukti;
            })
            ->addColumn('produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->produk->nama.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('harga_produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->produk->harga).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('jumlah', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->jumlah.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('subtotal', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->total).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('ongkir', function($row) {
                $hrg = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $hrg;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-primary">Menunggu Konfirmasi</span>';

                return $status;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                        <i class="fa fa-eye"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menampilkan data transaksi dengan datatable
    public function listDiproses()
    {
        $data = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 2);
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                }
                return $bukti;
            })
            ->addColumn('produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->produk->nama.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('harga_produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->produk->harga).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('jumlah', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->jumlah.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('subtotal', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->total).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('ongkir', function($row) {
                $hrg = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $hrg;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-primary">Pesanan sedang diproses</span>';

                return $status;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                        <i class="fa fa-eye"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menampilkan data transaksi dengan datatable
    public function listDikirim()
    {
        $data = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 3);
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                }
                return $bukti;
            })
            ->addColumn('produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->produk->nama.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('harga_produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->produk->harga).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('jumlah', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->jumlah.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('subtotal', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->total).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('ongkir', function($row) {
                $hrg = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $hrg;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-warning">Pesanan sedang dikirim</span>';

                return $status;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                        <i class="fa fa-eye"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menampilkan data transaksi dengan datatable
    public function listSelesai()
    {
        $data = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 4);
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                }
                return $bukti;
            })
            ->addColumn('produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->produk->nama.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('harga_produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->produk->harga).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('jumlah', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->jumlah.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('subtotal', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->total).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('ongkir', function($row) {
                $hrg = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $hrg;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-success">Pesanan telah selesai</span>';

                return $status;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                        <i class="fa fa-eye"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Proses menampilkan data transaksi dengan datatable
    public function listBatal()
    {
        $data = Invoice::where('user_id', Auth::guard('pelanggan')->user()->id)
            ->where('status', 5);
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                }
                return $bukti;
            })
            ->addColumn('produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->produk->nama.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('harga_produk', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->produk->harga).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('jumlah', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= $row->jumlah.'<br>';
                }
                
                return $produk;
            })
            ->addColumn('subtotal', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= AllHelper::rupiah($row->total).'<br>';
                }
                
                return $produk;
            })
            ->addColumn('ongkir', function($row) {
                $hrg = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $hrg;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-danger">Pesanan telah dibatalkan</span>';

                return $status;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                        <i class="fa fa-eye"></i>
                    </a>';

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman invoice
    public function invoice($kode_invoice)
    {
        $setting = Setting::first();
        $invoice = Invoice::where('kode_invoice', $kode_invoice)
            ->first();
        $invoice_1 = Invoice::where('status', 0)->where('user_id', Auth::guard('pelanggan')->user()->id)->first();
        if ($invoice_1 <> '') {
            $transaksi = Transaksi::where('invoice_id', $invoice_1->id)->count();
        } else {
            $transaksi = 0;
        }
        if ($invoice <> '') {
            $transaksi_detail = Transaksi::where('invoice_id', $invoice->id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $transaksi_detail = '';
        }

        return view('pesanan.invoice', compact('setting', 'invoice', 'transaksi', 'transaksi_detail'));
    }
}
