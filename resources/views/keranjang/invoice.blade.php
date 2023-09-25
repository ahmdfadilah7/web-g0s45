@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('script_css')

<style type="text/css">
    .text-secondary-d1 {
        color: #728299 !important;
    }

    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }

    .brc-default-l1 {
        border-color: #dce9f0 !important;
    }

    .ml-n1,
    .mx-n1 {
        margin-left: -.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
        margin-right: -.25rem !important;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
        color: #888a8d !important;
    }

    .text-success-m2 {
        color: #86bd68 !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-110 {
        font-size: 110% !important;
    }

    .text-blue {
        color: #478fcc !important;
    }

    .pb-25,
    .py-25 {
        padding-bottom: .75rem !important;
    }

    .pt-25,
    .py-25 {
        padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
        background-color: rgba(121, 169, 197, .92) !important;
    }

    .bgc-default-l4,
    .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }

    .w-2 {
        width: 1rem;
    }

    .text-120 {
        font-size: 120% !important;
    }

    .text-primary-m1 {
        color: #4087d4 !important;
    }

    .text-danger-m1 {
        color: #dd4949 !important;
    }

    .text-blue-m2 {
        color: #68a3d5 !important;
    }

    .text-150 {
        font-size: 150% !important;
    }

    .text-60 {
        font-size: 60% !important;
    }

    .text-grey-m1 {
        color: #7b7d81 !important;
    }

    .align-bottom {
        vertical-align: bottom !important;
    }
</style>

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
                            <a href="{{ route('keranjang') }}">Keranjang</a>
                            <span>Invoice</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div class="page-content container mb-4">
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-150">
                                <img src="{{ url($setting->logo) }}" width="50">
                                <span class="text-default-d3">{{ $setting->nama_website }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-120 text-right">
                                <span class="text-default-d3">
                                    {{ $invoice->kode_invoice }}
                                </span>
                            </div>
                            <div class="text-120 text-right">
                                <span class="text-default-d3">
                                    {{ date('d M Y', strtotime($invoice->updated_at)) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Nama Lengkap:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $invoice->user->name }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Email:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $invoice->user->email }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">No. HP:</span>
                                <span class="text-600 text-110 text-blue align-middle">{{ $invoice->user->profile->no_telp }}</span>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Alamat Pemesan:</span>
                                <div class="text-600 text-110 text-blue align-middle">{!! $invoice->user->profile->alamat !!}</div>
                            </div>                            
                        </div>
                        <div class="col-sm-6 text-right">
                            <div>
                                <span class="text-600 text-110 text-blue align-middle">{{ $setting->nama_website }}</span>
                            </div>
                            <div>
                                <span class="text-600 text-110 text-blue align-middle">{{ $setting->email }}</span>
                            </div>
                            <div>
                                <span class="text-600 text-110 text-blue align-middle">{{ $setting->no_telp }}</span>
                            </div>
                            <div>
                                <span class="text-600 text-110 text-blue align-middle">{!! $setting->alamat !!}</span>
                            </div>                            
                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-9 col-sm-5">Produk</div>
                            <div class="d-none d-sm-block col-4 col-sm-2">Jumlah</div>
                            <div class="d-none d-sm-block col-sm-2">Harga</div>
                            <div class="col-2">Total</div>
                        </div>
                        <div class="text-95 text-secondary-d3">
                            @php
                                $total = array();
                            @endphp
                            @foreach ($transaksi_detail as $key => $value)
                                @php
                                    $total[$key] = $value->total;
                                @endphp
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">{{ ++$key }}</div>
                                <div class="col-9 col-sm-5">{{ $value->produk->nama }}</div>
                                <div class="d-none d-sm-block col-2">{{ $value->jumlah }}</div>
                                <div class="d-none d-sm-block col-2 text-95">
                                    {{ AllHelper::rupiah_v2($value->produk->harga) }}
                                </div>
                                <div class="col-2 text-secondary-d2">{{ AllHelper::rupiah_v2($value->total) }}</div>
                            </div>

                            @endforeach                            
                        </div>
                        <div class="row border-b-2 brc-default-l2"></div>


                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                <div>
                                    Metode Pembayaran
                                    <p>{{ $invoice->rekening->bank.' - '.$invoice->rekening->no_rekening.' A/N '.$invoice->rekening->nama_rekening }}</p>
                                </div>
                                <div>
                                    Pengiriman
                                    <p>{{ $invoice->pengiriman->nama_pengiriman }}</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">                                
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-5 text-right">
                                        Pengiriman
                                    </div>
                                    <div class="col-7">
                                        <span class="text-150 text-success-d3 opacity-2">{{ AllHelper::rupiah_v2($invoice->pengiriman->biaya) }}</span>
                                    </div>
                                    <div class="col-5 text-right">
                                        Total Pembayaran
                                    </div>
                                    <div class="col-7">
                                        <span class="text-150 text-success-d3 opacity-2">{{ AllHelper::rupiah_v2($invoice->total_invoice) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div>
                            <span class="text-secondary-d1 text-105">Terimakasih sudah berbelanja di {{ $setting->nama_website }}</span>
                            <a onclick="bayar('{{ $invoice->kode_invoice }}')" class="btn btn-info btn-bold text-white px-4 float-right mt-3 mt-lg-0">BAYAR</a>                            
                        </div>

                        @include('keranjang.partials.pembayaran')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        function bayar(id) {
            var url = '{{ url("keranjang/bayar") }}/'+id
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#pembayaranModal').modal('show')
                    $('#totalInvoice').html(data.total)
                    $('#kodeInvoice').val(data.kode_invoice)
                    console.log(data)
                }
            });
        }
    </script>

@endsection
