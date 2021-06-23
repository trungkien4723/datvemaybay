@extends('manage.layout.app')

@section('title', 'Aircrafts')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('aircrafts.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Thêm máy bay</span></a>
    @endcan

    <h3>Danh sách máy bay</h3>
    <div class="row justify-content-center">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Mã máy bay</th>
            <th>Thuộc hãng hàng không</th>
        </tr>
        @foreach($aircrafts as $aircraft)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$aircraft->id}}</td>
                <td>{{$aircraft->airline->name}}</td>
                @can('edit articles')
                <td><a href="{{route('aircrafts.edit',$aircraft->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('aircrafts.destroy', $aircraft->id)}}"  method="post">
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
        {{ $aircrafts->links() }}
    </div>

    </div>
@endsection
