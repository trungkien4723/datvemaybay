<!-- <div>{{empty(session('maxChoose')) ? '' : session('maxChoose')}} ||||| {{empty(session('ticket')) ? '' : count(session('ticket')) }}</div> -->
<div></div>
<div class="position-sticky container-fluid">
        <div class="row justify-content-center" style="padding: 2rem;">
            <div class="card" id="find-flight" style="width: 80rem;">
                <div class="card-body">                
                    <div class="col-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                            @php $totalPassenger = session('flightInfo')['adult'] + session('flightInfo')['children'] + session('flightInfo')['infant'] @endphp
                                <div class="my-2">Bay từ --> {{ session('flightInfo')['startCity']->name }} --> đến --> {{ session('flightInfo')['arriveCity']->name }}</div>
                                <div class="my-2">Ngày {{ session('flightInfo')['startDate'] }} @if(session('flightInfo')['backDate'])>> Ngày {{ session('flightInfo')['backDate'] }}@endif | {{ $totalPassenger }} du khách | {{ session('flightInfo')['seatClass']->name }}</div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12" id="choosed_flight">
                                @if(session('ticket'))
                                    @foreach(session('ticket') as $id => $item)
                                        <div>Mã chuyến bay: {{$item['flight_ID']}}</div>
                                        <div>Ngày khởi hành: {{ $item['start_time'] }}</div>
                                        @if(session('maxChoose') == 2)
                                            @if(count(session('ticket')) >= session('maxChoose'))
                                            <a href="#" data-url="{{route('changeFlight', ['flight_from' => $item['start_city'], 
                                                'flight_to' => $item['arrive_city'], 
                                                'seat_class' => session('flightInfo')['seatClass']->id, 
                                                'date_from' => $item['start_time'], 
                                                'date_to' => $item['arrive_time'],
                                                'adult' => session('flightInfo')['adult'],
                                                'children' => session('flightInfo')['children'],
                                                'infant' => session('flightInfo')['infant'],
                                                'key' => $item['flight_ID']])}}" role="button" class="btn btn-warning change_flight">Thay đổi</a>
                                            @endif
                                        @endif
                                    @endforeach 
                                @endif
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary" data-bs-target="#book_form_modal" data-bs-toggle="modal" data-bs-dismiss="modal">Đổi chuyến bay</button>
                                {!! $errors->first('date_from', '<div class="error-block text-danger"><strong>:message</strong></div>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <strong><span class="text-danger">
        *</span> Quy tắc giá vé: 
            <div>+ vé cho <span class="text-danger">trẻ em </span>sẽ được giảm <span class="text-danger">30%</span></div> 
            <div>+ vé cho <span class="text-danger">em bé </span>sẽ được giảm <span class="text-danger">50%</span></div>
            <div>+ vé đặt tính từ bây giờ cho đến <span class="text-danger">ngày khởi hành</span> nếu < 1 ngày sẽ có giá <span class="text-danger"> gấp 5 lần</span></div>
            <div>+ vé đặt tính từ bây giờ cho đến <span class="text-danger">ngày khởi hành</span> nếu < 10 ngày sẽ có giá <span class="text-danger"> gấp 3 lần</span></div>
            <div>+ vé đặt tính từ bây giờ cho đến <span class="text-danger">ngày khởi hành</span> nếu < 1 tháng sẽ có giá <span class="text-danger"> gấp 2 lần</span></div>  
        </strong>
        <hr class="my-5">
    </div>

    <div class="justify-content-center container-fluid text-center">
        @foreach(session('flightInfo')['flights'] as $flight)
            @php 
                $totalbooked = App\Models\Booked_seat::where('flight_ID', '=', $flight->id)->where('seat_class_id', '=', session('flightInfo')['seatClass']->id)->sum('booked_seat');
                $capacity = App\Models\Capacity::where('aircraft_ID', '=', $flight->aircraft_ID)->where('seat_class_ID', '=', session('flightInfo')['seatClass']->id)->first()
            @endphp
        @if($capacity->capacity >= ($totalbooked + $totalPassenger))    
        <div class="card my-1 mx-auto" id="find-flight">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-xs-6">
                            <div>{{date("d-m-Y H:i", strtotime($flight->start_time))}}</div>
                            <div>Từ - {{$flight->startAirport->name}} ( {{ session('flightInfo')['startCity']->name }} ) </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-6">
                            <div>{{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</div>
                            <div>Đến - {{$flight->arriveAirport->name}} ( {{ session('flightInfo')['arriveCity']->name }} ) </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-xs-12">
                           <div>Máy bay: {{$flight->aircraft_ID}}-{{$flight->aircraft->airline->name}}</div>
                           <div>mã chuyến bay: {{$flight->id}}</div>
                           @php
                                $price = $flight->price;
                                if(session('flightInfo')['seatClass']->id == 1){$price = $price * 5;}
                                else if(session('flightInfo')['seatClass']->id == 2){$price = $price * 4;}
                                else if(session('flightInfo')['seatClass']->id == 4){$price = $price * 2;}
                           @endphp
                           <div>giá: {{number_format($price)}}</div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-xs-12">
                            <a href="#"
                                class="btn btn-warning btn-block text-center add_flight" 
                                role="button"
                                data-url="{{route('addFlight', $flight->id)}}"
                                >
                                Chọn
                            </a>
                        </div>
                    </div>    
                </div>
            </div>

        </div>
        @endif
        @endforeach
    </div>

    @if(!empty(session()->get('ticket')))
        @if(count(session('ticket')) >= session()->get('maxChoose'))
            <script>
                $('#book_modal').modal('show');
            </script>
        @endif
    @endif
    <!-- modal Dat ve -->
    <div class="modal fade" id="book_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel">Xác nhận đặt vé</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body m-2">
            @if(session('ticket'))
                @foreach(session('ticket') as $id => $item)
                    <div class="row mb-2">
                        <div class="col-12 text-center">
                            {{date("d-m-Y H:i", strtotime($item['start_time']))}} >> {{date("d-m-Y H:i", strtotime($item['arrive_time']))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6"> 
                            <div class="row">Điểm khởi hành: {{$item['start_city']->name}}</div>
                            <div class="row">Điểm đến: {{$item['arrive_city']->name}}</div>
                        </div>
                        <div class="col-6">
                            giá vé = {{number_format($item['total_price'])}} ({{$totalPassenger}} du khách)
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
        <form method="POST" action="{{route('passengers.store',[
                                                                'adult' => session('flightInfo')['adult'], 
                                                                'children' => session('flightInfo')['children'], 
                                                                'infant' => session('flightInfo')['infant'], 
                                                                'seatClass' => session('flightInfo')['seatClass'],
                                                                ])}}"  
        enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
        <!-- dien thong tin nguoi lon -->
        @for($i=0; $i < session('flightInfo')['adult']; $i++)
            <h5 class="mt-4">Người lớn {{$i+1}}</h5>
            <div class="row mb-2">
                <div class="col-4">
                    <label for="first_name[]" class="col-form-label text-md-right">{{ __('Họ') }}</label>
                    <input id="first_name[]" type="text" class="form-control" name="first_name[]" required autocomplete="first_name[]" autofocus>
                    @error('first_name[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="last_name[]" class="col-form-label text-md-right">{{ __('Tên') }}</label>
                    <input id="last_name[]" type="text" class="form-control" name="last_name[]" required autocomplete="last_name[]" autofocus>
                    @error('last_name[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="gender[]" class="col-form-label text-md-right">{{ __('Giới tính') }}</label>
                    <select id="gender[]" class="form-control @error('gender[]') is-invalid @enderror" name="gender[]">
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 0 ? 'selected' : ''  }} value="0">Nam</option>
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 1 ? 'selected' : ''  }} value="1">Nữ</option>
                    </select>
                    @error('gender[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            @if($i == 0)
            <div class="row mb-2">
                <div class="col-12">
                    <label for="email[]" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>
                    <input id="email[]" type="email[]" class="form-control @error('email[]') is-invalid @enderror" name="email[]" value="{{(auth()->user()->email ?? '')}}" required autocomplete="email[]">
                    @error('email[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            @endif
            <div class="row mb-2">
                <div class="col-12">
                    <label for="phone[]" class="col-form-label text-md-right">{{ __('Số điện thoại') }}</label>
                    <input id="phone[]" type="tel" pattern="[0-9]{9,11}"class="form-control" name="phone[]" value="{{(auth()->user()->phone ?? '')}}" required autocomplete="phone[]">
                    @error('phone[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <label for="ID_number[]" class="col-form-label text-md-right">{{ __('Số CMT/CCCD') }}</label>
                    <input id="ID_number[]" type="tel" pattern="^[0-9]{9}$|^[0-9]{12}$"class="form-control @error('ID_number[]') is-invalid @enderror" name="ID_number[]" value="{{ auth()->user()->ID_number ?? '' }}" required autocomplete="ID_number[]">
                    @error('ID_number[]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        @endfor

        <!-- dien thong tin tre em -->
        @for($i=0; $i < session('flightInfo')['children']; $i++)
            <h5 class="mt-4">Trẻ em {{$i+1}}</h5>
            <div class="row mb-2">
                <div class="col-4">
                    <label for="first_name[]" class="col-form-label text-md-right">{{ __('Họ') }}</label>
                    <input id="first_name[]" type="text" class="form-control" name="first_name[]" required autocomplete="first_name[]" autofocus>
                    @error('first_name[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="last_name[]" class="col-form-label text-md-right">{{ __('Tên') }}</label>
                    <input id="last_name[]" type="text" class="form-control" name="last_name[]" required autocomplete="last_name[]" autofocus>
                    @error('last_name[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="gender[]" class="col-form-label text-md-right">{{ __('Giới tính') }}</label>
                    <select id="gender[]" class="form-control @error('gender[]') is-invalid @enderror" name="gender[]">
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 0 ? 'selected' : ''  }} value="0">Nam</option>
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 1 ? 'selected' : ''  }} value="1">Nữ</option>
                    </select>
                    @error('gender[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
        @endfor

        <!-- dien thong tin em be -->
        @for($i=0; $i < session('flightInfo')['infant']; $i++)
            <h5 class="mt-4">Em bé {{$i+1}}</h5>
            <div class="row mb-2">
                <div class="col-4">
                    <label for="first_name[]" class="col-form-label text-md-right">{{ __('Họ') }}</label>
                    <input id="first_name[]" type="text" class="form-control" name="first_name[]" required autocomplete="first_name[]" autofocus>
                    @error('first_name[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="last_name[]" class="col-form-label text-md-right">{{ __('Tên') }}</label>
                    <input id="last_name[]" type="text" class="form-control" name="last_name[]" required autocomplete="last_name[]" autofocus>
                    @error('last_name[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="gender[]" class="col-form-label text-md-right">{{ __('Giới tính') }}</label>
                    <select id="gender[]" class="form-control @error('gender[]') is-invalid @enderror" name="gender[]">
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 0 ? 'selected' : ''  }} value="0">Nam</option>
                        <option {{ (auth()->check()) && (auth()->user()->gender) == 1 ? 'selected' : ''  }} value="1">Nữ</option>
                    </select>
                    @error('gender[]')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>
            </div>
        @endfor
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-target="#book_modal" data-bs-toggle="modal" data-bs-dismiss="modal">Quay lại</button>
            <button class="btn btn-primary" type="submit">Đặt vé ngay</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    <!-- end modal Dat ve -->


    <!-- modal Doi thong tin -->
    <div class="modal fade" id="book_form_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="width:70rem;">
        <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body m-2">
            @include('client.layout.booking_form')
        </div>
        </div>
    </div>
    </div>
    <!-- end modal Doi thong tin -->
    <script>
    $(document).ready(function() {
       $('html, body').animate({scrollTop: $("#find-flight").offset().top},"slow");
    })
    </script>      

