@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body ">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Tiêu đề trang web')</label>
                                    <input class="form-control" name="site_name" required type="text" value="{{ $general->site_name }}">
                                </div>
                            </div>
                           <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('Site Currency')</label>
                                    <input class="form-control" name="cur_text" required type="text" value="{{ $general->cur_text }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('Currency Symbol')</label>
                                    <input class="form-control" name="cur_sym" required type="text" value="{{ $general->cur_sym }}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group select2-parent">
                                    <label> @lang('Timezone')</label>
                                    <select class="select2-basic" name="timezone">
                                        @foreach ($timezones as $timezone)
                                            <option value="'{{ @$timezone }}'">{{ __($timezone) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('Tax Name')</label>
                                    <input class="form-control" name="tax_name" required type="text" value="{{ $general->tax_name }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('Tax Percent Charge')</label>
                                    <div class="input-group">
                                        <input class="form-control" name="tax" required type="text" value="{{ $general->tax }}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Check In Time')</label>
                                    <div class="input-group clockpicker">
                                        <input autocomplete="off" class="form-control" name="checkin_time" placeholder="--:--" required type="text" value="{{ showDateTime($general->checkin_time, 'H:i') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label> @lang('Checkout Time')</label>
                                    <div class="input-group clockpicker">
                                        <input autocomplete="off" class="form-control" name="checkout_time" placeholder="--:--" required type="text" value="{{ showDateTime($general->checkout_time, 'H:i') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('Upcoming Check-In List') <i class="las la-info-circle" title="@lang('The number of days of data you want to see in the upcoming checkin list.')"></i></label>
                                    <div class="input-group">
                                        <input class="form-control" name="upcoming_checkin_days" min="1" required type="numeric" value="{{ $general->upcoming_checkin_days }}">
                                        <span class="input-group-text">@lang('Days')</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>@lang('Upcoming Checkout List') <i class="las la-info-circle" title="@lang('The number of days of data you want to see in the upcoming checkout list.')"></i></label>
                                    <div class="input-group">
                                        <input class="form-control" name="upcoming_checkout_days" min="1" required type="numeric" value="{{ $general->upcoming_checkout_days }}">
                                        <span class="input-group-text">@lang('Days')</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="{{ asset('assets/admin/js/spectrum.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor/bootstrap-clockpicker.min.js') }}"></script>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/admin/css/spectrum.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/vendor/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>
        .select2-parent {
            position: relative;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.colorPicker').spectrum({
                color: $(this).data('color'),
                change: function(color) {
                    $(this).parent().siblings('.colorCode').val(color.toHexString().replace(/^#?/, ''));
                }
            });

            $('.colorCode').on('input', function() {
                var clr = $(this).val();
                $(this).parents('.input-group').find('.colorPicker').spectrum({
                    color: clr,
                });
            });

            $('select[name=timezone]').val("'{{ config('app.timezone') }}'").select2();
            $('.select2-basic').select2({
                dropdownParent: $('.select2-parent')
            });

            // clock picker
            $('.clockpicker').clockpicker({
                placement: 'bottom',
                align: 'left',
                donetext: 'Done',
                autoclose: true,
            });
        })(jQuery);
    </script>
@endpush
