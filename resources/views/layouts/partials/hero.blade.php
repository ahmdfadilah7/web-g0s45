@section('hero_section')
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Semua</span>
                        </div>
                        <ul>

                            @foreach($kategori as $row)
                                <li><a href="{{ route('produk.komoditas', str_replace(' ', '-', $row->kategori)) }}">{{ $row->kategori }}</a></li>
                            @endforeach
    
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            {!! Form::open(['method' => 'get', 'route' => ['produk.search']]) !!}
                                <input type="text" name="keyword" placeholder="Cari Produk?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            {!! Form::close() !!}
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>{{ $setting->no_telp }}</h5>
                                <span>{{ $setting->nama_website }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="{{ url($setting->bg_header_home) }}">
                        <div class="hero__text">
                            <span>{{ $setting->nama_website }}</span>
                            <h2>{{ $setting->judul_header_home }}</h2>
                            <a href="{{ route('produk') }}" class="primary-btn">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
@endsection
