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
                    <form method="POST" action="{{ route('bookings.update',$booking->id) }}"  enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                    <div class="form-group row">

                        <!-- Vé đặt -->
                        <div class="col">
                            <div class="form-group row">
                                <label for="flight_ID" class="col-md-4 col-form-label text-md-right">{{ __('Chọn chuyến bay') }}</label>

                                <div class="col-md-8">
                                        <select id="flight_ID" class="form-control @error('flight_ID') is-invalid @enderror" name="flight_ID">
                                            @foreach($flights as $item)
                                                <option {{ ($booking->flight_ID) == $item->id ? 'selected' : '' }} value="{{$item->id}}">
                                                    <div>Mã chuyến bay: {{$item->id}}</div>
                                                    <div>Thời gian bay: {{date("d-m-Y H:i", strtotime($item->start_time))}} - {{date("d-m-Y H:i", strtotime($item->arrive_time))}}</div>
                                                    <div>Địa điểm: {{$item->startAirport->name}} - {{$item->arriveAirport->name}}</div>
                                                </option>
                                            @endforeach
                                        </select>

                                    @error('flight_ID')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="adult" class="col-md-4 col-form-label text-md-right">{{ __('Số người lớn') }}</label>

                                <div class="col-md-8">
                                    <input id="adult" type="number" min="1" class="form-control @error('adult') is-invalid @enderror" name="adult" value="{{ old('adult')??$booking->adult }}" required autocomplete="adult" autofocus>

                                    @error('adult')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="children" class="col-md-4 col-form-label text-md-right">{{ __('Số trẻ em') }}</label>

                                <div class="col-md-8">
                                    <input id="children" type="number" min="0" class="form-control @error('children') is-invalid @enderror" name="children" value="{{ old('children')??$booking->children }}" required autocomplete="children" autofocus>

                                    @error('children')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="infant" class="col-md-4 col-form-label text-md-right">{{ __('Số em bé') }}</label>

                                <div class="col-md-8">
                                    <input id="infant" type="number" min="0" class="form-control @error('infant') is-invalid @enderror" name="infant" value="{{ old('infant')??$booking->infant }}" required autocomplete="infant" autofocus>

                                    @error('infant')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="seat_class_ID" class="col-md-4 col-form-label text-md-right">{{ __('Hạng ghế') }}</label>

                                <div class="col-md-8">
                                        <select id="seat_class_ID" class="form-control @error('seat_class_ID') is-invalid @enderror" name="seat_class_ID">
                                            @foreach($seatClasses as $item)
                                                <option {{ ($booking->seat_class_ID) == $item->id ? 'selected' : '' }} value="{{$item->id}}">
                                                    {{$item->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                    @error('seat_class_ID')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Du khách -->
                        <div class="col">
                            <div class="form-group row">
                                <label for="first_name" class="col-md-2 col-form-label text-md-right">{{ __('Họ') }}</label>

                                <div class="col-md-4">
                                    <input id="first_name" type="text" min="1" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name')??$passenger->first_name }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <label for="last_name" class="col-md-2 col-form-label text-md-right">{{ __('Tên') }}</label>

                                <div class="col-md-4">
                                    <input id="last_name" type="text" min="1" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name')??$passenger->last_name }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Giới tính') }}</label>

                                <div class="col-md-8">
                                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender">
                                        <option {{ ($passenger->gender) == 0 ? 'selected' : '' }} value="0">Nam</option>
                                        <option {{ ($passenger->gender) == 1 ? 'selected' : '' }} value="1">Nữ</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')??$passenger->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                                <div class="col-md-8">
                                    <input id="phone" type="tel" pattern="[0-9]{9,11}"class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone')??$passenger->phone }}" required autocomplete="phone">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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
