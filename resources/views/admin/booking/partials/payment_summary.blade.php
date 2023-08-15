<div class="card">
    <div class="card-body">
        <h5 class="card-title">@lang('Tổng')</h5>
        <div class="list">
            <div class="list-item">
                <span>@lang('Tổng thanh toán')</span>
                <span>+{{  showAmount($booking->total_amount).$general->cur_sym}}</span>
            </div>

            <div class="list-item">
                <span>@lang('Thanh toán đã nhận')</span>
                <span>-{{ showAmount($receivedPayments->sum('amount')) }}{{ $general->cur_sym }}</span>
            </div>

            <div class="list-item">
                <span>@lang('Hoàn tiền')</span>
                <span>-{{ showAmount($returnedPayments->sum('amount')) }}{{ $general->cur_sym }}</span>
            </div>

            <div class="list-item fw-bold">
                @if ($due < 0)
                    <span class="text-danger">@lang('Có thể hoàn tiền') </span>
                    <span class="text-danger"> = {{ showAmount(abs($due)) }}{{ $general->cur_sym }}</span>
                @else
                    <span>@lang('Phải thu từ người dùng')</span>
                    <span> = {{ showAmount(abs($due)) }}{{ $general->cur_sym }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
