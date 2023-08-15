@extends('admin.layouts.app')
@section('panel')
    <form action="{{ route('admin.permissions.update') }}" method="POST">
        @csrf
        <div class="row gy-4">
            @php
                $i = 0;
            @endphp

            @foreach ($permissions as $key => $permissionGroups)
                <div class="col-12">
                    <div class="card b-radius--10">
                        <div class="card-header">
                            <h6 class="card-title m-0">{{ $key }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row gx-5">
                                @foreach ($permissionGroups as $permission)
                                    <div class="col-lg-4">
                                        <div class="form-group ">
                                            <div class="d-flex flex-wrap gap-1 align-items-center mb-1">
                                                <label class="text--cyan">{{ $permission->code }}</label>
                                            </div>
                                            <input name="permission[{{ $i }}][id]" type="hidden" value="{{ $permission->id }}">
                                            <div class="input-group w-auto">
                                                <span class="input-group-text">@lang('Name')</span>
                                                <input class="form-control" name="permission[{{ $i }}][name]" placeholder="Name" type="text" value="{{ old('permission')[$i]['name'] ?? ucwords($permission->name) }}">
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                @php
                    $i++;
                @endphp
            @endforeach
        </div>
        <button class="btn btn--primary w-100 h-45 mt-3" type="submit">@lang('Update')</button>
    </form>
@endsection
