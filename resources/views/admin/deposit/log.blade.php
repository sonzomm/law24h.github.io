    @extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        @if (request()->routeIs('admin.deposit.list') || request()->routeIs('admin.deposit.method') || request()->routeIs('admin.users.deposits') || request()->routeIs('admin.users.deposits.method'))
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--success has-link">
                    <a class="item-link" href="@if (can('admin.deposit.successful')) {{ route('admin.deposit.successful') }} @else javascript:void(0) @endif"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ showAmount($successful) }}{{ __($general->cur_sym) }}</h2>
                        <p class="text-white">@lang('Thanh toán thành công')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 b-radius--5 bg--6 has-link">
                    <a class="item-link" href="@if (can('admin.deposit.pending')) {{ route('admin.deposit.pending') }} @else javascript:void(0) @endif"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ showAmount($pending) }}{{ __($general->cur_sym) }}</h2>
                        <p class="text-white">@lang('Thanh toán đang chờ')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 has-link b-radius--5 bg--pink">
                    <a class="item-link" href="@if (can('admin.deposit.rejected')) {{ route('admin.deposit.rejected') }} @else javascript:void(0) @endif"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ showAmount($rejected) }}{{ __($general->cur_sym) }}</h2>
                        <p class="text-white">@lang('Rejected Payment')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
            <div class="col-xxl-3 col-sm-6 mb-30">
                <div class="widget-two box--shadow2 has-link b-radius--5 bg--dark">
                    <a class="item-link" href="@if (can('admin.deposit.failed')) {{ route('admin.deposit.failed') }} @else javascrit:void(0) @endif"></a>
                    <div class="widget-two__content">
                        <h2 class="text-white">{{ showAmount($initiated) }}{{ __($general->cur_sym) }}</h2>
                        <p class="text-white">@lang('Thanh toán thất bại')</p>
                    </div>
                </div><!-- widget-two end -->
            </div>
        @endif

        <div class="col-md-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Thanh toán qua') | @lang('Mã giao dịch')</th>
                                    <th></th>
                                    <th>@lang('User')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Tình trạng')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($deposits as $deposit)
                                    @php
                                        $details = $deposit->detail ? json_encode($deposit->detail) : null;
                                    @endphp
                                    <tr>
                                        <td>
                                            @if (@$deposit->gateway)
                                                <span class="fw-bold"> <a href="{{ appendQuery('method', @$deposit->gateway->alias) }}">{{ __(@$deposit->gateway->name) }}</a> </span>
                                            @else
                                                <span class="fw-bold"> {{ __($deposit->paymentVia()) }}</span>
                                            @endif
                                            <br>
                                            <small> {{ $deposit->trx }} </small>
                                        </td>

                                        <td>
                                            {{ showDateTime($deposit->created_at) }}<br>{{ diffForHumans($deposit->created_at) }}
                                        </td>
                                        <td>
                                            @if ($deposit->user)
                                                <span class="fw-bold">{{ @$deposit->user->fullname }}</span>
                                                <br>
                                                <span class="small">
                                                    <a href="{{ appendQuery('search', @$deposit->user->username) }}"><span>@</span>{{ $deposit->user->username }}</a>
                                                </span>
                                            @else
                                                <span class="fw-bold">@lang('Khách')</span>
                                            @endif
                                        </td>
                                        <td>
                                           {{ showAmount($deposit->amount) }} {{ __($general->cur_sym) }} + <span class="text-danger" title="@lang('charge')">{{ showAmount($deposit->charge) }} </span>
                                            <br>
                                            <strong title="@lang('Amount with charge')">
                                                {{ showAmount($deposit->amount + $deposit->charge) }} {{ __($general->cur_text) }}
                                            </strong>
                                        </td>

                                        <td>
                                            @php echo $deposit->statusBadge @endphp
                                        </td>

                                        <td>
                                            @if ($deposit->user)
                                                <a class="btn btn-sm btn-outline--primary @if (!can('admin.deposit.details')) disabled @endif" href="@if (can('admin.deposit.details')) {{ route('admin.deposit.details', $deposit->id) }} @else javascript:void(0) @endif">
                                                    <i class="la la-desktop"></i>@lang('Chi tiết')
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-outline--primary disabled">
                                                    <i class="la la-desktop"></i> @lang('Chi tiết')
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                @if ($deposits->hasPages())
                    <div class="card-footer py-4">
                        @php echo paginateLinks($deposits) @endphp
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    @if (!request()->routeIs('admin.users.deposits') && !request()->routeIs('admin.users.deposits.method'))
        <x-search-form dateSearch='yes' />
    @endif
@endpush
