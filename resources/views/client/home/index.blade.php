@extends('client.layout.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center">
        <div class="card" style="width: 50rem;">
            <div class="card-header">Tìm chuyến bay</div>
            <div class="card-body">
                <!---->
                <div class="col-md-12">
                    <div class="row">
                        <label for="From" class="col-md-2 col-form-label ">{{ __('Bay từ') }}</label>
                        <div class="col-md-2">
                            <select name="From" class="form-control bootstrap-select ">
                                <option value="0">Điểm A</option>
                            </select>
                        </div>
                        <label for="To" class="col-md-2 col-form-label ">{{ __('Đến') }}</label>
                        <div class="col-md-2">
                            <select name="To" class="form-control bootstrap-select ">
                                <option value="0">Điểm A</option>
                            </select>
                        </div>
                    </div>
                <div>

            </div>
        </div>
    </div>
@endsection
