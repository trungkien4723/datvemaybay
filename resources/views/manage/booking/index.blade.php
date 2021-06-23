@extends('manage.layout.app')

@section('title', 'Bookings')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('bookings.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Thêm vé đặt</span></a>
    @endcan

    <h3>Danh sách vé đặt</h3>
    <div class="row justify-content-center">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Mã vé đặt</th>
            <th>Mã chuyến bay</th>
            <th>Du khách</th>
            <th>Hạng ghế</th>
            <th>Tổng giá vé</th>
            <th>Trạng thái</th>
        </tr>
        @foreach($bookings as $booking)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$booking->id}}</td>
                <td>{{$booking->flight_ID}}</td>
                <td>
                    {{$booking->adult}} người lớn, {{$booking->children}} trẻ em, {{$booking->infant}} em bé.
                </td>
                <td>{{$booking->seatClass->name}}</td>
                <td>{{number_format($booking->total_price)}} VND</td>
                <td>{{$booking->status}}</td>
                @can('edit articles')
                <td><a href="{{route('bookings.edit',$booking->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('bookings.destroy', $booking->id)}}"  method="post">
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
        {{ $bookings->links() }}
    </div>

    </div>
@endsection
