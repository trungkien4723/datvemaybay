@extends('client.layout.app')

@section('title', 'Booking')

@section('content')
    <div class="position-sticky container-fluid">
        <div class="row justify-content-center" style="padding: 2rem;">
            <div class="card" id="find-flight" style="width: 80rem;">
                <div class="card-body">                
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-8">
                                <div class="my-2">Bay từ --> {{ $startCity->name }} --> đến --> {{ $arriveCity->name }}</div>
                                <div class="my-2">Ngày {{ $startDate }} @if($backDate)>> Ngày {{ $backDate }}@endif | {{ $totalPassenger }} du khách | {{ $seatClass->name }}</div>
                            </div>
                            <div class="col-4" id="choosed_flight">
                            @if($backDate == null)
                                @if(session()->get('ticket'))
                                    @foreach(session()->get('ticket') as $item)
                                    
                                        
                                    
                                    @endforeach
                                @endif

                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
    </div>

    <div class="justify-content-center container-fluid">
        @foreach($flights as $flight)
        <div class="card my-1" id="find-flight" style="width: 80rem;">
            <div class="card-body">
                       
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-4">
                            <div>{{date("d-m-Y H:i", strtotime($flight->start_time))}}</div>
                            <div>Từ - {{$flight->startAirport->name}} ( {{ $startCity->name }} ) </div>
                        </div>
                        <div class="col-4">
                            <div>{{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</div>
                            <div>Đến - {{$flight->arriveAirport->name}} ( {{ $arriveCity->name }} ) </div>
                        </div>
                        <div class="col-2">
                           <div>Máy bay: {{$flight->aircraft_ID}} | {{$flight->id}}</div>
                           <div>{{$flight->aircraft->airline->name}}</div>
                        </div>
                        <div class="col-2">
                            <a href="#" class="btn btn-warning btn-block text-center add_flight" 
                                role="button" 
                                data-url="{{route('addFlight', $flight->id)}}"
                                data-bs-toggle="modal" data-bs-target="#book_modal">
                                Chọn
                            </a>
                        </div>
                    </div>    
                </div>
            </div>

        </div>
        @endforeach
    </div>


    <!-- modal -->
    <div class="modal fade" id="book_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel">Xác nhận đặt vé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body m-2">
            @if(session()->get('ticket'))
                @foreach(session()->get('ticket') as $item)
                    <div class="row mb-2">
                        <div class="col-12 text-center">
                            {{date("d-m-Y H:i", strtotime($item['start_time']))}} >> {{date("d-m-Y H:i", strtotime($item['arrive_time']))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"> 
                            <div class="row">Điểm khởi hành: {{$startCity->name}}</div>
                            <div class="row">Điểm đến: {{$arriveCity->name}}</div>
                        </div>
                        <div class="col-6">
                            giá vé = {{$item['price']}} x {{$totalPassenger}} du khách = {{$item['price']*$totalPassenger}}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Hủy</button>
            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Tiếp tục</button>
        </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel2">Xác nhận thông tin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{route('passengers.store')}}"  enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="row mb-2">
                <div class="col-4">
                    <label for="first_name" class="col-form-label text-md-right">{{ __('Họ') }}</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" required autocomplete="first_name" autofocus>
                </div>
                <div class="col-4">
                    <label for="last_name" class="col-form-label text-md-right">{{ __('Tên') }}</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" required autocomplete="last_name" autofocus>
                </div>
                <div class="col-4">
                    <label for="gender" class="col-form-label text-md-right">{{ __('Giới tính') }}</label>
                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 0 ? 'selected' : ''  }} value="0">Nam</option>
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 1 ? 'selected' : ''  }} value="1">Nữ</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{(auth()->user()->email ?? '')}}" required autocomplete="email">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <label for="phone" class="col-form-label text-md-right">{{ __('Số điện thoại') }}</label>
                    <input id="phone" type="tel" pattern="[0-9]{9,11}"class="form-control" name="phone" value="{{(auth()->user()->phone ?? '')}}" required autocomplete="phone">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-target="#book_modal" data-bs-toggle="modal" data-bs-dismiss="modal">Quay lại</button>
            <button class="btn btn-primary" type="submit">Đặt vé ngay</button>
        </div>
        </form>
        </div>
    </div>
    </div>      
@endsection
