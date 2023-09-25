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
                            <span>Kontak</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>No Telepon</h4>
                        <p>{{ $setting->no_telp }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Alamat</h4>
                        {!! $setting->alamat !!}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>{{ $setting->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe src="{{ $setting->google_maps }}" width="100%"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>        
    </div>
    <!-- Map End -->

    {{-- <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End --> --}}
@endsection
