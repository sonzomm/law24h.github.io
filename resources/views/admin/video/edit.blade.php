
@extends('admin.layouts.app')
@section('panel')
    <form method="post" action="{{route('video.put',$video->id)}}"  enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <h3 class="title">Edit video</h3>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    @lang('Name')
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" id="description" name="name" rows="6" >{{$video->name}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    @lang('Nội dung')
                </h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form--control" name="noidung" rows="6">{{$video->name}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    @lang('File video')
                </h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="file" name="file_upload" class="input" value="{{old('file_upload')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-4">
            <div class="form-group">
                <label> @lang('Featured') </label>
                <input @if (@$video->feature_status) checked @endif data-bs-toggle="toggle" data-height="50" data-off="@lang('không nổi bật')" data-offstyle="-danger" data-on="@lang('Nổi bật')" data-onstyle="-success" data-size="large" data-width="100%" name="feature_status" type="checkbox">
                <small class="ml-2 mt-2"><code><i class="las la-info-circle"></i> @lang('Featured video will be displayed in featured rooms section.')</code></small>
            </div>
        </div>
        @can('admin.hotel.room.type.save')
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        @can('admin.hotel.room.type.all')
            @push('breadcrumb-plugins')
                <x-back route="{{ route('admin.hotel.room.type.all') }}" />
            @endpush
        @endcan
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function (){
            $('#customer').addClass('menu-open');
            $('#customer_manage').addClass('active');
            $('#customer_create').addClass('active');
        });
    </script>
    <script>
        const inputs = document.querySelectorAll(".input");

        function focusFunc() {
            let parent = this.parentNode;
            parent.classList.add("focus");
        }

        function blurFunc() {
            let parent = this.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }

        inputs.forEach((input) => {
            input.addEventListener("focus", focusFunc);
            input.addEventListener("blur", blurFunc);
        });
    </script>
@endpush

