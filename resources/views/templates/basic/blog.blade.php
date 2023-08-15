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
<section class="section">
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @foreach ($blogs as $blog)
                <div class="col-xl-4 col-md-6">
                    <div class="blog-post h-100">
                        <div class="blog-post__thumb">
                            <img src="{{ getImage('assets/images/frontend/blog/thumb_' . $blog->data_values->image, '400x280') }}" alt="image">
                        </div>
                        <div class="blog-post__content">
                            <div class="blog-meta">
                                <div class="date-time">
                                    <span class="blog-date">{{ showDateTime($blog->creatd_at, 'd M, Y') }}</span>
                                </div>
                            </div>
                            <h3 class="title"><a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}"> @php echo substr(trans($blog->data_values->title),0,60) @endphp</a></h3>
                            <p class="mt-sm-3 mt-2">@php echo substr(trans(strip_tags($blog->data_values->description)),0,100)  @endphp</p>
                            <a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" class="mt-3">@lang('Read More') <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($blogs->hasPages())
            <nav aria-label="Page navigation example">
                {{ paginateLinks($blogs) }}
            </nav>
        @endif
    </div>
</section>

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




