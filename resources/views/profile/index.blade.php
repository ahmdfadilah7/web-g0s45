@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('script_css')

<style>
    .alamat p {
        font-size: unset;
        font-family: unset;
        font-weight: unset;
        line-height: unset;
        color: unset;
        margin: unset;
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
                            <span>Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        @if(Auth::guard('pelanggan')->user()->profile->foto <> '')
                            <img src="{{ url(Auth::guard('pelanggan')->user()->profile->foto) }}" class="w-100">
                        @else
                            <img src="" alt="{{ $setting->nama_website }}">
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">                        
                        <h3>{{ Auth::guard('pelanggan')->user()->name }}</h3>
                        <table>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td>:</td>
                                <th>{{ Auth::guard('pelanggan')->user()->profile->tmpt_lahir }}</th>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <th>{{ date('d M Y', strtotime(Auth::guard('pelanggan')->user()->profile->tgl_lahir)) }}</th>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <th>
                                    @if(Auth::guard('pelanggan')->user()->profile->jns_kelamin == 'L')
                                        Laki - Laki
                                    @elseif(Auth::guard('pelanggan')->user()->profile->jns_kelamin == 'P')
                                        Perempuan
                                    @endif      
                                </th>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <th class="alamat">
                                    {!! Auth::guard('pelanggan')->user()->profile->alamat !!}      
                                </th>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <th>{{ Auth::guard('pelanggan')->user()->email }}</th>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>:</td>
                                <th>{{ Auth::guard('pelanggan')->user()->profile->no_telp }}</th>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>:</td>
                                <th>{{ Auth::guard('pelanggan')->user()->username }}</th>
                            </tr>
                            <tr>
                                <td>
                                    <a href="{{ route('profile.edit', Auth::guard('pelanggan')->user()->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Profile</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
