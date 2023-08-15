@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="col-md-12">
        <div class="table-responsive--md">
            <table class="custom--table table">
                <thead>
                    <tr>
                        <th>@lang('S.N.')</th>
                        <th>@lang('Tiêu đề')</th>
                        <th>@lang('Tình trạng')</th>
                        <th>@lang('Ưu tiên')</th>
                        <th>@lang('Trả lời gần nhất')</th>
                        <th>@lang('Action')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($supports as $support)
                        <tr>
                            <td> {{ $supports->firstItem() + $loop->index }}</td>
                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}"> [@lang('Hỗ trợ')#{{ $support->ticket }}] {{ __($support->subject) }} </a>
                            </td>
                            <td>
                                @php echo $support->statusBadge; @endphp
                            </td>
                            <td>
                                @if ($support->priority == \App\Constants\Status::PRIORITY_LOW)
                                    <span class="badge badge--dark">@lang('Low')</span>
                                @elseif($support->priority == App\Constants\Status::PRIORITY_MEDIUM)
                                    <span class="badge badge--secondary">@lang('Medium')</span>
                                @elseif($support->priority == App\Constants\Status::PRIORITY_HIGH)
                                    <span class="badge badge--primary">@lang('High')</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                            <td>
                                <a href="{{ route('ticket.view', $support->ticket) }}" title="@lang('View')" class="btn btn-sm btn-outline--base">
                                    <i class="las la-desktop"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $supports->links() }}
    </div>
@endsection
