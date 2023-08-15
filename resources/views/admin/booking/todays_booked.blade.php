@extends('admin.layouts.app')
@section('panel')

    @php
        $availableOnly = request()->type && request()->type == 'not_booked';
    @endphp

    @if (!$availableOnly)
        <div class="row gy-4">
            @forelse($rooms as $room)
                <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6">
                    <div class="widget-two box--shadow2 b-radius--5 bg--white">
                        <div class="widget-two__icon b-radius--5 bg--dark">
                            {{ $room->room->room_number }}
                        </div>
                        <div class="widget-two__content d-flex align-items-center justify-content-between flex-wrap">
                            @if ($room->booking->user_id)
                                <h3>
                                    @can('admin.users.detail')
                                        <a class="f-size--18 text-center text--dark" href="{{ route('admin.users.detail', $room->booking->user_id) }}">
                                            {{ __($room->booking->user->fullname) }}
                                        </a>
                                    @else
                                        <span class="f-size--18 text-center text--dark">{{ __($room->booking->user->fullname) }}</span>
                                    @endcan
                                </h3>
                            @else
                                <h3 class="f-size--18 text--dark">{{ @$room->booking->guest_details->name }}</h3>
                            @endif
                            <div class="d-flex flex-column fw-bold w-100">
                                <p class="text--muted text--small">@lang('Booking No.'):
                                    @can('admin.booking.all')
                                        <a class="text--small fw-bold" href="{{ route('admin.booking.details', $room->booking->id) }}">{{ $room->booking->booking_number }}</a>
                                    @else
                                        <span class="fw-bold">{{ $room->booking->booking_number }}</span>
                                    @endcan
                                </p>

                                <p class="text--muted text--small">@lang('Room Type'): {{($room->room->roomType->name) }}
                                </p>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                @can('admin.extra.service.add')
                                    <a class="btn btn--xs btn-outline--dark" data-services="{{ $room->extraServices }}" href="{{ route('admin.extra.service.add') }}?room={{ $room->room->room_number }}"> <i class="la la-plus""></i>@lang('Add Service')</a>
                                @endcan

                                <button class="btn btn--xs btn-outline--info btn-view" data-services="{{ $room->extraServices }}" type="button"> <i class="la la-eye"></i>@lang('Xem dịch vụ')</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text--muted">@lang('Chưa đặt phòng')</h4>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    @endif

    @if ($emptyRooms->count())
        @if (!$availableOnly)
            <h3 class="mt-5 mb-4">@lang('Có trống để đặt chỗ')</h3>
        @endif
        <div class="row gy-4">
            @foreach ($emptyRooms as $room)
                <div class="col-xxl-2 col-sm-2 col-3">

                    <div class="bg--white p-3 rounded text-center">
                        <span class="d-block fw-bold">
                            {{ $room->room_number }}
                        </span>

                        <span class="text--small">{{($room->roomType->name) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($availableOnly && blank($emptyRooms))
        <div class="col-12">
            <div class="card empty-card">
                <div class="card-body">
                    <div class="text-center message">
                        <i class="las la-file la-3x"></i>
                        <h4>@lang('Không còn phòng trống để đặt')</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="modelTitleId" class="modal fade" id="extraServices" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">@lang('Dịch vụ bổ sung')</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text--center">@lang('Chưa có dịch vụ bổ sung.')</h5>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <style>
        .empty-card h4 {
            color: #a5a5a5;
        }

        .message {
            font-size: 38px;
            color: #e9e9e9;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            'use strict';
            $('.btn-view').on('click', function() {
                let modal = $('#extraServices');
                let services = $(this).data('services');

                console.log(services);

                let content = ``;
                if (services.length) {
                    content += `<ul class="list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="w-25">@lang('Name')</span>
                        <span class="w-25 text-center">@lang('số lượng')</span>
                        <span class="w-25 text-center">@lang('Giá')</span>
                        <span class="w-25 text-end">@lang('Tổng')</span>
                    </li>
                    `;

                    services.forEach((element, i) => {
                        content += `<li class="list-group-item d-flex justify-content-between">
                            <span class="w-25">${i+1}. ${element.extra_service.name}</span>
                            <span class="w-25 text-center">${element.qty}</span>
                            <span class="w-25 text-center">${parseFloat(element.unit_price)}{{ $general->cur_sym }}</span>
                            <span class="w-25 text-end">${parseFloat(element.total_amount)}{{ $general->cur_sym }}</span>
                        </li>`;
                    });

                    content += `</ul>`;
                } else {
                    content = `<h4 class="text-center">@lang('Chưa sử dụng dịch vụ nào!')</h4>`;
                }
                modal.find('.modal-body').html(content);

                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
