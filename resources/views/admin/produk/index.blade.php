@extends('admin.layouts.app')
@include('admin.layouts.partials.css')
@include('admin.layouts.partials.js')

@section('content')

    <div class="section-header">
        <h1>Produk</h1>
        <div class="section-header-breadcrumb">
            @if(Auth::user()->role == 'petani')
                <div class="breadcrumb-item active"><a href="{{ route('petani.produk') }}">Produk</a></div>
            @else
                <div class="breadcrumb-item active"><a href="{{ route('admin.produk') }}">Produk</a></div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4>Produk</h4>
                    @if(Auth::user()->role == 'petani')
                        <a href="{{ route('petani.produk.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    @if(Auth::user()->role == 'admin')
                                        <th>Nama Petani</th>
                                    @endif
                                    <th>Nama Produk</th>
                                    <th>Gambar</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(function() {
            $('#table-1').dataTable({
                processing: true,
                serverSide: true,
                'ordering': 'true',
                ajax: {
                    @if(Auth::user()->role == 'petani')
                        url: "{{ route('petani.produk.list') }}",
                    @else
                        url: "{{ route('admin.produk.list') }}",
                    @endif
                    data: function(d) {}
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    @if (Auth::user()->role == 'admin')
                        {
                            data: 'name',
                            name: 'users.name'
                        },
                    @endif
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'harga',
                        name: 'harga'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },                    
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

@endsection
