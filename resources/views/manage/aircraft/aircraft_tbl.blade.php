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
