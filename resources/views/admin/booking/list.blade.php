@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="show-filter mb-3 text-end">
                <button class="btn btn-outline--primary showFilterBtn btn-sm" type="button"><i class="las la-filter"></i> @lang('Filter')</button>
            </div>
            <div class="card responsive-filter-card mb-4">
                <div class="card-body">
                    <form action="">
                        <div class="d-flex flex-wrap gap-4">
                            <div class="flex-grow-1">
                                <label>@lang('Keywords') <i class="las la-info-circle text--info" title="@lang('Tìm kiếm theo số đặt chỗ, tên người dùng hoặc email')"></i></label>
                                <input class="form-control" name="search" type="text" value="{{ request()->search }}">
                            </div>

                            <div class="flex-grow-1">
                                <label>@lang('Check In')</label>
                                <input autocomplete="off" class="datepicker-here1 form-control" data-language="en" data-position='bottom right' data-range="false" name="check_in" type="text" value="{{ request()->check_in }}">
                            </div>

                            <div class="flex-grow-1">
                                <label>@lang('Checkout')</label>
                                <input autocomplete="off" class="datepicker-here1 form-control" data-language="en" data-position='bottom right' data-range="false" name="check_out" type="text" value="{{ request()->check_out }}">
                            </div>

                            <div class="flex-grow-1 align-self-end">
                                <button class="btn btn--primary w-100 h-45"><i class="fas fa-filter"></i> @lang('Filter')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card bg--transparent b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table bg-white">
                            <thead>
                                <tr>
                                    <th>@lang('Booking Number')</th>
                                    <th>@lang('Khách')</th>
                                    <th>@lang('Check In') | @lang('Check Out')</th>
                                    <th>@lang('Tổng số tiền')</th>
                                    <th>@lang('Tổng số tiền thanh toán')</th>
                                    <th>@lang('Số tiền thanh toán')</th>
                                    @if (request()->routeIs('admin.booking.all') || request()->routeIs('admin.booking.active'))
                                        <th>@lang('Tình trạng')</th>
                                    @endif

                                    @can(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr class="@if ($booking->isDelayed() && !request()->routeIs('admin.booking.checkout.delayed')) delayed-checkout @endif">

                                        <td>
                                            @if ($booking->key_status)
                                                <span class="text--warning ">
                                                    <i class="las la-key f-size--24"></i>
                                                </span>
                                            @endif

                                            <span class="fw-bold">#{{ $booking->booking_number }}</span><br>
                                            <em class="text-muted text--small">{{ showDateTime($booking->created_at, 'd M, Y h:i A') }}</em>
                                        </td>

                                        <td>
                                            @if ($booking->user_id)
                                                <span class="small">
                                                    @can('admin.users.detail')
                                                        <a href="{{ route('admin.users.detail', $booking->user_id) }}"><span>@</span>{{ $booking->user->username }}</a>
                                                    @else
                                                        {{ $booking->user->username }}
                                                    @endcan
                                                </span>
                                                <br>
                                                <a class="fw-bold text--primary" href="tel:{{ $booking->user->email }}">+{{ $booking->user->mobile }}</a>
                                            @else
                                                <span class="small">{{ $booking->guest_details->name }}</span>
                                                <br>
                                                <span class="fw-bold">{{ $booking->guest_details->email }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ showDateTime($booking->check_in, 'd M, Y') }}
                                            <br>
                                            {{ showDateTime($booking->check_out, 'd M, Y') }}
                                        </td>

                                        <td>{{  showAmount($booking->total_amount).$general->cur_sym}}</td>

                                        <td>{{  showAmount($booking->paid_amount).$general->cur_sym  }}</td>

                                        @php
                                            $due = $booking->total_amount - $booking->paid_amount;
                                        @endphp

                                        <td class="@if ($due < 0) text--danger @elseif($due > 0) text--warning @endif">
                                            {{ showAmount($due) }}{{ $general->cur_sym }}
                                        </td>

                                        @if (request()->routeIs('admin.booking.all') || request()->routeIs('admin.booking.active'))
                                            <td>
                                                @php echo $booking->statusBadge; @endphp
                                            </td>
                                        @endif
                                        @can(['admin.booking.details', 'admin.booking.booked.rooms', 'admin.booking.service.details', 'admin.booking.payment', 'admin.booking.key.handover', 'admin.booking.merge', 'admin.booking.cancel', 'admin.booking.extra.charge', 'admin.booking.checkout', 'admin.booking.invoice'])
                                            <td>
                                                <div class="d-flex justify-content-end flex-wrap gap-1">
                                                    @can('admin.booking.details')
                                                        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.booking.details', $booking->id) }}">
                                                            <i class="las la-desktop"></i>@lang('Chi tiết')
                                                        </a>
                                                    @endcan

                                                    <button aria-expanded="false" class="btn btn-sm btn-outline--info" data-bs-toggle="dropdown" type="button">
                                                        <i class="las la-ellipsis-v"></i>@lang('More')
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        @can('admin.booking.booked.rooms')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.booked.rooms', $booking->id) }}">
                                                                <i class="las la-desktop"></i> @lang('các phòng đã đặt')
                                                            </a>
                                                        @endcan

                                                        @can('admin.booking.service.details')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.service.details', $booking->id) }}">
                                                                <i class="las la-server"></i> @lang('Dịch vụ ngoài')
                                                            </a>
                                                        @endcan

                                                        @can('admin.booking.payment')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.payment', $booking->id) }}">
                                                                <i class="la la-money-bill"></i> @lang('Thanh toán')
                                                            </a>
                                                        @endcan

                                                        @if ($booking->status == \App\Constants\Status::BOOKING_ACTIVE)
                                                            @can('admin.booking.key.handover')
                                                                @if (now()->format('Y-m-d') >= $booking->check_in && now()->format('Y-m-d') < $booking->check_out && $booking->key_status == \App\Constants\Status::DISABLE)
                                                                    <a class="dropdown-item handoverKeyBtn" data-booked_rooms="{{ $booking->activeBookedRooms->unique('room_id') }}" data-id="{{ $booking->id }}" href="javascript:void(0)">
                                                                        <i class="las la-key"></i> @lang('Bàn giao chìa khóa')
                                                                    </a>
                                                                @endif
                                                            @endcan

                                                            @can('admin.booking.merge')
                                                                <a class="dropdown-item mergeBookingBtn" data-booking_number="{{ $booking->booking_number }}" data-id="{{ $booking->id }}" href="javascript:void(0)">
                                                                    <i class="las la-object-group"></i> @lang('Hợp nhất hóa đơn')
                                                                </a>
                                                            @endcan

                                                            @can('admin.booking.cancel')
                                                                <a class="dropdown-item" href="{{ route('admin.booking.cancel', $booking->id) }}">
                                                                    <i class="las la-times-circle"></i> @lang('Hủy Booking')
                                                                </a>
                                                            @endcan

                                                            @can('admin.booking.checkout')
{{--                                                                @if (now() >= $booking->check_out)--}}
                                                                    <a class="dropdown-item" href="{{ route('admin.booking.checkout', $booking->id) }}">
                                                                        <i class="la la-sign-out"></i> @lang('Check Out')
                                                                    </a>
{{--                                                                @endif--}}
                                                            @endcan
                                                        @endif
                                                        @can('admin.booking.invoice')
                                                            <a class="dropdown-item" href="{{ route('admin.booking.invoice', $booking->id) }}" target="_blank"><i class="las la-print"></i> @lang('In hóa đơn')</a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($bookings->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($bookings) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('admin.booking.partials.modals')
    <x-confirmation-modal />
@endsection

@can('admin.book.room')
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn--primary" href="{{ route('admin.book.room') }}">
            <i class="la la-hand-o-right"></i>@lang('Book New')
        </a>
    @endpush
@endcan

@push('script-lib')
    <script src="{{ asset('assets/global/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/vendor/datepicker.en.js') }}"></script>
@endpush

@push('style-lib')
    <link href="{{ asset('assets/global/css/vendor/datepicker.min.css') }}" rel="stylesheet">
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.datepicker-here1').datepicker({
                autoClose: true,
                dateFormat: "yyyy-mm-dd"
            });

        })(jQuery);
    </script>
@endpush

@push('style')
    <style>
        .delayed-checkout {
            background-color: #ffefd640;
        }

        .table-responsive {
            min-height: 600px;
            background: transparent
        }

        .card {
            box-shadow: none;
        }
    </style>
@endpush
