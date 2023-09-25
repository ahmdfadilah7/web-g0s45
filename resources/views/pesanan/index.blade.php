@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('script_css')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

@endsection

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ url($setting->bg_header_page) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $setting->nama_website }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('home') }}">Beranda</a>
                            <span>Pesanan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="spad">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="belumdibayar-tab" data-toggle="tab" data-target="#belumdibayar" type="button" 
                                role="tab" aria-controls="belumdibayar" aria-selected="true">
                                Belum dibayar
                                <span class="badge rounded-pill badge-danger">{{ $belumbayar }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="menunggukonfirmasi-tab" data-toggle="tab" data-target="#menunggukonfirmasi" type="button"
                                role="tab" aria-controls="menunggukonfirmasi" aria-selected="false">
                                Menunggu Konfirmasi
                                <span class="badge rounded-pill badge-danger">{{ $menunggukonfirmasi }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="diproses-tab" data-toggle="tab" data-target="#diproses" type="button"
                                role="tab" aria-controls="diproses" aria-selected="false">
                                Diproses
                                <span class="badge rounded-pill badge-danger">{{ $diproses }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dikirim-tab" data-toggle="tab" data-target="#dikirim" type="button"
                                role="tab" aria-controls="dikirim" aria-selected="false">
                                Dikirim
                                <span class="badge rounded-pill badge-danger">{{ $dikirim }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button"
                                role="tab" aria-controls="selesai" aria-selected="false">
                                Selesai
                                <span class="badge rounded-pill badge-danger">{{ $selesai }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="batal-tab" data-toggle="tab" data-target="#batal" type="button"
                                role="tab" aria-controls="batal" aria-selected="false">
                                Dibatalkan
                                <span class="badge rounded-pill badge-danger">{{ $batal }}</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="belumdibayar" role="tabpanel" aria-labelledby="belumdibayar-tab">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped w-100" id="table-1">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Invoice</th>
                                            <th>Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>SubTotal</th>
                                            <th>Pengiriman</th>
                                            <th>Total Invoice</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="menunggukonfirmasi" role="tabpanel" aria-labelledby="menunggukonfirmasi-tab">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped w-100" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Invoice</th>
                                            <th>Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>SubTotal</th>
                                            <th>Pengiriman</th>
                                            <th>Total Invoice</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="diproses" role="tabpanel" aria-labelledby="diproses-tab">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped w-100" id="table-3">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Invoice</th>
                                            <th>Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>SubTotal</th>
                                            <th>Pengiriman</th>
                                            <th>Total Invoice</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dikirim" role="tabpanel" aria-labelledby="dikirim-tab">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped w-100" id="table-4">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Invoice</th>
                                            <th>Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>SubTotal</th>
                                            <th>Pengiriman</th>
                                            <th>Total Invoice</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped w-100" id="table-5">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Invoice</th>
                                            <th>Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>SubTotal</th>
                                            <th>Pengiriman</th>
                                            <th>Total Invoice</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="batal" role="tabpanel" aria-labelledby="batal-tab">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped w-100" id="table-6">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Kode Invoice</th>
                                            <th>Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>SubTotal</th>
                                            <th>Pengiriman</th>
                                            <th>Total Invoice</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(function() {
        $('#table-1').dataTable({
            processing: true,
            serverSide: true,
            'ordering': 'true',
            ajax: {
                url: "{{ route('pesanan.listbelumbayar') }}",
                data: function(d) {}
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'harga_produk',
                    name: 'harga_produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_invoice',
                    name: 'total_invoice'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'status',
                    name: 'status'
                },                 
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#table-2').dataTable({
            processing: true,
            serverSide: true,
            'ordering': 'true',
            ajax: {
                url: "{{ route('pesanan.listmenunggukonfirmasi') }}",
                data: function(d) {}
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'harga_produk',
                    name: 'harga_produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_invoice',
                    name: 'total_invoice'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'status',
                    name: 'status'
                },                  
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#table-3').dataTable({
            processing: true,
            serverSide: true,
            'ordering': 'true',
            ajax: {
                url: "{{ route('pesanan.listdiproses') }}",
                data: function(d) {}
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'harga_produk',
                    name: 'harga_produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_invoice',
                    name: 'total_invoice'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'status',
                    name: 'status'
                },                  
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#table-4').dataTable({
            processing: true,
            serverSide: true,
            'ordering': 'true',
            ajax: {
                url: "{{ route('pesanan.listdikirim') }}",
                data: function(d) {}
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'harga_produk',
                    name: 'harga_produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_invoice',
                    name: 'total_invoice'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'status',
                    name: 'status'
                },                  
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#table-5').dataTable({
            processing: true,
            serverSide: true,
            'ordering': 'true',
            ajax: {
                url: "{{ route('pesanan.listselesai') }}",
                data: function(d) {}
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'harga_produk',
                    name: 'harga_produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_invoice',
                    name: 'total_invoice'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'status',
                    name: 'status'
                },         
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#table-6').dataTable({
            processing: true,
            serverSide: true,
            'ordering': 'true',
            ajax: {
                url: "{{ route('pesanan.listbatal') }}",
                data: function(d) {}
            },
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'kode_invoice',
                    name: 'kode_invoice'
                },
                {
                    data: 'produk',
                    name: 'produk'
                },
                {
                    data: 'harga_produk',
                    name: 'harga_produk'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'subtotal',
                    name: 'subtotal'
                },
                {
                    data: 'ongkir',
                    name: 'ongkir'
                },
                {
                    data: 'total_invoice',
                    name: 'total_invoice'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'status',
                    name: 'status'
                },         
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>

@endsection