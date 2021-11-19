@extends('client.layout.app')

@section('title', 'Home')

@section('content')
<div class="text-center my-5">
@php
    $today = date("Y-m-d");
    $flight_date = date("d-m-Y H:i", strtotime($flight->start_time));
@endphp
@if($flight_date > $today)
<table class="table table-bordered my-5">
        <tr>
            <th>Mã máy bay</th>
            <th>Điểm đi</th>
            <th>Thời gian khởi hành</th>
            <th>Điểm đến</th>
            <th>Thời gian đến</th>
            <th>Giá vé</th>
        </tr>
        
            <tr>
                <td>{{$flight->aircraft->id}}</td>
                <td>{{date("d-m-Y H:i", strtotime($flight->start_time))}}</td>
                <td>{{$flight->start_time}}</td>
                <td>{{$flight->arriveAirport->name}}</td>
                <td>{{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</td>
                <td>{{$booking->total_price}}</td>
            </tr>
        
    </table>
</div>
@else
    Mã đặt chỗ cho chuyến bay này đã được thực thi và không còn trên hệ thống!
@endif
<div class="justify-content-center">
    <a href="{{route('show_my_flight_form')}}">Quay lại</a>
</div>
@endsection
