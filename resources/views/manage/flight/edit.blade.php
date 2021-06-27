@extends('manage.layout.app')

@section('title', 'Edit flights')

@section('content')

@if(session('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong> {{session('message')}}</strong>
        </div>
@endif


<div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Chỉnh sửa thông tin chuyến bay</div>
            <div class="form-group row">                
                <div class="card-body justify-content-center">
                    <form method="POST" action="{{ route('flights.update',$flight->id) }}"  enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="form-group row">
                            <label for="aircraft_ID" class="col-md-2 col-form-label text-md-right">{{ __('Mã máy bay') }}</label>

                            <div class="col-md-4">
                                    <select id="aircraft_ID" class="form-control @error('aircraft_ID') is-invalid @enderror" name="aircraft_ID">
                                        @foreach($aircrafts as $item)
                                            <option value="{{$item->id}}" {{$flight->aircraft_ID == $item->id ? 'selected' : ''}}>{{$item->id}}</option>
                                        @endforeach
                                    </select>

                                @error('aircraft_ID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_airport_ID" class="col-md-2 col-form-label text-md-right">{{ __('Điểm đi') }}</label>

                            <div class="col-md-4">
                                    <select id="start_airport_ID" class="form-control @error('start_airport_ID') is-invalid @enderror" name="start_airport_ID">
                                        @foreach($airports as $item)
                                            <option value="{{$item->id}}"{{$flight->start_airport_ID == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>

                                @error('start_airport_ID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_time" class="col-md-2 col-form-label text-md-right">{{ __('Thời gian khởi hành') }}</label>

                            <div class="col-md-4">
                                <input id="start_time" type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ old('start_time') ?? date('Y-m-d\TH:i:s', strtotime($flight->start_time)) }}" required autocomplete="start_time">

                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrive_airport_ID" class="col-md-2 col-form-label text-md-right">{{ __('Điểm đến') }}</label>

                            <div class="col-md-4">
                                    <select id="arrive_airport_ID" class="form-control @error('arrive_airport_ID') is-invalid @enderror" name="arrive_airport_ID">
                                        @foreach($airports as $item)
                                            <option value="{{$item->id}}" {{$flight->arrive_airport_ID == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>

                                @error('arrive_airport_ID')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="arrive_time" class="col-md-2 col-form-label text-md-right">{{ __('Thời gian đến') }}</label>

                            <div class="col-md-4">
                                <input id="arrive_time" type="datetime-local" class="form-control @error('arrive_time') is-invalid @enderror" name="arrive_time" value="{{ old('arrive_time') ?? date('Y-m-d\TH:i:s', strtotime($flight->arrive_time)) }}" required autocomplete="arrive_time">

                                @error('arrive_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">{{ __('giá vé') }}</label>

                            <div class="col-md-4">
                                <input id="price" type="text" pattern="[0-9]+" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $flight->price }}" required autocomplete="price" autofocus>

                                @error('price')
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
