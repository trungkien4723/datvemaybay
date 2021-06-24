@extends('manage.layout.app')

@section('title', 'Admins')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif

    @can('create admin-user')
    <a class="btn btn-primary mb-4" href="{{route('sliders.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Thêm slider</span></a>
    @endcan

    <div class="row justify-content-center">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
        </tr>
        @foreach($sliders as $slider)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$slider->name}}</td>
                <td>
                    <img src="{{asset('images/slider/'.$slider->image)}}" alt="{{$slider->descr}}" style="width:30%;">
                </td>
                <td>{{$slider->descr}}</td>
                @can('edit articles')
                <td>
                    @if($slider->status == 0)
                        <a href="{{route('active_slider', $slider->id)}}" style="text-decoration:none;"><i class="bi bi-hand-thumbs-down"></i> - Đang Ẩn</a>
                        @else
                        <a href="{{route('unactive_slider', $slider->id)}}" style="text-decoration:none;"><i class="bi bi-hand-thumbs-up"></i> - Đang kích hoạt</a>
                    @endif
                </td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('sliders.destroy', $slider->id)}}"  method="post">
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
        {{ $sliders->links() }}
    </div>

    </div>
@endsection