@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')
@include('layouts.partials.hero')

@section('content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">

                    @foreach($kategori as $row)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ url($row->gambar) }}">
                                <h5><a href="{{ route('produk.komoditas', str_replace(' ', '-', $row->kategori)) }}">{{ $row->kategori }}</a></h5>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Produk</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>

                            @foreach($kategori as $row)
                                <li data-filter=".{{ strtolower(str_replace(' ', '-', $row->kategori)) }}">{{ $row->kategori }}</li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">

                @foreach($produk as $row)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ strtolower(str_replace(' ', '-', $row->kategoriproduk->kategori)) }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ url($row->gambar) }}">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        {!! Form::open(['method' => 'post', 'route' => ['keranjang.store']]) !!}
                                            <input type="hidden" name="produk_id" value="{{ $row->id }}">
                                            <input type="hidden" name="jumlah" value="1">
                                            <input type="hidden" name="harga_produk" value="{{ $row->harga }}">
                                            <button type="submit"><i class="fa fa-shopping-cart"></i></button>
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="{{ route('produk.detail', $row->slug) }}">{{ $row->nama }}</a></h6>
                                <h5>{{ AllHelper::rupiah($row->harga) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
@endsection
