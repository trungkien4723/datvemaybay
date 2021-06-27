@extends('client.layout.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center" style="background-image: url('{{asset('images/web/background.jpg')}}'); padding: 2rem; background-repeat:no-repeat; background-size:100% 100%;">
        @include('client.layout.booking_form')
    </div>
@endsection
