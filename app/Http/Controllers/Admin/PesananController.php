<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AllHelper;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Pembayaran;
use App\Models\Pengiriman;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PesananController extends Controller
{
    // Menampilkan halaman pesanan
    public function index()
    {
        $setting = Setting::first();

        return view('admin.pesanan.index', compact('setting'));
    }

    // Proses menampilkan data pesanan dengan datatables
    public function listData()
    {
        if (Auth::user()->role == 'petani') {
            $produk = Produk::where('user_id', Auth::guard('petani')->user()->id)->get();
            
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
            $data = Invoice::select('invoices.*')
                ->whereIn('id', $invoice_id)
                ->where('invoices.status', '<>', 0)
                ->where('invoices.status', '<>', 4)
                ->where('invoices.status', '<>', 5)
                ->orderBy('status', 'DESC')
                ->get();
        } elseif (Auth::user()->role == 'admin') {
            $data = Invoice::select('invoices.*')
                ->where('invoices.status', '<>', 0)
                ->where('invoices.status', '<>', 4)
                ->where('invoices.status', '<>', 5)
                ->orderBy('invoices.status', 'DESC');
        }
        
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
                $pengiriman = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $pengiriman;
            })
            ->addColumn('name', function($row) {
                $name = '<span class="badge badge-primary">'.$row->user->name.'</span>';
                return $name;
            })
            ->addColumn('petani', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= '<span class="badge badge-primary mb-2">'.$row->produk->user->name.'</span>';
                }
                
                return $produk;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('tanggal', function($row) {
                $tgl = date('d M Y', strtotime($row->created_at));
                return $tgl;
            })
            ->addColumn('status', function($row) {
                if ($row->status == 1 && $row->konfirmasi == 0) {
                    $status = '<span class="badge badge-danger">Belum dibayar</span>';
                } elseif ($row->status == 1 && $row->konfirmasi == 1) {
                    $status = '<span class="badge badge-warning">Menunggu konfirmasi</span>';
                } elseif ($row->status == 2) {
                    $status = '<span class="badge badge-primary">Pesanan sedang diproses</span>';
                } elseif ($row->status == 3) {
                    $status = '<span class="badge badge-info">Pesanan sedang dikirim</span>';
                }

                return $status;
            })
            ->addColumn('action', function($row) {
                if (Auth::user()->role == 'admin') {
                    $btn = '<a href="'.route('admin.pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mb-2" title="Lihat Invoice">
                            <i class="fas fa-eye"></i>
                        </a><br>';
                    if ($row->status == 1 && $row->konfirmasi == 0) {
                        $btn .= '<a href="'.route('admin.pesanan.dibatalkan', $row->kode_invoice).'" class="btn btn-danger btn-sm" title="Batalkan">
                                <i class="fas fa-times"></i>
                            </a>';
                    } elseif ($row->status == 1 && $row->konfirmasi == 1) {
                        $btn .= '<a href="'.route('admin.pesanan.konfirmasi', $row->kode_invoice).'" class="btn btn-info btn-sm mb-2" title="Konfirmasi">
                                <i class="fas fa-check"></i>
                            </a><br>';
                        $btn .= '<a href="'.route('admin.pesanan.dibatalkan', $row->kode_invoice).'" class="btn btn-danger btn-sm" title="Batalkan">
                                <i class="fas fa-times"></i>
                            </a>';
                    } elseif ($row->status == 2) {
                        $btn .= '<a href="'.route('admin.pesanan.kirim', $row->kode_invoice).'" class="btn btn-warning btn-sm" title="Kirim">
                                <i class="fas fa-arrow-alt-circle-right"></i>
                            </a>';
                    } elseif ($row->status == 3) {
                        $btn .= '<a href="'.route('admin.pesanan.diselesaikan', $row->kode_invoice).'" class="btn btn-success btn-sm" title="Selesai">
                                <i class="fas fa-check"></i>
                            </a>';
                    }
                }
                if (Auth::user()->role == 'petani') {
                    $btn = '<a href="'.route('petani.pesanan.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mb-2" title="Lihat Invoice">
                            <i class="fas fa-eye"></i>
                        </a><br>';                    
                }

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir', 'name', 'petani', 'tanggal'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman pesanan selesai
    public function selesai()
    {
        $setting = Setting::first();

        return view('admin.pesanan.selesai', compact('setting'));
    }

    // Proses menampilkan data pesanan dengan datatables
    public function listSelesai()
    {
        if (Auth::user()->role == 'petani') {
            $produk = Produk::where('user_id', Auth::guard('petani')->user()->id)->get();
            
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
            $data = Invoice::select('invoices.*')
                ->whereIn('id', $invoice_id)
                ->where('status', 4)
                ->orderBy('status', 'DESC')
                ->get();
        } elseif (Auth::user()->role == 'admin') {
            $data = Invoice::select('invoices.*')
                ->where('invoices.status', 4)
                ->orderBy('invoices.status', 'DESC');
        }

        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('bukti', function($row) {
                $pembayaran = Pembayaran::where('invoice_id', $row->id);
                if ($pembayaran->count() > 0) {
                    $bukti = '<a href="'.url($pembayaran->first()->bukti).'" target="_blank"><img src="'.url($pembayaran->first()->bukti).'" width="70"></a>';
                } else {
                    if($row->konfirmasi == 1) {
                        $bukti = '<i class="text-primary">Beli langsung di toko</i>';
                    } else {
                        $bukti = '<i class="text-danger">Belum ada bukti pembayaran</i>';
                    }
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
            ->addColumn('petani', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= '<span class="badge badge-primary mb-2">'.$row->produk->user->name.'</span>';
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
                $pengiriman = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $pengiriman;
            })
            ->addColumn('name', function($row) {
                $name = '<span class="badge badge-primary">'.$row->user->name.'</span>';
                return $name;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-success">Pesanan telah selesai</span>';

                return $status;
            })
            ->addColumn('tanggal', function($row) {
                $tgl = date('d M Y', strtotime($row->created_at));
                return $tgl;
            })
            ->addColumn('action', function($row) {
                if(Auth::user()->role == 'admin') {
                    $btn = '<a href="'.route('admin.pesanan.selesai.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                            <i class="fas fa-eye"></i>
                        </a>';
                } elseif (Auth::user()->role == 'petani') {
                    $btn = '<a href="'.route('petani.pesanan.selesai.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                            <i class="fas fa-eye"></i>
                        </a>';
                }

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir', 'name', 'petani', 'tanggal'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman pesanan selesai
    public function batal()
    {
        $setting = Setting::first();

        return view('admin.pesanan.batal', compact('setting'));
    }

    // Proses menampilkan data pesanan dengan datatables
    public function listBatal()
    {
        if (Auth::user()->role == 'petani') {
            $produk = Produk::where('user_id', Auth::guard('petani')->user()->id)->get();
            
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
            $data = Invoice::select('invoices.*')
                ->whereIn('id', $invoice_id)
                ->where('status', 5)
                ->orderBy('status', 'DESC')
                ->get();
        } elseif (Auth::user()->role == 'admin') {
            $data = Invoice::select('invoices.*')
                ->where('invoices.status', 5)
                ->orderBy('invoices.status', 'DESC');
        }
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
            ->addColumn('petani', function($row) {
                $transaksi = Transaksi::where('invoice_id', $row->id)
                    ->get();
                $produk = '';
                foreach ($transaksi as $row) {
                    $produk .= '<span class="badge badge-primary mb-2">'.$row->produk->user->name.'</span>';
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
                $pengiriman = $row->pengiriman->nama_pengiriman.' - '.AllHelper::rupiah($row->pengiriman->biaya);
                return $pengiriman;
            })
            ->addColumn('name', function($row) {
                $name = '<span class="badge badge-primary">'.$row->user->name.'</span>';
                return $name;
            })
            ->addColumn('total_invoice', function($row) {
                $hrg = AllHelper::rupiah($row->total_invoice);
                return $hrg;
            })
            ->addColumn('status', function($row) {
                $status = '<span class="badge badge-danger">Pesanan telah dibatalkan</span>';

                return $status;
            })
            ->addColumn('tanggal', function($row) {
                $tgl = date('d M Y', strtotime($row->created_at));
                return $tgl;
            })
            ->addColumn('action', function($row) {
                if (Auth::user()->role == 'admin') {
                    $btn = '<a href="'.route('admin.pesanan.batal.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                            <i class="fas fa-eye"></i>
                        </a>';
                } elseif (Auth::user()->role == 'petani') {
                    $btn = '<a href="'.route('petani.pesanan.batal.invoice', $row->kode_invoice).'" class="btn btn-primary btn-sm mr-2" title="Lihat Invoice">
                            <i class="fas fa-eye"></i>
                        </a>';
                }

                return $btn;
            })
            ->rawColumns(['action', 'status', 'total_invoice', 'bukti', 'produk', 'harga_produk', 'jumlah', 'subtotal', 'ongkir', 'name', 'petani', 'tanggal'])
            ->make(true);
        
        return $datatables;
    }

    // // Proses export excel pesanan
    // public function export(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'status' => 'required',
    //         'dari' => 'required',
    //         'sampai' => 'required',
    //     ],
    //     [
    //         'required' => ':attribute wajib diisi !!'
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();
    //         return back()->with('errors', $errors);
    //     }

    //     return (new PesananExport($request->status, $request->dari, $request->sampai))
    //         ->download('Laporan-Pesanan-'.date('dmY', strtotime($request->dari)).'-'.date('dmY', strtotime($request->sampai)).'-'.Str::random(5).'.xlsx');
    // }

    // // Proses export semua excel pesanan
    // public function export_semua(Request $request)
    // {        
    //     return (new PesananExport($request->status, $request->dari, $request->sampai))
    //         ->download('Laporan-Pesanan-Semua-'.Str::random(5).'.xlsx');
    // }

    // Proses konfirmasi pesanan
    public function konfirmasi($kode_invoice)
    {
        $invoice = Invoice::where('kode_invoice', $kode_invoice)->first();
        $invoice->status = 2;
        $invoice->save();

        return redirect()->route('admin.pesanan')->with('berhasil', 'Pesanan sedang diproses.');
    }

    // Proses kirim pesanan
    public function kirim($kode_invoice)
    {
        $invoice = Invoice::where('kode_invoice', $kode_invoice)->first();
        $invoice->status = 3;
        $invoice->save();

        return redirect()->route('admin.pesanan')->with('berhasil', 'Pesanan sedang dikirim.');
    }

    // Proses selesai pesanan
    public function diselesaikan($kode_invoice)
    {
        $invoice = Invoice::where('kode_invoice', $kode_invoice)->first();
        $invoice->status = 4;
        $invoice->save();

        $transaksi = Transaksi::where('invoice_id', $invoice->id)->get();
        foreach ($transaksi as $row) { 
            $produk = Produk::find($row->produk_id);
            $produk->stok = $produk->stok - $row->jumlah;
            $produk->save();
        }

        $setting = Setting::first();
        $saldo = ($invoice->total_invoice - $invoice->pengiriman->biaya) * $setting->biaya_admin/100;
        $setting->saldo = $setting->saldo + $saldo;
        $setting->save();

        return redirect()->route('admin.pesanan')->with('berhasil', 'Pesanan telah selesai.');
    }

    // Proses batalkan pesanan
    public function dibatalkan($kode_invoice)
    {
        $invoice = Invoice::where('kode_invoice', $kode_invoice)->first();
        $invoice->status = 5;
        $invoice->save();

        return redirect()->route('admin.pesanan')->with('berhasil', 'Pesanan telah dibatalkan.');
    }

    public function invoice($kode_invoice)
    {
        $setting = Setting::first();
        $invoice = Invoice::where('kode_invoice', $kode_invoice)
            ->first();
        if ($invoice <> '') {
            $transaksi = Transaksi::where('invoice_id', $invoice->id)->count();
            $transaksi_detail = Transaksi::where('invoice_id', $invoice->id)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $transaksi = 0;
            $transaksi_detail = '';
        }

        return view('admin.pesanan.invoice', compact('setting', 'invoice', 'transaksi', 'transaksi_detail'));
    }
}
