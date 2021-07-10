@extends('client.layout.app')

@section('title', 'Home')

@section('content')
<form method="GET" action="{{route('show_my_flight')}}">
    <div class="row text-center">     
        <div class="col-12 text-center">
            <img src="{{asset('images/web/logo.png')}}" alt="..." width="500px">
        </div>
        <div class ="col-12 my-5 text-center bg-light bg-gradient">
            <label for="booking_key">Mã đặt vé</label>
            <input type="text" name="booking_key" id="booking_key" required>
            <button type="submit" class="btn btn-primary">
                        {{ __('Xem chuyến bay') }}
            </button>
        </div>
        @if(session('message'))
        <p style="color:red;">{{session('message')}} </p>
        @endif
    </div>
</form>
@endsection
