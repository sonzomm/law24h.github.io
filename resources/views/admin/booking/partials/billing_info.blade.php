<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="card-title">@lang('Thông tin')</h5>
            @can('admin.booking.details')
                <a class="btn btn-sm btn--primary" href="{{ route('admin.booking.details', $booking->id) }}"> <i class="las la-desktop"></i>@lang('chi tiết')</a>
            @endcan
        </div>
        <div class="list">
            <div class="list-item">
                <span>@lang('Tổng phí')</span>
                <span class="text-end">+{{  showAmount($totalFare)  .$general->cur_sym}}</span>
            </div>

            <div class="list-item">
                <span>{{($general->tax_name)}} @lang('phụ phí')</span>
                <span class="text-end">+{{  showAmount($totalTaxCharge). $general->cur_sym }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Phí hủy')</span>
                <span class="text-end">-{{  showAmount($canceledFare) .$general->cur_sym }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Phí') {{($general->tax_name) }} @lang('hủy')</span>
                <span class="text-end">-{{ showAmount($canceledTaxCharge) .  $general->cur_sym}}</span>
            </div>

            <div class="list-item">
                <span>@lang('Phí dịch vụ ngoài')</span>
                <span class="text-end">+{{  showAmount($booking->service_cost).$general->cur_sym  }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Phí khác')</span>
                <span class="text-end">+{{showAmount($booking->extraCharge()) .$general->cur_sym}}</span>
            </div>

            <div class="list-item">
                <span>@lang('Phí hủy')</span>
                <span class="text-end">+{{  showAmount($booking->cancellation_fee).$general->cur_sym  }}</span>
            </div>

            <div class="list-item">
                <span class="fw-bold">@lang('Tổng')</span>
                <span class="fw-bold text-end"> = {{  showAmount($booking->total_amount).  $general->cur_sym}}</span>
            </div>

        </div>
    </div>
</div>
