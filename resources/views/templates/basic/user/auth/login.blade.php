@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="auth-section">
        <div class="container">
            <div class="row align-items-lg-center justify-content-center justify-content-xl-between">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="auth-section__form">
                        <form method="POST" action="{{ route('user.login') }}" class="account-form mt-3">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Username or Email')</label>
                                    <div class="custom-icon-field">
                                        <input type="text" name="username" value="{{ old('username') }}" class="form--control" placeholder="@lang('Username or email')" required>
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Password')</label>
                                    <div class="custom-icon-field">
                                        <input type="password" class="form--control" id="password-seen" name="password" placeholder="@lang('Password')" required>
                                        <i class="fas fa-lock"></i>
                                        <span class="input-eye"><i class="la la-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between form-group flex-wrap">
                                <div class="form-check custom--checkbox me-4">
                                    <input class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        @lang('Remember Me')
                                    </label>
                                </div>

                                <a href="{{ route('user.password.request') }}" class="text--base">@lang('Forgot Password?')</a>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn--base w-100">@lang('SIGN IN ACCOUNT')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
       $('.input-eye i').on('click', function() {
            let element=document.getElementById('password');
            console.log(element);
            if( this.classList.contains('la-eye')){
                this.classList.add('la-eye-slash')
                this.classList.remove('la-eye')
            }else{
                this.classList.add('la-eye')
                this.classList.remove('la-eye-slash')
            }
            if(element.type =='password'){
                element.type="text";
            }else{
                element.type="password";
            }
        });
    </script>
@endpush
