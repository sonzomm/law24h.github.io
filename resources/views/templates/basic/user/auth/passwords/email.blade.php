@php
    $content = getContent('account_recovery.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            <div class="d-flex align-items-lg-center justify-content-center">
                <div class="col-lg-6 col-xl-5 col-md-8">
                    <div class="auth-section__form">
                        <p class="subtitle">@lang('Để khôi phục tài khoản của bạn, vui lòng cung cấp email hoặc tên người dùng để tìm tài khoản của bạn.')</p>
                        <form action="{{ route('user.password.email') }}" class="account-form mt-3" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>@lang('Username or Email')</label>
                                <div class="custom-icon-field">
                                    <input class="form--control" name="value" placeholder="@lang('Username or email')" required type="text" value="{{ old('username') }}">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <button class="btn btn--base w-100" type="submit">@lang('Submit')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
