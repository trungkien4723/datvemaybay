<table  class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Mã máy bay</th>
            <th>Điểm đi</th>
            <th>Thời gian khởi hành</th>
            <th>Điểm đến</th>
            <th>Thời gian đến</th>
            <th>Giá vé</th>
        </tr>
        @foreach($flights as $flight)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$flight->aircraft->id}}</td>
                <td>{{$flight->startAirport->name}} ({{$flight->startAirport->city->name}})</td>
                <td>{{date("d-m-Y H:i", strtotime($flight->start_time))}}</td>
                <td>{{$flight->arriveAirport->name}} ({{$flight->arriveAirport->city->name}})</td>
                <td>{{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</td>
                <td>{{$flight->price}}</td>
                @can('edit articles')
                <td><a href="{{route('flights.edit',$flight->id)}}"><i class="bi bi-pencil"></i></a></td>
                @endcan
                @can('delete articles')
                <td>
                    <form action="{{route('flights.destroy', $flight->id)}}"  method="post">
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
        {{ $flights->links() }}
    </div>
