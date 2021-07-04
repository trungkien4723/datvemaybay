@extends('manage.layout.app')

@section('title', 'Dashboard')

@section('content')
    <a href="{{route('home')}}">Xem trang chủ website</a>
    <div class="mt-5">
        @include('manage.layout.booking_chart')
    </div>
@endsection
