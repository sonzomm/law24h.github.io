<!-- meta tags and other links -->
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" lang="{{ config('app.locale') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <title> {{ $general->siteName(__($pageTitle)) }}</title>


    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/global/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/global/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/global/css/line-awesome.min.css') }}" rel="stylesheet" />

    <!-- slick slider css -->
    <link href="{{ asset($activeTemplateTrue . 'css/slick.css') }}" rel="stylesheet">
    <!-- lightcase css -->
    <link href="{{ asset($activeTemplateTrue . 'css/lightcase.css') }}" rel="stylesheet">
    <!-- jquery ui css -->
    <link href="{{ asset($activeTemplateTrue . 'css/jquery-ui.css') }}" rel="stylesheet">
    <!-- datepicker css -->
    <link href="{{ asset('assets/global/css/vendor/datepicker.min.css') }}" rel="stylesheet">
    <!-- main css -->
    <link href="{{ asset($activeTemplateTrue . 'css/main.css') }}" rel="stylesheet">

    <link href="{{ asset($activeTemplateTrue . 'css/custom.css') }}" rel="stylesheet">

    @stack('style-lib')

    @stack('style')
    <link rel="stylesheet" href="{{asset("css/test1.css")}}">
    <link href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ $general->base_color }}" rel="stylesheet">
</head>

<body>

@include("templates/basic/partials/header")

@if ($layout == 'frontend')
    <section class="pt-80 pb-80" style="margin-top:20px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    @endif

                    <div class="card custom--card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-10 d-flex align-items-center flex-wrap">
                                    @php echo $myTicket->statusBadge; @endphp

                                    <h6 class="ms-2">[@lang('Hỗ trợ')#{{ $myTicket->ticket }}] {{ $myTicket->subject }}</h6>
                                </div>
                                <div class="col-sm-2 text-end">
                                    @if ($myTicket->status != \App\Constants\Status::TICKET_CLOSE && $myTicket->user)
                                        <button class="btn btn--danger btn-sm confirmationBtn" type="button"
                                                data-question="@lang('Bạn có chắc chắn sẽ kết thức này không?')" data-action="{{ route('ticket.close', $myTicket->id) }}"
                                                @guest disabled @endguest><i class="la la-lg la-times-circle"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <textarea name="message" class="form--control" placeholder="@lang('Your reply message...')">{{ old('message') }}</textarea>
                                </div>

                                <div class="text-end">
                                    <a href="javascript:void(0)" class="btn btn-outline--base btn-sm addFile"><i class="la la-plus"></i>
                                        @lang('Add New')</a>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">@lang('Đính kèm')</label> <small class="text-danger">@lang('Max 5 files can be uploaded').
                                        @lang('Kích thước tải lên tối đa là') {{ ini_get('upload_max_filesize') }}</small>
                                    <input type="file" name="attachments[]" class="form-control custom--file-upload" />
                                    <div id="fileUploadsContainer"></div>
                                    <p class="ticket-attachments-message text-muted my-2">
                                        @lang('Chỉ hỗ trợ'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'),
                                        .@lang('pdf'), .@lang('doc'), .@lang('docx')
                                    </p>
                                </div>
                                <div class="form-group text-end">
                                    <button type="submit" class="btn btn-md btn--base w-100">@lang('Reply')</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card custom--card mt-4 border-0 bg-transparent">
                        @foreach ($messages as $message)
                            @if ($message->admin_id == 0)
                                <div class="single-reply">
                                    <div class="left">
                                        <h6>{{ $message->ticket->name }}</h6>
                                    </div>
                                    <div class="right">
                                        <small class="fs--14px text--base mb-2">@lang('Posted on')
                                            {{ $message->created_at->format('l, dS F Y @ H:i') }}</small>
                                        <p>{{ $message->message }}</p>
                                        @if ($message->attachments->count() > 0)
                                            <div class="mt-2">
                                                @foreach ($message->attachments as $k => $image)
                                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}" class="me-3"><i
                                                            class="la la-file"></i> @lang('Attachment') {{ ++$k }} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="single-reply author-reply">
                                    <div class="left">
                                        <h6>{{ $message->admin->name }}</h6>
                                        <small class="lead text-muted">@lang('Staff')</small>
                                    </div>
                                    <div class="right">
                                        <small class="fs--14px text--base mb-2">@lang('Posted on')
                                            {{ $message->created_at->format('l, dS F Y @ H:i') }}</small>
                                        <p>{{ $message->message }}</p>
                                        @if ($message->attachments->count() > 0)
                                            <div class="mt-2">
                                                @foreach ($message->attachments as $k => $image)
                                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}" class="me-3"><i
                                                            class="la la-file"></i> @lang('Attachment') {{ ++$k }} </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        </div>

        @if ($layout == 'frontend')
            </div>
    </section>
@endif

<x-confirmation-modal />

@push('style')
    <style>
        .input-group-text:focus {
            box-shadow: none !important;
        }
        #confirmationModal .btn {
            padding: 0.375rem .75rem !important;
        }
        .author-reply {
            background-color: #ab8a625c;
        }
    </style>
@endpush
@push('script')
    <script>
        (function($) {
            "use strict";
            var fileAdded = 0;
            $('.addFile').on('click', function() {
                if (fileAdded >= 4) {
                    notify('error', 'You\'ve added maximum number of file');
                    return false;
                }
                fileAdded++;
                $("#fileUploadsContainer").append(`
                    <div class="input-group my-3">
                        <input type="file" name="attachments[]" class="form-control custom--file-upload" required />
                        <button type="button" class="input-group-text btn-danger remove-btn"><i class="las la-times"></i></button>
                    </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                fileAdded--;
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush

@include("templates/basic/partials/footer")
<!-- jQuery library -->
<script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>

<!-- slick  slider js -->
<script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
<!-- wow js  -->
<script src="{{ asset($activeTemplateTrue . 'js/wow.min.js') }}"></script>

<!-- lightcase js -->
<script src="{{ asset($activeTemplateTrue . 'js/lightcase.js') }}"></script>

<!-- jquery ui js -->
<script src="{{ asset($activeTemplateTrue . 'js/jquery-ui.js') }}"></script>

@stack('script-lib')
<!-- main js -->
<script src="{{ asset($activeTemplateTrue . 'js/app.js') }}"></script>



@stack('script')

@include('partials.notify')

<script>
    (function($) {
        "use strict";
        $(".langSel").on("change", function() {
            window.location.href = "{{ route('home') }}/change/" + $(this).val();
        });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            matched = event.matches;
            if (matched) {
                $('body').addClass('dark-mode');
                $('.navbar').addClass('navbar-dark');
            } else {
                $('body').removeClass('dark-mode');
                $('.navbar').removeClass('navbar-dark');
            }
        });

        let matched = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (matched) {
            $('body').addClass('dark-mode');
            $('.navbar').addClass('navbar-dark');
        } else {
            $('body').removeClass('dark-mode');
            $('.navbar').removeClass('navbar-dark');
        }

        var inputElements = $('[type=text],[type=password],[type=email],[type=number],select,textarea');
        $.each(inputElements, function(index, element) {
            element = $(element);
            element.closest('.form-group').find('label').attr('for', element.attr('name'));
            element.attr('id', element.attr('name'))
        });


        $('.policy').on('click', function() {
            $.get('{{ route('cookie.accept') }}', function(response) {
                $('.cookies-card').addClass('d-none');
            });
        });

        setTimeout(function() {
            $('.cookies-card').removeClass('hide')
        }, 2000);

        var inputElements = $('[type=text],select,textarea');
        $.each(inputElements, function(index, element) {
            element = $(element);
            element.closest('.form-group').find('label').attr('for', element.attr('name'));
            element.attr('id', element.attr('name'))
        });

        $.each($('input, select, textarea'), function(i, element) {
            var elementType = $(element);
            if (elementType.attr('type') != 'checkbox') {
                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }
            }

        });

    })(jQuery);
</script>
</body>

</html>




