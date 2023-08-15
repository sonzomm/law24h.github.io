@extends($activeTemplate . 'layouts.master')

@section('content')
    <div class="card custom--card">
        <div class="card-header">
            <h5 class="card-title">@lang('Password Change')</h5>
        </div>

        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label>@lang('Mật khẩu hiện tại')</label>
                    <div class="custom-icon-field">
                        <input type="password" class="form--control" name="current_password"
                               placeholder="@lang('Mật khẩu hiện tại')" required autocomplete="current-password">
                        <i class="la la-lock-open"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>@lang('Mật khẩu mới')</label>
                    <div class="secure-password-popup">
                        <div class="custom-icon-field">
                            <input type="password" class="form--control" name="password" placeholder="@lang('New Password')"
                                   required autocomplete="current-password">
                            @if ($general->secure_password)
                                <div class="input-popup">
                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                    <p class="error number">@lang('1 number minimum')</p>
                                    <p class="error special">@lang('1 special character minimum')</p>
                                    <p class="error minimum">@lang('6 character password')</p>
                                </div>
                            @endif
                            <i class="las la-lock"></i>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>@lang('Xác nhật mật khẩu')</label>
                    <div class="custom-icon-field">
                        <input type="password" class="form--control" name="password_confirmation"
                               placeholder="@lang('Xác nhật mật khẩu')" required>
                        <i class="las la-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-md btn--base w-100">@lang('Submit Changes')</button>
            </form>
        </div>
    </div>
@endsection

@if($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif
