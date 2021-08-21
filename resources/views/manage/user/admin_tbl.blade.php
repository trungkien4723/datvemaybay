<table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>E-Mail</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Số CMT/CCCD</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Ảnh</th>
            <!-- <th>Chức vụ</th> -->
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
                <td>{{$user->ID_number}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    @if($user->image == NULL)
                        Trống
                        @else
                        <img width="100px" height="100px" src="{{asset('images/user/'.$user->image)}}" alt="">
                    @endif
                </td>
                <!-- <td>
                    {{  $user->roles()->pluck('name')->implode(' ') }}
                </td> -->
                @can('edit admin-user')
                <td><a href="{{route('users.edit',$user->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete admin-user')
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