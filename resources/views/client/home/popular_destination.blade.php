@extends('client.layout.app')

@section('title', 'Home')

@section('content')

<div class="container justify-content-center my-5">
    <div class="row justify-content-center">
        @foreach($cities as $item)
            <div class="col-4 m-2">
            <a href="#">
                <div class="card bg-dark text-white">
                    <img src="{{asset('images/web/background.jpg')}}" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{$item->name}}</h5>
                    </div>                
                </div>
            </a>
            </div>
        @endforeach 
    </div>    
</div>

@endsection