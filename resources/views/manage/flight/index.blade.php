@extends('manage.layout.app')

@section('title', 'Flights')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('flights.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Tạo chuyến bay mới</span></a>
    @endcan

    <h3>Danh sách chuyến bay</h3>
    <div class="row justify-content-center table-responsive">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Mã máy bay</th>
            <th>Điểm đi</th>
            <th>Thời gian khởi hành</th>
            <th>Điểm đến</th>
            <th>Thời gian đến</th>
            <th>Giá vé</th>
        </tr>
        @foreach($flights as $flight)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$flight->aircraft->id}}</td>
                <td>{{$flight->startAirport->name}} ({{$flight->startAirport->city->name}})</td>
                <td>{{date("d-m-Y H:i", strtotime($flight->start_time))}}</td>
                <td>{{$flight->arriveAirport->name}} ({{$flight->arriveAirport->city->name}})</td>
                <td>{{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</td>
                <td>{{$flight->price}}</td>
                @can('edit articles')
                <td><a href="{{route('flights.edit',$flight->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('flights.destroy', $flight->id)}}"  method="post">
                        <button class="btn btn-link" type="submit" onclick="return confirm('Bạn có chắc là muốn xóa?')"><i class="fa fa-trash"></i></button>
                        @csrf
                        @method('DELETE')                        
                    </form>    
                </td>
                @endcan
            </tr>
        @endforeach
        
    </table>

    <div>
        {{ $flights->links() }}
    </div>

    </div>
@endsection
