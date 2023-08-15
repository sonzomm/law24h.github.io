@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                                <tr>
                                    <th>@lang('Tiêu đề')</th>
                                    <th>@lang('Gửi bởi')</th>
                                    <th>@lang('Tình trạng')</th>
                                    <th>@lang('Mức độ')</th>
                                    <th>@lang('Câu trả lời gần nhất')</th>
                                    @can('admin.ticket.view')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $item)
                                    <tr>
                                        <td>
                                            @can('admin.ticket.view')
                                                <a class="fw-bold" href="{{ route('admin.ticket.view', $item->id) }}"> [@lang('Ticket')#{{ $item->ticket }}] {{ strLimit($item->subject, 30) }} </a>
                                            @else
                                                <span class="fw-bold"> [@lang('Ticket')#{{ $item->ticket }}] {{ strLimit($item->subject, 30) }} </span>
                                            @endcan
                                        </td>

                                        <td>
                                            @if ($item->user_id)
                                                @can('admin.users.detail')
                                                    <a href="{{ route('admin.users.detail', $item->user_id) }}"> {{ __($item->user->fullname) }}</a>
                                                @else
                                                    <p class="fw-bold">{{ __($item->user->fullname) }}</p>
                                                @endcan
                                            @else
                                                <p class="fw-bold"> {{ $item->name }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @php echo $item->statusBadge; @endphp
                                        </td>
                                        <td>
                                            @if ($item->priority == \App\Constants\Status::PRIORITY_LOW)
                                                <span class="badge badge--dark">@lang('Low')</span>
                                            @elseif($item->priority == \App\Constants\Status::PRIORITY_MEDIUM)
                                                <span class="badge  badge--warning">@lang('Medium')</span>
                                            @elseif($item->priority == \App\Constants\Status::PRIORITY_HIGH)
                                                <span class="badge badge--danger">@lang('High')</span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ diffForHumans($item->last_reply) }}
                                        </td>
                                        @can('admin.ticket.view')
                                            <td>
                                                <a class="btn btn-sm btn-outline--primary ms-1" href="{{ route('admin.ticket.view', $item->id) }}">
                                                    <i class="las la-desktop"></i> @lang('Details')
                                                </a>
                                            </td>
                                        @endcan
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
                @if ($items->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($items) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>
@endsection
