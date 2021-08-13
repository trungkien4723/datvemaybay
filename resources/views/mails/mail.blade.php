Xin chào <i>{{ $data[0]['passenger']->last_name }}</i>,
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
               <td>{{$data[0]['passenger']->first_name . ' ' . $data[0]['passenger']->last_name}}</td>
               <td>{{$data[0]['passenger']->email}}</td>
               <td>{{$data[0]['passenger']->phone}}</td>
               <td>{{$data[0]['adult']}}</td>
               <td>{{$data[0]['children']}}</td>
               <td>{{$data[0]['infant']}}</td>
         </tr>
      </table>
   </div>

   <h3>Sau đây là chi tiết Vé đặt:</h3>
   <div>
   @foreach($data as $mailItem)
      <h4>{{$mailItem['passenger']->first_name}} {{$mailItem['passenger']->last_name}}</h4>
    <table style="text-align:center; width:100%;" border="2px" cellspacing="0">
         <tr>
            <th>STT</th>
            <th>Mã đặt chỗ</th>
            <th>Máy bay</th>
            <th>Thời điểm đặt vé</th>
            <th>Thời gian bay</th>
            <th>Địa điểm bay</th>
            <th>Tổng giá</th>
        </tr>
         @php $total = 0; @endphp
         @foreach($mailItem['ticket'] as $item)
         @php $total += $item['total_price']; @endphp @endforeach
            @foreach($mailItem['flights'] as $flight)   
            <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$flight->booking_key}}</td>
                  <td>{{$flight->aircraft_ID}}-{{$flight->aircraft->airline->name}}</td>
                  <td>{{$mailItem['booking']->booked_time}}</td>
                  <td>{{date("d-m-Y H:i", strtotime($flight->start_time))}} --> {{date("d-m-Y H:i", strtotime($flight->arrive_time))}}</td>
                  <td>{{$flight->startAirport->name}} ( {{ $flight->startAirport->city->name }} ) --> {{$flight->arriveAirport->name}} ( {{ $flight->arriveAirport->city->name }} )</td>
                  <td>{{number_format($mailItem['booking']->total_price)}}</td>
            </tr>
            @endforeach
      </table>
   </div>
   @endforeach
</div>
<br>
<br>
<h3>Thành tiền: {{number_format($total)}} VND</h3>
<br>
<br>
<br>
<div>
   Trân thành cảm ơn.
</div>