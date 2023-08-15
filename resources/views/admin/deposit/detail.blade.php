@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30 justify-content-center">
        <div class="col-xl-4 col-md-6 mb-30">
            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">
                        @if (@$deposit->gateway)
                            @lang('Thanh toán qua')
                            {{ __(@$deposit->gateway->name) }}
                        @else
                            @lang('Payment to') {{ __($deposit->paymentVia()) }}
                        @endif
                    </h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Ngày')
                            <span class="fw-bold">{{ showDateTime($deposit->created_at) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Mã thanh toán')
                            <span class="fw-bold">{{ $deposit->trx }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Tên')
                            <span class="fw-bold">
                                @can('admin.users.detail')
                                    <a href="{{ route('admin.users.detail', $deposit->user_id) }}">{{ @$deposit->user->username }}</a>
                                @else
                                    {{ @$deposit->user->username }}
                                @endcan
                            </span>
                        </li>
                        @if (@$deposit->gateway)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Phương thức')
                                <span class="fw-bold">{{ __(@$deposit->gateway->name) }}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Tổng')
                            <span class="fw-bold">{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Phụ phí')
                            <span class="fw-bold">{{ showAmount($deposit->charge) }} {{ __($general->cur_text) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Thêm phụ phí')
                            <span class="fw-bold">{{ showAmount($deposit->amount + $deposit->charge) }} {{ __($general->cur_text) }}</span>
                        </li>
                        @if (@$deposit->gateway)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                @lang('Rate')
                                <span class="fw-bold">22.000{{ __($general->cur_text) }}
                                    = {{ showAmount($deposit->rate) }} {{ __($deposit->baseCurrency()) }}</span>
                            </li>
                        @endif
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Payable')
                            <span class="fw-bold">{{ showAmount($deposit->final_amo) }} {{ __($deposit->method_currency) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @if ($deposit->status == 2)
                                <span class="badge badge-pill bg--warning">@lang('Pending')</span>
                            @elseif($deposit->status == 1)
                                <span class="badge badge-pill bg--success">@lang('Approved')</span>
                            @elseif($deposit->status == 3)
                                <span class="badge badge-pill bg--danger">@lang('Rejected')</span>
                            @endif
                        </li>
                        @if ($deposit->admin_feedback)
                            <li class="list-group-item">
                                <strong>@lang('Phản hồi của quản trị viên')</strong>
                                <br>
                                <p>{{ __($deposit->admin_feedback) }}</p>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @if ($details || $deposit->status == \App\Constants\Status::PAYMENT_PENDING)
            <div class="col-xl-8 col-md-6 mb-30">
                <div class="card b-radius--10 overflow-hidden box--shadow1">
                    <div class="card-body">
                        <h5 class="card-title border-bottom pb-2">@lang('Bạn không có quyền truy cập tệp này')</h5>
                        @if ($details != null)
                            @foreach (json_decode($details) as $val)
                                @if ($deposit->method_code >= 1000)
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <h6>{{ __($val->name) }}</h6>
                                            @if ($val->type == 'checkbox')
                                                {{ implode(',', $val->value) }}
                                            @elseif($val->type == 'file')
                                                @if ($val->value)
                                                    @can('admin.download.attachment')
                                                        <a class="me-3" href="{{ route('admin.download.attachment', encrypt(getFilePath('verify') . '/' . $val->value)) }}"><i class="fa fa-file"></i> @lang('Attachment') </a>
                                                    @else
                                                        <small class="text-muted">@lang('You don\'t have permission to access this file')</small>
                                                    @endcan
                                                @else
                                                    @lang('No File')
                                                @endif
                                            @else
                                                <p>{{ __($val->value) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($deposit->method_code < 1000)
                                @include('admin.deposit.gateway_data', ['details' => json_decode($details)])
                            @endif
                        @endif
                        @if ($deposit->status == \App\Constants\Status::PAYMENT_PENDING)
                            @can(['admin.deposit.approve', 'admin.deposit.reject'])
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        @can('admin.deposit.approve')
                                            <button class="btn btn-outline--success btn-sm ms-1 confirmationBtn" data-action="{{ route('admin.deposit.approve', $deposit->id) }}" data-question="@lang('Are you sure to approve this transaction?')"><i class="las la-check-double"></i>
                                                @lang('Approve')
                                            </button>
                                        @endcan
                                        @can('admin.deposit.reject')
                                            <button class="btn btn-outline--danger btn-sm ms-1 rejectBtn" data-amount="{{ showAmount($deposit->amount) }} {{ __($general->cur_text) }}" data-id="{{ $deposit->id }}" data-info="{{ $details }}" data-username="{{ @$deposit->user->username }}"><i class="las la-ban"></i> @lang('Reject')
                                            </button>
                                        @endcan
                                    </div>
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- REJECT MODAL --}}
    @can('admin.deposit.reject')
        <div class="modal fade" id="rejectModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Reject Payment Confirmation')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.deposit.reject') }}" method="POST">
                        @csrf
                        <input name="id" type="hidden">
                        <div class="modal-body">
                            <p>@lang('Bạn có chắc chắn ') <span class="fw-bold">@lang('lý do')</span> <span class="fw-bold withdraw-amount text-success"></span> @lang('deposit of') <span class="fw-bold withdraw-user"></span>?</p>

                            <div class="form-group">
                                <label class="mt-2">@lang('Lý do từ chối')</label>
                                <textarea class="form-control" name="message" required rows="5">{{ old('message') }}</textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    @can('admin.deposit.approve')
        <x-confirmation-modal />
    @endcan
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.rejectBtn').on('click', function() {
                var modal = $('#rejectModal');
                modal.find('input[name=id]').val($(this).data('id'));
                modal.find('.withdraw-amount').text($(this).data('amount'));
                modal.find('.withdraw-user').text($(this).data('username'));
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
