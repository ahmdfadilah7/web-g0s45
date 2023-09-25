@extends('admin.layouts.app')
@include('admin.layouts.partials.css')
@include('admin.layouts.partials.js')

@section('content')

    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ route('admin.biayaadmin') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Biaya Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ route('admin.biayaadmin') }}">Biaya Admin</a></div>
            <div class="breadcrumb-item active">Edit</div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Biaya Admin</h4>
                </div>
                <div class="card-body">
                    {!! Form::model($setting, ['method' => 'post', 'route' => ['admin.biayaadmin.update', $setting->id], 'enctype' => 'multipart/form-data']) !!}
                    @method('PUT')
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Biaya Admin</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group">
                                <input type="number" name="biaya_admin" class="form-control" value="{{ $setting->biaya_admin }}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        %
                                    </div>
                                </div>
                            </div>
                            <i class="text-danger">{{ $errors->first('biaya_admin') }}</i>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection