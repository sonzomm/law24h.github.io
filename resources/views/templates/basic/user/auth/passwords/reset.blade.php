@php
$content = getContent('password_reset.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row align-items-lg-center justify-content-center">
                <div class="col-lg-6 col-xl-5">
                    <div class="auth-section__form">
                        <p class="subtitle">@lang('Tài khoản của bạn đã được xác minh thành công. Bây giờ bạn có thể thay đổi mật khẩu của bạn. Vui lòng nhập mật khẩu mạnh và không chia sẻ mật khẩu đó với bất kỳ ai.')</p>
                        <form method="POST" action="{{ route('user.password.update') }}" class="account-form mt-3">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <div class="secure-password-popup">
                                    <label>@lang('Password')</label>
                                    <div class="custom-icon-field">
                                        <input type="password" class="form--control" id="password-seen" name="password" placeholder="@lang('Password')" required>
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

                            <div class="form-group">
                                <label>@lang('Confirm Password')</label>
                                <div class="custom-icon-field">
                                    <input type="password" class="form--control" name="password_confirmation" placeholder="@lang('Confirm Password')" required>
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--base w-100"> @lang('Submit')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@if ($general->secure_password)
    @push('script-lib')
        <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
    @endpush
@endif

@push('script')
    <script>
       $('.input-eye i').on('click', function() {
            let element=document.getElementById('password');
            console.log(element);
            if( this.classList.contains('fa-eye')){
                this.classList.add('fa-eye-slash')
                this.classList.remove('fa-eye')
            }else{
                this.classList.add('fa-eye')
                this.classList.remove('fa-eye-slash')
            }
            if(element.type =='password'){
                element.type="text";
            }else{
                element.type="password";
            }
        });
    </script>
@endpush
