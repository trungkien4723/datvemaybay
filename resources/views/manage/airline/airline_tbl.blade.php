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