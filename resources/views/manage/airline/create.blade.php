@extends('manage.layout.app')

@section('title', 'Create airlines')

@section('content')

@if(session('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong> {{session('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
@endif


    <div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Thêm hãng hàng không</div>
            <div class="form-group row">                
                <div class="card-body justify-content-center">
                    <form method="POST" action="{{ route('airlines.store') }}"  enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Logo') }}</label>

                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview img-thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;"></div>
                                <div>
                                    <span class="btn btn-outline-primary btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                    <input type="file" name="image">
                                    </span>
                                    <a href="#" class="btn btn-outline-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Tên') }}</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="short_name" class="col-md-2 col-form-label text-md-right">{{ __('Tên viết tắt') }}</label>

                            <div class="col-md-4">
                                <input id="short_name" type="text" class="form-control @error('short_name') is-invalid @enderror" name="short_name" value="{{ old('short_name') }}" required autocomplete="short_name">

                                @error('short_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Thêm') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
