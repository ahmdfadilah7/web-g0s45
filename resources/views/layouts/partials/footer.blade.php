<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('home') }}"><img src="{{ url($setting->logo) }}" alt=""></a>
                    </div>
                    <ul>
                        <li>Address: {!! $setting->alamat !!}</li>
                        <li>Phone: {{ $setting->no_telp }}</li>
                        <li>Email: {{ $setting->email }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Menu</h6>
                    <ul>
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('tentang') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('produk') }}">Produk</a></li>
                        <li><a href="{{ route('kontak') }}">Kontak</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Media Sosial</h6>
                    <div class="footer__widget__social">
                        <a href="{{ $setting->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{ $setting->instagram }}" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="{{ $setting->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="{{ $setting->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | <a href="{{ route('home') }}">{{ $setting->nama_website }}</a> <i class="fa fa-heart" aria-hidden="true"></i>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
