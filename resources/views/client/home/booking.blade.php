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
                            @if($backDate == null)
                            <div class="col-4">
                                <span class="fa-stack text-primary">
                                    <span class="fa fa-circle-o fa-stack-2x"></span>
                                    <strong class="fa-stack-1x">
                                        1    
                                    </strong>
                                </span>
                                @if(session('flight1'))
                                    @foreach(session('flight1') as $item)
                                        $item->id
                                    @endforeach
                                @endif
                            </div>
                            @else
                            <div class="col-2">
                                <span class="fa-stack text-primary">
                                        <span class="fa fa-circle-o fa-stack-2x"></span>
                                        <strong class="fa-stack-1x">
                                            1    
                                        </strong>
                                </span>
                            </div>
                            <div class="col-2">
                                <span class="fa-stack text-primary">
                                        <span class="fa fa-circle-o fa-stack-2x"></span>
                                        <strong class="fa-stack-1x">
                                            2    
                                        </strong>
                                </span>
                            </div>
                            @endif
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
                           <div>Máy bay: {{$flight->aircraft_ID}}</div>
                           <div>{{$flight->aircraft->airline->name}}</div>
                        </div>
                        <div class="col-2">
                            <a href="{{ url('booking/add/'.$flight->id) }}" class="btn btn-warning btn-block text-center" role="button" data-url="{{route('addFlight', ['id' => $flight->id])}}">
                                Chọn
                            </a>  
                        </div>
                    </div>    
                </div>
            </div>

        </div>
        @endforeach
    </div>
<script>
    function addFlight(event){
        event.preventDefault();
        let urlFlight = $(this).data('url');
        $.ajax({
            type:"GET",
            url: urlFlight,
            dataType:'json',
            success: function($data){
                
            }
        });
    }
</script>        
@endsection
