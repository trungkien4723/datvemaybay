@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Xác nhận E-Mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Đường dẫn đã được gửi tới E-Mail của bạn.') }}
                        </div>
                    @endif

                    {{ __('Kiểm tra đường dẫn trong email trước khi thực hiện.') }}
                    {{ __('Không nhận được email?') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Gửi lại yêu cầu') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
