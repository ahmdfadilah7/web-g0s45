@section('hero_section')
    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
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
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
@endsection
