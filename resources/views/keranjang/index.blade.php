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
                            <span>Keranjang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        @if($invoice <> '')
                            <h2 class="h5 text-uppercase mb-4">
                                <strong>
                                    {{ $invoice->kode_invoice }}
                                </strong>
                            </h2>
                            <h2 class="h5 text-uppercase mb-4">
                                <strong>
                                    {{ date('d M Y', strtotime($invoice->created_at)) }}
                                </strong>
                            </h2>
                        @endif
                    </div>
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @if($transaksi_detail <> '')
                                    @foreach($transaksi_detail as $row)
                                        @php
                                            $total[] = $row->total
                                        @endphp
                                        <tr>
                                            <td class="shoping__cart__item">
                                                <img src="{{ url($row->produk->gambar) }}">
                                                <h5>{{ $row->produk->nama }}</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                {{ AllHelper::rupiah($row->produk->harga) }}
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                {!! Form::open(['method' => 'post', 'route' => ['keranjang.updatejumlah', $row->id]]) !!}
                                                    <input type="hidden" name="harga_produk" value="{{ $row->produk->harga }}">
                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" name="jumlah" value="{{ $row->jumlah }}">
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </td>
                                            <td class="shoping__cart__total">
                                                {{ AllHelper::rupiah($row->total) }}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{ route('keranjang.delete', $row->id) }}">
                                                    <span class="icon_close"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('produk') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>

                @if($transaksi_detail <> '')
                    <div class="col-lg-12">
                        <div class="shoping__checkout">
                            <h5>Total Keranjang</h5>
                            <ul>
                                <li>Total <span class="text-success">{{ AllHelper::rupiah(array_sum($total)) }}</span></li>
                            </ul>
                            <a href="{{ route('keranjang.checkout', $invoice->kode_invoice) }}" class="primary-btn">CHECKOUT</a>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
