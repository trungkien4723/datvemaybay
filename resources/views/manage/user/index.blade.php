@extends('manage.layout.app')

@section('title', 'Users')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('users.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Tạo người dùng mới</span></a>
    @endcan

    <h3>Danh sách người dùng</h3>
    <div class="row justify-content-center">
    <table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>E-Mail</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Ảnh</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->gender == 0)
                        Nam
                        @else
                        Nữ
                    @endif
                </td>
                <td>{{$user->birthday}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    @if($user->image == NULL)
                        Trống
                        @else
                        <img width="100px" height="100px" src="{{asset('images/user/'.$user->image)}}" alt="" >
                    @endif
                </td>
                @can('edit articles')
                <td><a href="{{route('users.edit',$user->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('users.destroy', $user->id)}}"  method="post">
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
        {{ $users->links() }}
    </div>

    </div>
@endsection
