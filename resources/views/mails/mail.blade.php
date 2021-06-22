Xin chào <i>{{ $data['passenger']->last_name }}</i>,
<p>Đây là email thông báo bạn đã đặt vé máy bay thành công từ dịch vụ của chúng tôi.</p>

<div>
   <h3>Sau đây là chi tiết khách hàng:</h3>
   <div>
    <table style="text-align:center; width:100%;" border="2px" cellspacing="0">
         <tr>
            <th>Tên</th>
            <th>E-Mail</th>
            <th>Số điện thoại</th>
            <th>Số người lớn</th>
            <th>Số trẻ em</th>
            <th>Số em bé</th>
        </tr>
         <tr>
               <td>{{$data['passenger']->first_name . ' ' . $data['passenger']->last_name}}</td>
               <td>{{$data['passenger']->email}}</td>
               <td>{{$data['passenger']->phone}}</td>
               <td>{{$data['booking']->adult}}</td>
               <td>{{$data['booking']->children}}</td>
               <td>{{$data['booking']->infant}}</td>
         </tr>
      </table>
   </div>

   <h3>Sau đây là chi tiết Vé đặt:</h3>
   <div>
    <table style="text-align:center; width:100%;" border="2px" cellspacing="0">
         <tr>
            <th>STT</th>
            <th>Máy bay</th>
            <th>Thời điểm đặt vé</th>
            <th>Thời gian bay</th>
            <th>Địa điểm bay</th>
            <th>Tổng giá</th>
        </tr>
         @php $total = 0; @endphp
         @foreach(session('ticket') as $item)
         @php $total += $item['price']; @endphp @endforeach
            @foreach($data['flights'] as $flight)   
            <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$flight->aircraft_ID}}-{{$flight->aircraft->airline->name}}</td>
                  <td>{{$data['booking']->booked_time}}</td>
                  <td>{{date("d-m-Y H:i", strtotime($flight->start_time))}} --> {{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</td>
                  <td>{{$flight->startAirport->name}} ( {{ $flight->startAirport->city->name }} ) --> {{$flight->arriveAirport->name}} ( {{ $flight->arriveAirport->city->name }} )</td>
                  <td>{{number_format($item['price'])}}</td>
            </tr>
            @endforeach
         
         <tr><td><strong>Thành tiền: {{number_format($total)}} VND</strong></td></tr>
      </table>
   </div>
</div>

<br>
<br>
<br>
<div>
   Trân thành cảm ơn.
</div>