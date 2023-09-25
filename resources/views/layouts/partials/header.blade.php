<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{ route('home') }}"><img src="{{ url($setting->logo) }}" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            <li><a href="{{ route('keranjang') }}"><i class="fa fa-shopping-bag"></i> <span>{{ $transaksi }}</span></a></li>
            @if(Auth::guard('pelanggan')->user() <> '')
                <li>
                    <a href="{{ route('profile') }}" class="header__cart__price text-black">
                        <i class="fa fa-user"></i> {{ Auth::guard('pelanggan')->user()->name }}
                    </a>
                    <ul class="header__menu__dropdown text-left">
                        <li><a href="{{ route('profile') }}">Profile</a></li>
                        <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            @if(Auth::guard('pelanggan')->user() == '')
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
            @else
                <a href="{{ route('logout', Auth::guard('pelanggan')->user()->role) }}"><i class="fa fa-sign-out"></i> Logout</a>
            @endif
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li @if(Request::segment(1)=='home' || Request::segment(1)=='') class="active" @endif><a href="{{ route('home') }}">Beranda</a></li>
            <li @if(Request::segment(1)=='produk') class="active" @endif><a href="{{ route('produk') }}">Produk</a></li>
            <li @if(Request::segment(1)=='tentang') class="active" @endif><a href="{{ route('tentang') }}">Tentang Kami</a></li>
            <li @if(Request::segment(1)=='kontak') class="active" @endif><a href="{{ route('kontak') }}">Kontak</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="{{ $setting->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="{{ $setting->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
        <a href="{{ $setting->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
        <a href="{{ $setting->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
            <li>{{ $setting->nama_website }}</li>
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
                            <li>{{ $setting->nama_website }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{{ $setting->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="{{ $setting->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="{{ $setting->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="{{ $setting->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            @if(Auth::guard('pelanggan')->user() == '')
                                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
                            @else
                                <a href="{{ route('logout', Auth::guard('pelanggan')->user()->role) }}"><i class="fa fa-sign-out"></i> Logout</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ url($setting->logo) }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li @if(Request::segment(1)=='home' || Request::segment(1)=='') class="active" @endif><a href="{{ route('home') }}">Beranda</a></li>
                        <li @if(Request::segment(1)=='produk') class="active" @endif><a href="{{ route('produk') }}">Produk</a></li>
                        <li @if(Request::segment(1)=='tentang') class="active" @endif><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                        <li @if(Request::segment(1)=='kontak') class="active" @endif><a href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart header__menu">
                    <ul>
                        <li><a href="{{ route('keranjang') }}"><i class="fa fa-shopping-basket"></i> <span>{{ $transaksi }}</span></a></li>
                        @if(Auth::guard('pelanggan')->user() <> '')
                            <li>
                                <a href="{{ route('profile') }}" class="header__cart__price text-black">
                                    <i class="fa fa-user"></i> {{ Auth::guard('pelanggan')->user()->name }}
                                </a>
                                <ul class="header__menu__dropdown text-left">
                                    <li><a href="{{ route('profile') }}">Profile</a></li>
                                    <li><a href="{{ route('pesanan') }}">Pesanan</a></li>
                                    <li><a href="{{ route('logout', Auth::guard('pelanggan')->user()->role) }}">Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->
