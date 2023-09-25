@extends('admin.layouts.app')
@include('admin.layouts.partials.css')
@include('admin.layouts.partials.js')

@section('content')

    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.produk') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('admin.produk') }}">Produk</a></div>
            <div class="breadcrumb-item active">Lihat</div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Lihat Produk</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Petani</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama" class="form-control" value="{{ $produk->user->name }}" readonly>
                            <i class="text-danger">{{ $errors->first('nama') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Produk</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" readonly>
                            <i class="text-danger">{{ $errors->first('nama') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kategori</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="kategori" class="form-control selectric" readonly>
                                <option value="">- Pilih -</option>
                                @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}" @if($row->id==$produk->kategoriproduk_id) {{ 'selected' }} @endif>{{ $row->kategori }}</option>
                                @endforeach
                            </select>
                            <i class="text-danger">{{ $errors->first('kategori') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea name="deskripsi" class="form-control summernote-simple" id="alamat" rows="10" disabled>{{ $produk->deskripsi }}</textarea>
                            <i class="text-danger">{{ $errors->first('deskripsi') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Harga</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        RP
                                    </div>
                                </div>
                                <input type="text" name="harga" class="form-control currency" value="{{ $produk->harga }}" readonly>
                            </div>
                            <i class="text-danger">{{ $errors->first('harga') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Stok Produk</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" readonly>
                            <i class="text-danger">{{ $errors->first('stok') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                @if($produk->gambar <> '')
                                    <img src="{{ url($produk->gambar) }}" class="w-100">
                                @else
                                    <i class="text-danger">Belum ada gambar</i>                                
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar 1</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                @if($produk->gambar_1 <> '')
                                    <img src="{{ url($produk->gambar_1) }}" class="w-100">
                                @else
                                    <i class="text-danger">Belum ada gambar</i>                                
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar 2</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                @if($produk->gambar_2 <> '')
                                    <img src="{{ url($produk->gambar_2) }}" class="w-100">
                                @else
                                    <i class="text-danger">Belum ada gambar</i>                                
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar 3</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                @if($produk->gambar_3 <> '')
                                    <img src="{{ url($produk->gambar_3) }}" class="w-100">
                                @else
                                    <i class="text-danger">Belum ada gambar</i>                                
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar 4</label>
                        <div class="col-sm-12 col-md-7">
                            <div style="width: 250px">
                                @if($produk->gambar_4 <> '')
                                    <img src="{{ url($produk->gambar_4) }}" class="w-100">
                                @else
                                    <i class="text-danger">Belum ada gambar</i>                                
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <a href="{{ route('admin.produk') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        var cleaveC = new Cleave('.currency', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
        var cleaveC1 = new Cleave('.currency1', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });
    </script>

@endsection