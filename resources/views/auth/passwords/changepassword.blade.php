@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Đổi mật khẩu</div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    <form method="POST" action="{{ route('changePassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }} row">
                            <label for="current_password" class="col-md-4 col-form-label text-md-right">Mật khẩu hiện tại</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>

                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }} row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">Mật khẩu mới</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password_confirm" class="col-md-4 col-form-label text-md-right">Nhập lại mật khẩu mới</label>

                            <div class="col-md-6">
                                <input id="new_password_confirm" type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Đổi mật khẩu
                                </button>                               
                            </div>
                            <div class="col-md-8 offset-md-4 mt-4">
                                @hasrole('user')
                                <a href="{{route('home')}}" style="text-decoration:none;">Quay lại trang chủ</a>
                                @endhasrole
                                @hasanyrole('admin|super-admin')
                                <a href="{{route('admin')}}" style="text-decoration:none;">Quay lại trang quản trị</a>
                                @endhasanyrole
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
