@extends('manage'.layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row justify-content-center" style="background-color: #B0E0E6; padding: 2rem;">
        <div class="card" id="find-flight" style="width: 50rem;">
            <div class="card-header">Tìm chuyến bay</div>
            <div class="card-body">
                <!---->
                <div class="col-md-12">
                    <div class="row">
                        <label for="flight-from" class="col-md-2 col-form-label ">{{ __('Bay từ') }}</label>
                        <div class="col-md-3">
                            <select name="flight-form" class="form-control bootstrap-select ">
                                <option value="0">Điểm A</option>
                            </select>
                        </div>
                        <label for="flight-to" class="col-md-2 col-form-label ">{{ __('Đến') }}</label>
                        <div class="col-md-3">
                            <select name="flight-to" class="form-control bootstrap-select ">
                                <option value="0">Điểm B</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label for="date-from" class="col-md-2 col-form-label ">{{ __('Ngày đi') }}</label>
                        <div class="col-md-3">
                            <input name="date-from" type="date" class="form-control @error('date-from') is-invalid @enderror autofocus"/>
                        </div>
                        <label for="date-to" class="col-md-2 col-form-label ">{{ __('Ngày về') }}</label>
                        <div class="col-md-3">
                            <input name="date-to" type="date" class="form-control @error('date-to') is-invalid @enderror autofocus"/>
                        </div>
                        <div class="form-check col-md-2">
                            <label class="form-check-label" for="check-date-back">{{__('Khứ hồi')}}</label>
                            <input name="check-date-back" class="form-check-input @error('date-to') is-invalid @enderror autofocus" type="checkbox" value="" id="flexCheckDefault">                            
                        </div>
                    </div>
                    <div class="row">
                        <label for="passengers" class="col-md-2 col-form-label ">{{ __('Hành khách') }}</label>
                        <div class="col-md-6 dropdown">
                            <input readonly name="passengers" type="textbox" class="form-control dropdown-toggle" id="Dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" value="0 người lớn, 0 trẻ em, 0 trẻ sơ sinh"/>
                            <ul class="dropdown-menu p-3" aria-labelledby="navbarDropdown" id="passengers-count">
                                <li class="row">
                                    <div class="col-md-4">Người lớn</div>
                                    <div class="col-md-8">
                                        <input class="btn btn-outline-secondary" type="submit" value="+">
                                        <input name="adults" type="text" value="0">
                                        <input class="btn btn-outline-secondary" type="submit" value="-">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-md-4">Trẻ em</div>
                                    <div class="col-md-8">
                                        <input class="btn btn-outline-secondary" type="submit" value="+">  
                                        <input name="childrens" type="text" value="0">
                                        <input class="btn btn-outline-secondary" type="submit" value="-">
                                    </div>
                                </li>
                                <li class="row">
                                    <div class="col-md-4">Trẻ sơ sinh</div>
                                    <div class="col-md-8">
                                        <input class="btn btn-outline-secondary" type="submit" value="+">
                                        <input name="infants" type="text" value="0">
                                        <input class="btn btn-outline-secondary" type="submit" value="-">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <a name="find-flight" class="btn btn-primary" href="#" role="button">Tìm kiếm chuyến bay</a>
                        </div>                        
                    </div>
                <div>
            </div>
        </div>
    </div>
@endsection
