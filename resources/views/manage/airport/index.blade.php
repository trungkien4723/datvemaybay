@extends('manage.layout.app')

@section('title', 'Airports')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('airports.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Thêm sân bay</span></a>
    @endcan

    <h3>Danh sách sân bay</h3>
    <div class="row justify-content-center table-responsive">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Thuộc thành phố</th>
        </tr>
        @foreach($airports as $airport)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$airport->name}}</td>
                <td>{{$airport->city->name}}</td>
                @can('edit articles')
                <td><a href="{{route('airports.edit',$airport->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('airports.destroy', $airport->id)}}"  method="post">
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
        {{ $airports->links() }}
    </div>

    </div>
@endsection
