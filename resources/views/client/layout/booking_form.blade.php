
<div class="card" id="find-flight" style="width: 50rem;">
<div class="card-header">Tìm chuyến bay</div>
    <div class="card-body">
    <form method="GET" action="{{route('booking')}}"  enctype="multipart/form-data" >
                @csrf              
            <div class="col-md-12">
            <!--Địa điểm-->
                <div class="row">
                    <label for="flight_from" class="col-md-2 col-form-label ">{{ __('Bay từ') }}</label>
                    <div class="col-md-3">
                        <select name="flight_from" class="form-control bootstrap-select ">
                            @foreach($cities as $item)
                                <option value="{{$item->id}}" {{$item->id == 1 ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label for="flight_to" class="col-md-2 col-form-label ">{{ __('Đến') }}</label>
                    <div class="col-md-3">
                        <select name="flight_to" class="form-control bootstrap-select ">
                            @foreach($cities as $item)
                                <option value="{{$item->id}}" {{$item->id == 2 ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            <!--Ngày-->
                <div class="row">
                    <label for="date_from" class="col-md-2 col-form-label ">{{ __('Ngày đi') }}</label>
                    <div class="col-md-3">
                        <input name="date_from" id="date_from" type="date" class="form-control @error('date_from') is-invalid @enderror autofocus"/>
                        @error('date_from')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>                    
                    <label for="date_to" class="col-md-2 col-form-label container_date_to">{{ __('Ngày về') }}</label>
                    <div class="col-md-3">
                        <input name="date_to" id="date_to" type="date" class="form-control @error('date_to') is-invalid @enderror autofocus container_date_to"/>
                        @error('date_to')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    <div class="form-check col-md-2">
                        <label class="form-check-label" for="check_date_back">{{__('Khứ hồi')}}</label>
                        <input name="check_date_back" class="chk_date_to form-check-input @error('date_to') is-invalid @enderror" type="checkbox" value="" id="flexCheckDefault">                            
                    </div>
                </div>

            <!--Hạng ghế-->
                <div class="row">
                    <label for="seat_class" class="col-md-2 col-form-label ">{{ __('Hạng ghế') }}</label>
                    <div class="col-md-6">
                        <select name="seat_class" class="form-control bootstrap-select ">
                            @foreach($seatClasses as $item)
                                <option value="{{$item->id}}"{{$item->name == "Ghế hạng Phổ thông (Economy Class)" ? 'selected' : ''}}>{{$item->name}}</option>
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
                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <span>Người lớn</span>
                                    <label for="adult">(12 tuổi trở lên)</label>
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="adult">
                                            <span class="bi bi-dash"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="adult" id="adult" class="input-number" value="1" min="1" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="adult">
                                            <span class="bi bi-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <span>Trẻ em</span>
                                    <label for="children">(từ 2-11 tuổi)</label>
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="children">
                                            <span class="bi bi-dash"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="children" id="children" class="input-number" value="0" min="0" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="children">
                                            <span class="bi bi-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-floating col-md-6">
                                    <span>Em bé</span>
                                    <label for="infant">(dưới 2 tuổi)</label>
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="infant">
                                            <span class="bi bi-dash"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="infant" id="infant" class="input-number" value="0" min="0" max="100">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="infant">
                                            <span class="bi bi-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">
                        {{ __('Tìm chuyến bay') }}
                        </button>
                    </div>                        
                </div>
    <form>
    <div>
</div>
</div>
