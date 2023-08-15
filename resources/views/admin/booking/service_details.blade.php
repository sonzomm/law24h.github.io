@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('S.N.')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Số phòng')</th>
                                    <th>@lang('Dịch vụ')</th>
                                    <th>@lang('Số lượng')</th>
                                    <th>@lang('Chi phí')</th>
                                    <th>@lang('Tổng')</th>
                                    <th>@lang('Được thêm bởi')</th>
                                    @can('admin.extra.service.delete')
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($services as $service)
                                    <tr>
                                        <td>{{ $services->firstItem() + $loop->index }}</td>

                                        <td>
                                            <span class="fw-bold">{{ showDateTime($service->service_date, 'd M, Y') }}</span>
                                        </td>

                                        <td><span class="fw-bold">{{ $service->room->room_number }}</span></td>

                                        <td>{{ ($service->extraService->name) }}</td>

                                        <td>{{ $service->qty }}</td>

                                        <td>{{ showAmount($service->unit_price) }}{{ $general->cur_sym }}</td>

                                        <td>{{ showAmount($service->total_amount) }}{{ $general->cur_sym }}</td>

                                        <td>
                                            <span class="fw-bold">{{($service->admin->name) }}</span>
                                        </td>

                                        @can('admin.extra.service.delete')
                                            <td>
                                                <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.extra.service.delete', $service->id) }}" data-question="@lang('Bạn có chắc chắn, bạn muốn xóa dịch vụ này?')">
                                                    <i class="las la-trash-alt"></i>@lang('xóa')
                                                </button>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($services->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($services) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @can('admin.extra.service.delete')
        <x-confirmation-modal />
    @endcan
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Room No. / Service Name" />
@endpush
