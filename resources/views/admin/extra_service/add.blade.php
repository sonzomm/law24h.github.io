@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30 justify-content-center">
        <div class="col-lg-8 col-xl-6 mb-30">
            <div class="card">
                <div class="card-body p-sm-4 p-3">
                    <form action="{{ route('admin.extra.service.save') }}" class="add-service-form" method="POST">
                        @csrf
                        <div class="row append-service">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group flex-fill">
                                        <label>@lang('Ngày phục vụ')</label>
                                    <input autocomplete="off" class="datepickerHere form-control bg--white" data-language="en" data-position='bottom left' data-range="false" name="service_date" required type="text" value="{{ todaysDate() }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group flex-fill">
                                    <label>@lang('Số phòng')</label>
                                    <input class="form-control" name="room_number" required type="text" value="{{ request()->room }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex justify-content-between">
                            <label class="required">@lang('Dịch vụ')</label>
                            <button class="btn btn--success addServiceBtn border-0" type="button">
                                <i class="las la-plus"></i>@lang('Thêm')
                            </button>
                        </div>

                        <div class="service-wrapper">
                            <div class="first-service-wrapper">
                                <div class="d-flex service-item position-relative mb-3 flex-wrap">
                                    <select class="custom-select no-right-radius flex-fill w-50" name="services[]" required>
                                        <option value="">@lang('Select One')</option>
                                        @foreach ($extraServices as $extraService)
                                            <option value="{{ $extraService->id }}">
                                                {{($extraService->name) }} - {{showAmount($extraService->cost).$general->cur_sym  }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input class="form-control w-unset flex-fill no-left-radius w-50" name="qty[]" placeholder="@lang('Số lượng')" required type="text">

                                    <button class="btn--danger removeServiceBtn border-0" disabled type="button">
                                        <i class="las la-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @can('admin.extra.service.save')
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .no-right-radius {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .no-left-radius {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        .removeServiceBtn {
            position: absolute;
            height: 25px;
            width: 25px;
            border-radius: 50%;
            text-align: center;
            line-height: 13px;
            font-size: 12px;
            right: -8px;
            top: -8px;
        }
    </style>
@endpush
@push('style-lib')
    <link href="{{ asset('assets/global/css/vendor/datepicker.min.css') }}" rel="stylesheet">
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('script')
    <script>
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.datepickerHere').datepicker({
            autoClose: true,
            dateFormat: "yyyy-mm-dd"
        });

        $('.addServiceBtn').on('click', function() {
            const content = $('.first-service-wrapper').html();
            $('.service-wrapper').append(content);
            let firstItem = $('.first-service-wrapper button:disabled');

            $('.service-wrapper').find(':disabled').not(firstItem).removeAttr('disabled');
        });

        $(document).on('click', '.removeServiceBtn', function() {
            $(this).parents('.service-item').remove();

        });

        let serviceForm = $('.add-service-form');

        serviceForm.on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let url = $(this).attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        notify('success', response.success);
                        let firstItem = $('.first-service-wrapper .service-item');
                        $(document).find('.service-wrapper').find('.service-item').not(firstItem).remove();
                        serviceForm.trigger("reset");
                    } else {
                        $.each(response.error, function(key, value) {
                            notify('error', value);
                        });
                    }
                },
            });
        });
    </script>
@endpush
