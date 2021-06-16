@extends('client.layout.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center" style="background-color: #B0E0E6; padding: 2rem;">
        @include('client.layout.booking_form')
    </div>
@endsection
