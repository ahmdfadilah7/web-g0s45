@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

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
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <div class="d-flex justify-content-between">
                    <h4>Order Detail</h4>
                    <h4>{{ $invoice->kode_invoice }}</h4>
                </div>
                <hr>
                {!! Form::open(['method' => 'post', 'route' => ['keranjang.prosesInvoice', $invoice->kode_invoice]]) !!}
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Nama Lengkap<span>*</span></p>
                                        <input type="text" value="{{ Auth::guard('pelanggan')->user()->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" value="{{ Auth::guard('pelanggan')->user()->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="checkout__input">
                                        <p>No Telepon<span>*</span></p>
                                        <input type="text" value="{{ Auth::guard('pelanggan')->user()->profile->no_telp }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="checkout__input">
                                        <p>Alamat<span>*</span></p>
                                        {!! Auth::guard('pelanggan')->user()->profile->alamat !!}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="checkout__input">
                                        <p>Rekening<span>*</span></p>
                                        <select name="rekening" class="form-control" id="rekening">
                                            <option value="">- Pilih -</option>
                                            @foreach($rekening as $row)
                                                <option value="{{ $row->id }}">{{ $row->bank.' - '.$row->no_rekening.' - '.$row->nama_rekening }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="checkout__input">
                                        <p>Pengiriman<span>*</span></p>
                                        <select name="pengiriman" class="form-control" id="pengiriman" onchange="myPengiriman()">
                                            <option value="0">- Pilih -</option>
                                            @foreach($pengiriman as $row)
                                                <option value="{{ $row->id }}">{{ $row->nama_pengiriman.' - '.AllHelper::rupiah($row->biaya) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Produk <span>Total</span></div>
                                <ul>

                                    @foreach($transaksi_detail as $row)
                                        @php
                                            $total[] = $row->total;
                                        @endphp
                                        <li>{{ $row->produk->nama.' x'.$row->jumlah }} <span>{{ AllHelper::rupiah($row->total) }}</span></li>
                                    @endforeach

                                </ul>
                                <div class="checkout__order__subtotal">Pengiriman <span id="ongkir">Rp0</span></div>
                                <div class="checkout__order__total">Total <span id="totalInvoice" class="text-success">{{ AllHelper::rupiah(array_sum($total)) }}</span></div>

                                <input type="hidden" name="kode_invoice" id="kodeInvoice" value="{{ $invoice->kode_invoice }}">
                                <input type="hidden" name="total_invoice" id="totalInvoiceClear" value="{{ array_sum($total) }}">
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection

@section('script')

    <script>
        function myPengiriman() {
            var id = document.getElementById('pengiriman').value;
            var id2 = document.getElementById('kodeInvoice').value;
            var url = "{{ url('keranjang/pengiriman') }}/"+id+'/'+id2;
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#ongkir').html(data.ongkir);    
                    $('#totalInvoice').html(data.total);
                    $('#totalInvoiceClear').val(data.totalclear);
                }
            });
        }
    </script>

@endsection
