@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $registerContent = getContent('register.content', true);
    @endphp

    <div class="auth-section">
        <div class="container">
            <div class="row align-items-lg-center justify-content-center justify-content-xl-between">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="auth-section__form">
                        <h3 class="title mb-2">Đăng ký</h3>
                        <form action="{{ route('user.register') }}" class="account-form mt-3" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Username')</label>
                                        <div class="custom-icon-field">
                                            <input class="form--control checkUser" name="username" placeholder="@lang('Username')" required type="text" value="{{ old('username') }}">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <small class="text-danger usernameExist"></small>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Email')</label>
                                        <div class="custom-icon-field">
                                            <input class="form--control checkUser" name="email" placeholder="@lang('Email Address')" required type="email" value="{{ old('email') }}">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="secure-password-popup">
                                            <label>@lang('Password')</label>
                                            <div class="custom-icon-field hover-input-popup">
                                                <input class="form--control" id="password-seen" name="password" placeholder="@lang('Password')" required type="password">
                                                <i class="fas fa-lock"></i>
                                                <span class="input-eye"><i class="far fa-eye"></i></span>
                                            </div>
                                            @if ($general->secure_password)
                                                <div class="input-popup">
                                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                                    <p class="error number">@lang('1 number minimum')</p>
                                                    <p class="error special">@lang('1 special character minimum')</p>
                                                    <p class="error minimum">@lang('6 character password')</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label>@lang('Confirm Password')</label>
                                    <div class="custom-icon-field">
                                        <input class="form--control" name="password_confirmation" placeholder="@lang('Confirm Password')" required type="password">
                                        <i class="fas fa-lock"></i>
                                        <span class="input-eye"><i class="far fa-eye"></i></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>@lang('Country')</label>
                                        <div class="custom-icon-field">
                                            <select class="select" name="country">
                                                @foreach ($countries as $key => $country)
                                                    <option data-code="{{ $key }}" data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}">
                                                        {{ __($country->country) }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">@lang('Mobile')</label>
                                        <div class="input-group">
                                            <span class="input-group-text mobile-code" id="basic-addon1"></span>
                                            <input name="mobile_code" type="hidden">
                                            <input name="country_code" type="hidden">
                                            <input class="form--control checkUser" name="mobile" placeholder="@lang('Phone')" required type="number" value="{{ old('mobile') }}">
                                            <small class="text-danger mobileExist"></small>
                                        </div>
                                    </div>
                                </div>

                                @if ($general->agree)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check custom--checkbox">
                                                <input @checked(old('agree')) class="form-check-input" id="agree" name="agree" type="checkbox">
                                                <label class="form-check-label" for="agree">
                                                    @lang('Tôi đồng ý') @foreach ($policyPages as $policy)
                                                        <a class="text--base" href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}" target="_blank">{{ __($policy->data_values->title) }}</a>
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-12">
                                    <button class="btn btn--base w-100" type="submit">@lang('Tạo tài khoản')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="existModalCenterTitle" class="modal fade" id="existModalCenter" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('Tài khoản của bạn đã sẵn sàng')</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--danger btn-sm text-white" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                    <a class="btn btn--base btn-sm" href="{{ route('user.login') }}">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);

        $('.input-eye i').on('click', function() {
            let element = $(this).parents('.custom-icon-field').find('input');
            if (element.attr('type') == 'password') {
                element.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                element.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye')
            }
        });
    </script>
@endpush
