@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')
@include('layouts.partials.hero2')

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
                            <a href="{{ route('produk') }}">Produk</a>
                            <span>Detail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ url($produk->gambar) }}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{ url($produk->gambar) }}" src="{{ url($produk->gambar) }}" alt="">

                            @if($produk->gambar_1 <> '')
                                <img data-imgbigurl="{{ url($produk->gambar_1) }}" src="{{ url($produk->gambar_1) }}" alt="">
                            @endif
                            @if($produk->gambar_2 <> '')
                                <img data-imgbigurl="{{ url($produk->gambar_2) }}" src="{{ url($produk->gambar_2) }}" alt="">
                            @endif
                            @if($produk->gambar_3 <> '')
                                <img data-imgbigurl="{{ url($produk->gambar_3) }}" src="{{ url($produk->gambar_3) }}" alt="">
                            @endif
                            @if($produk->gambar_4 <> '')
                                <img data-imgbigurl="{{ url($produk->gambar_4) }}" src="{{ url($produk->gambar_4) }}" alt="">
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $produk->nama }}</h3>
                        <div class="product__details__price">{{ AllHelper::rupiah($produk->harga) }}</div>
                        {!! Form::open(['method' => 'post', 'route' => ['keranjang.store']]) !!}
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <input type="hidden" name="harga_produk" value="{{ $produk->harga }}">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="jumlah" value="1">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="primary-btn">Tambah Keranjang</button>
                        {!! Form::close() !!}
                        <ul>
                            <li><b>Kategori</b> <span>{{ $produk->kategoriproduk->kategori }}</span></li>
                            <li><b>Petani</b> <span>{{ $produk->user->name }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Deskripsi</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ $produk->nama }}</h6>
                                    {!! $produk->deskripsi !!}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produk Lain</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($produk_lain as $row)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ url($row->gambar) }}">
                                <ul class="product__item__pic__hover">
                                    {{-- <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li> --}}
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('produk.detail', $row->slug) }}">{{ $row->nama }}</a></h6>
                                <h5>{{ AllHelper::rupiah($row->harga) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

@endsection
