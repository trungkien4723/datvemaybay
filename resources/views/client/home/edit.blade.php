@extends('client.layout.app')

@section('title', 'Edit users')

@section('content')

@if(session('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong> {{session('message')}}</strong>
        </div>
@endif


<div class="row justify-content-center">
    <div class="card">
        <div class="card-header">Chỉnh sửa thông tin người dùng</div>
            <div class="form-group row">                
                <div class="card-body justify-content-center">
                    <form method="POST" action="{{ route('users.update',$user->id) }}"  enctype="multipart/form-data" >
                    @csrf
                    @method('put')
                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Ảnh đại diện') }}</label>

                            <div class="col-md-4">
                                <input  type="file" class="image_input form-control @error('image') is-invalid @enderror" name="image">
                                <image class="image_preview" src="{{asset('images/user/'.$user->image)}}" name="preview-image" alt="..." style="margin-top:1rem; width:180px; height:180px;"/>
                                <br><a class="image_input_clear btn btn-danger disabled">Xóa ảnh</a>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Tên') }}</label>

                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')??$user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-4">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')??$user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-2 col-form-label text-md-right">{{ __('Giới tính') }}</label>

                            <div class="col-md-4">
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender')??$user->gender }}" required autocomplete="gender">
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthday" class="col-md-2 col-form-label text-md-right">{{ __('Ngày sinh') }}</label>

                            <div class="col-md-4">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday')??$user->birthday }}" required autocomplete="birthday">

                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-2 col-form-label text-md-right">{{ __('Địa chỉ') }}</label>

                            <div class="col-md-4">
                                <textarea id="address" row="4" col="50" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="adress">{{ old('address')??$user->address }}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-2 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                            <div class="col-md-4">
                                <input id="phone" type="tel" pattern="[0-9]{9,11}"class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone')??$user->phone }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cập nhật') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
