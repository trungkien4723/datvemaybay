@extends('client.layout.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center" style="background-color: #B0E0E6; padding: 2rem;">
        <div class="card" id="find-flight" style="width: 50rem;">
            <div class="card-header">Tìm chuyến bay</div>
            <div class="card-body">                
                <div class="col-md-12">
                <!--Địa điểm-->
                    <div class="row">
                        <label for="flight-from" class="col-md-2 col-form-label ">{{ __('Bay từ') }}</label>
                        <div class="col-md-3">
                            <select name="flight-form" class="form-control bootstrap-select ">
                                @foreach($cities as $item)
                                    <option value="{{$item->id}}" {{$item->id == 1 ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="flight-to" class="col-md-2 col-form-label ">{{ __('Đến') }}</label>
                        <div class="col-md-3">
                            <select name="flight-to" class="form-control bootstrap-select ">
                                @foreach($cities as $item)
                                    <option value="{{$item->id}}" {{$item->id == 2 ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                <!--Ngày-->
                    <div class="row">
                        <label for="date-from" class="col-md-2 col-form-label ">{{ __('Ngày đi') }}</label>
                        <div class="col-md-3">
                            <input name="date-from" type="date" class="form-control @error('date-from') is-invalid @enderror autofocus"/>
                        </div>

                        <label for="date-to" class="col-md-2 col-form-label container_date_to">{{ __('Ngày về') }}</label>
                        <div class="col-md-3">
                            <input name="date-to" type="date" class="form-control @error('date-to') is-invalid @enderror autofocus container_date_to"/>
                        </div>

                        
                        <div class="form-check col-md-2">
                            <label class="form-check-label" for="check-date-back">{{__('Khứ hồi')}}</label>
                            <input name="check-date-back" class="form-check-input @error('date-to') is-invalid @enderror autofocus chk_date_to" type="checkbox" value="" id="flexCheckDefault">                            
                        </div>
                    </div>

                <!--Hạng ghế-->
                    <div class="row">
                        <label for="seat-class" class="col-md-2 col-form-label ">{{ __('Hạng ghế') }}</label>
                        <div class="col-md-6">
                            <select name="seat-class" class="form-control bootstrap-select ">
                                @foreach($seatClasses as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>    

                <!--Hành khách-->    
                    <div class="row">
                        <label for="passengers" class="col-md-2 col-form-label ">{{ __('Hành khách') }}</label>
                        <div class="col-md-6 dropdown">
                            <input readonly name="passengers" type="textbox" class="form-control" id="passenger_collapse" role="button" data-bs-toggle="dropdown" aria-expanded="false"/>
                            <div class="p-3 dropdown-menu stopPropagation-dropdown-menu" id="passengers_count">
                            <form class="px-4 py-3">
                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <span>Người lớn</span>
                                        <label for="adults">(12 tuổi trở lên)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="adults">
                                                <span class="bi bi-dash"></span>
                                            </button>
                                        </span>
                                        <input type="text" name="adults" class="input-number" value="1" min="1" max="100">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="adults">
                                                <span class="bi bi-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <span>Trẻ em</span>
                                        <label for="childrens">(từ 2-11 tuổi)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="childrens">
                                                <span class="bi bi-dash"></span>
                                            </button>
                                        </span>
                                        <input type="text" name="childrens" class="input-number" value="0" min="0" max="100">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="childrens">
                                                <span class="bi bi-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-floating col-md-6">
                                        <span>Em bé</span>
                                        <label for="infants">(dưới 2 tuổi)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="infants">
                                                <span class="bi bi-dash"></span>
                                            </button>
                                        </span>
                                        <input type="text" name="infants" class="input-number" value="0" min="0" max="100">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="infants">
                                                <span class="bi bi-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            </div>
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
