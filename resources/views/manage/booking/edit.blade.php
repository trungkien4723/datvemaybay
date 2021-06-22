@extends('manage.layout.app')

@section('title', 'Edit bookings')

@section('content')

@if(session('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong> {{session('message')}}</strong>
        </div>
@endif


<div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Chỉnh sửa thông tin sân bay</div>
            <div class="form-group row">                
                <div class="card-body justify-content-center">
                    <form method="POST" action="{{ route('airports.update',$airport->id) }}"  enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Tên') }}</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')??$airport->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city_ID" class="col-md-2 col-form-label text-md-right">{{ __('Thuộc thành phố') }}</label>

                            <div class="col-md-4">
                                    <select id="city_ID" class="form-control @error('city_ID') is-invalid @enderror" name="city_ID">
                                        @foreach($cities as $item)
                                            <option {{ $airport->city_ID == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>

                                @error('city_ID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cập nhật') }}
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
