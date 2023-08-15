@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Slug')</th>
                                    @can(['admin.frontend.manage.section', 'admin.frontend.manage.pages.delete'])
                                        <th>@lang('Action')</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pdata as $k => $data)
                                    <tr>
                                        <td>{{ __($data->name) }}</td>
                                        <td>{{ __($data->slug) }}</td>
                                        @can(['admin.frontend.manage.section', 'admin.frontend.manage.pages.delete'])
                                            <td>
                                                <div class="button--group">
                                                    @can('admin.frontend.manage.section')
                                                        <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.frontend.manage.section', $data->id) }}"><i class="la la-pen"></i> @lang('Edit')</a>
                                                    @endcan
                                                    @can('admin.frontend.manage.pages.delete')
                                                        @if ($data->is_default == \App\Constants\Status::NO)
                                                            <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.frontend.manage.pages.delete', $data->id) }}" data-question="@lang('Are you sure to remove this page?')">
                                                                <i class="las la-trash"></i> @lang('Delete')
                                                            </button>
                                                        @endif
                                                    @endcan
                                                </div>
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
            </div><!-- card end -->
        </div>
    </div>

    {{-- Add METHOD MODAL --}}
    @can('admin.frontend.manage.pages.save')
        <div class="modal fade" id="addModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Add New Page')</h5>
                        <button aria-label="Close" class="close" data-bs-dismiss="modal" type="button">
                            <i class="las la-times"></i>
                        </button>
                    </div>
                    <form action="{{ route('admin.frontend.manage.pages.save') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label> @lang('Page Name')</label>
                                <input class="form-control" name="name" required type="text" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label> @lang('Slug')</label>
                                <input class="form-control" name="slug" required type="text" value="{{ old('slug') }}">
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

    @can('admin.frontend.manage.pages.delete')
        <x-confirmation-modal />
    @endcan
@endsection

@can('admin.frontend.manage.pages.save')
    @push('breadcrumb-plugins')
        <button class="btn btn-sm btn-outline--primary addBtn" type="button"><i class="las la-plus"></i>@lang('Add New')</button>
    @endpush
@endcan

@push('script')
    <script>
        (function($) {
            "use strict";

            $('.addBtn').on('click', function() {
                var modal = $('#addModal');
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

        })(jQuery);
    </script>
@endpush
