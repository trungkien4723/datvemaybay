<div class="row text-center">
  <h5 class="my-3">Biểu đồ thống kê vé đặt</h5>
  <div class="row mb-4">
    <div class="col-6">
      <label for="date_from">Từ ngày</label>
      <input type="date" name="date_from" id="date_from" value={{date('Y-m-d', strtotime(now() . ' -1 day'))}}>
    </div>
    <div class="col-6">
      <label for="date_to">Đến ngày</label>
      <input type="date" name="date_to" id="date_to" value={{now()}}>
    </div>
  </div>
  <div class="booking_chart"></div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<!-- Charting library -->
<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
<!-- Chartisan -->
<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <!-- Your application script -->
    <script>
      function buildBookingChart()
      {
        var html = "<div id='chart' style='height: 300px;'></div>"
        $('.booking_chart').html(html);
        var date_from = document.getElementById("date_from").value;
        var date_to = document.getElementById("date_to").value;
        const chart = new Chartisan({
          el: '#chart',
          url: "@chart('booking_chart')"+"?date_from="+date_from+"&date_to="+date_to,
          hooks: new ChartisanHooks()
            .colors()
            .datasets([{type:'line', fill:false, borderColor:'blue',}, ])
        });
      }

      function buildBookingTable()
      {
        var date_from = document.getElementById("date_from").value;
        var date_to = document.getElementById("date_to").value;

        let table_url = '{{ route('booking_statistics') }}';
        $.ajax({
                type:'get',
                url:table_url,
                dataType:'json',
                data:{'date_from': date_from, 'date_to': date_to},
                success:function(data){
                    console.log(data);
                    if(data.code === 200){
                        $('.booking_table').html(data.component);
                    }
                },
                error: function(xhr){
                    var err = xhr.responseText;
                    alert(err.error);
                }
            });
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
      }

      $(document).ready(function(){
        buildBookingChart();

        $(document).on('change','#date_from',function(){
          buildBookingChart();
        });

        $(document).on('change','#date_to',function(){
          buildBookingChart();
        });
      });
      
    </script>