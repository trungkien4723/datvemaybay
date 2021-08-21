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