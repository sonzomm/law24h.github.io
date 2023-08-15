@extends($activeTemplate . 'layouts.master')
@section('content')
    <form action="">
        <div class="d-flex justify-content-end mb-3">
            <div class="input-group w-auto">
                <input class="form-control" name="search" placeholder="@lang('Search by trx , Booking no.')" type="search" value="{{ request()->search }}">
                <button class="input-group-text bg--base border-0 text-white">
                    <i class="las la-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="table-responsive--md">
        <table class="custom--table table">
            <thead>
                <tr>
                    <th>@lang('Gateway | Transaction')</th>
                    <th>@lang('Số Booking') | @lang('Tạo lúc')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Tình trạng')</th>
                    <th>@lang('CHi tiết')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deposits as $deposit)
                    <tr>
                        <td>
                            <span class="fw-bold"> <span class="text-primary">{{ __($deposit->gateway?->name) }}</span> </span>
                            <br>
                            <small> {{ $deposit->trx }} </small>
                        </td>

                        <td>
                            <small class="text--success">{{ $deposit->booking->booking_number }}</small><br>{{ showDateTime($deposit->created_at) }}
                        </td>
                        <td>
                          {{ showAmount($deposit->amount) }} + <span class="text-danger" data-bs-toggle="tooltip" title="@lang('Charge')">{{ showAmount($deposit->charge) }} </span>{{ __($general->cur_sym) }}
                            <br>
                            <strong data-bs-toggle="tooltip" title="@lang('Amount with charge')">
                                {{ showAmount($deposit->amount + $deposit->charge) }}{{($general->cur_text) }}
                            </strong>
                        </td>

                        <td>
                            @php echo $deposit->statusBadge @endphp
                        </td>
                        @php
                            $details = $deposit->detail != null ? json_encode($deposit->detail) : null;
                        @endphp

                        <td>
                            <button @if ($deposit->method_code >= 1000) data-info="{{ $details }}" @endif @if ($deposit->status == \App\Constants\Status::PAYMENT_REJECT) data-admin_feedback="{{ $deposit->admin_feedback }}" @endif class="btn btn-sm btn-outline--base ms-1 @if ($deposit->method_code >= 1000) detailBtn @else disabled @endif" title="@lang('Detail')" type="button">
                                <i class="la la-desktop"></i>
                                </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($deposits->hasPages())
        {{ $deposits->links() }}
    @endif

    {{-- APPROVE MODAL --}}
    <div class="modal fade" id="detailModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Details')</h5>
                    <span aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                        <i class="las la-times"></i>
                    </span>
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush userData mb-2 p-0">
                    </ul>
                    <div class="feedback"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark btn-sm" data-bs-dismiss="modal" type="button">@lang('Close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.detailBtn').on('click', function() {
                var modal = $('#detailModal');

                var userData = $(this).data('info');
                var html = '';
                if (userData) {
                    userData.forEach(element => {
                        if (element.type != 'file') {
                            html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>${element.name}</span>
                                <span">${element.value}</span>
                            </li>`;
                        }
                    });
                }

                modal.find('.userData').html(html);

                if ($(this).data('admin_feedback') != undefined) {
                    var adminFeedback = `
                        <div class="my-3 pt-3 border-top">
                            <h4 class="text-center">@lang('Admin Feedback')</h4>
                            <p>${$(this).data('admin_feedback')}</p>
                        </div>
                    `;
                } else {
                    var adminFeedback = '';
                }

                modal.find('.feedback').html(adminFeedback);


                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
