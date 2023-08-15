@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card custom--card">
                        <div class="card-body">
                            <form action="{{ route('user.data.submit') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('First Name')</label>
                                        <input class="form--control" name="firstname" required type="text" value="{{ old('firstname') }}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Last Name')</label>
                                        <input class="form--control" name="lastname" required type="text" value="{{ old('lastname') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Address')</label>
                                        <input class="form-control form--control" name="address" type="text" value="{{ old('address') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('State')</label>
                                        <input class="form-control form--control" name="state" type="text" value="{{ old('state') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('Zip Code')</label>
                                        <input class="form-control form--control" name="zip" type="text" value="{{ old('zip') }}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="form-label">@lang('City')</label>
                                        <input class="form-control form--control" name="city" type="text" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn--base w-100" type="submit">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
