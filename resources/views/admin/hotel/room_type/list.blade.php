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
                                    <th>@lang('Name')</th>
                                    <th>@lang('Nội dung')</th>
                                    <th>@lang('Video')</th>
                                                                       @can(['admin.hotel.room.type.*'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($typeList as $type)
                                    <tr>
                                        <td>{{$type->name}}</td>
                                        <td>{{$type->noidung}}</td>
                                        <td>
                                            <video controls width="200px" height="200px" style="border-radius: 20px">
                                                <source src="{{asset($type->video)}}"   type="video/mp4">
                                                video
                                            </video>
                                        </td>
                                        @can(['admin.hotel.room.type.*'])
                                            <td>
                                                @can('admin.hotel.room.type.edit')
                                                    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.video.edit', $type->id) }}"> <i class="la la-pencil"></i>@lang('Edit')
                                                    </a>
                                                @endcan
                                                @can('admin.hotel.room.type.status')
                                                    @if ($type->status == 0)
                                                        <button class="btn btn-sm btn-outline--success ms-1 confirmationBtn" data-action="{{ route('admin.hotel.room.type.status', $type->id) }}" data-question="@lang('Are you sure to enable this video?')">
                                                            <i class="la la-eye"></i>@lang('Kích hoạt')
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--danger ms-1 confirmationBtn" data-action="{{ route('admin.hotel.room.type.status', $type->id) }}" data-question="@lang('Are you sure to disable this video?')">
                                                            <i class="la la-eye-slash"></i>@lang('Vô hiệu hóa')
                                                        </button>
                                                    @endif
                                                @endcan
                                            </td>
                                        @endcan

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($typeList->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($typeList) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @can('admin.hotel.room.type.status')
        <x-confirmation-modal />
    @endcan
@endsection
@can('admin.hotel.room.type.create')
    @push('breadcrumb-plugins')
        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.video.create') }}"><i class="las la-plus"></i>@lang('Add New')</a>
    @endpush
@endcan
