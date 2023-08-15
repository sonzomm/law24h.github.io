@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <h5 class="mb-2 text-center">@lang('Xác minh địa chỉ email')</h5>
                        <form action="{{ route('user.verify.email') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="verification-text mb-2 text-center">@lang('Mã xác minh gồm 6 chữ số được gửi đến địa chỉ email của bạn'): {{ showEmailAddress(auth()->user()->email) }}</p>

                            @include($activeTemplate . 'partials.verification_code')

                            <div class="mb-3">
                                <button type="submit" class="btn btn--base w-100">@lang('Submit')</button>
                            </div>

                            <div class="mb-3">
                                <p>
                                    @lang('Nếu bạn không nhận được bất kỳ mã nào'), <a href="{{ route('user.send.verify.code', 'email') }}"> @lang('Thử lại')</a>
                                </p>

                                @if ($errors->has('resend'))
                                    <small class="text-danger d-block">{{ $errors->first('resend') }}</small>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
