@extends('manage.layout.app')

@section('title', 'Airlines')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('airlines.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Thêm hãng hàng không</span></a>
    @endcan

    <h3>Danh sách hãng hàng không</h3>
    <div class="row justify-content-center">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <!-- <th>Tên viết tắt</th> -->
            <th>Logo</th>
        </tr>
        @foreach($airlines as $airline)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$airline->name}}</td>
                <!-- <td>{{$airline->short_name}}</td> -->
                <td>
                    @if($airline->logo == NULL)
                        Trống
                        @else
                        <img width="100px" height="100px" src="{{asset('images/airline/'.$airline->logo)}}" alt="" >
                    @endif
                </td>
                @can('edit articles')
                <td><a href="{{route('airlines.edit',$airline->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('airlines.destroy', $airline->id)}}"  method="post">
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
        {{ $airlines->links() }}
    </div>

    </div>
@endsection
