@extends('client.layout.app')

@section('title', 'Home')

@section('content')
    @if(session('message'))
    <div class="alert alert-success text-center position-absolute end-0">
        <strong>{{session('message')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row justify-content-center" style="background-image: url('{{asset('images/web/background.jpg')}}'); padding: 2rem; background-repeat:no-repeat; background-size:100% 100%;">
        @include('client.layout.booking_form')
    </div>
@endsection
