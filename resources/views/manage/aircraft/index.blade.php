@extends('manage.layout.app')

@section('title', 'Aircrafts')

@section('content')

    @if(session('message'))
        <h1>{{session('message')}} </h1>
    @endif
    
    @can('create articles')
    <a class="btn btn-primary mb-4" href="{{route('aircrafts.create')}}"><i class="fs-4 bi-plus-circle"></i> <span class="ms-1 d-none d-sm-inline">Thêm máy bay</span></a>
    @endcan

    <h3>Danh sách máy bay</h3>
    <div class="form-group my-3">
        Tìm kiếm <input type="text" class="form-control" id="search" name="search"></input>
    </div>
    <div class="row table-responsive">
        @include('manage.aircraft.aircraft_tbl')
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('keyup','#search',function(e){
            e.preventDefault();
            let url = '{{ route('aircrafts.index') }}';
            $val = $('#search').val();
            $.ajax({
                type:'get',
                url:url,
                dataType:'json',
                data:{'search': $val},
                success:function(data){
                    console.log(data);
                    if(data.code === 200){
                        $('.table-responsive').html(data.component);
                    }
                },
                error: function(xhr){
                    var err = xhr.responseText;
                    alert(err.error);
                }
            });
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    });  
    </script>
@endsection
