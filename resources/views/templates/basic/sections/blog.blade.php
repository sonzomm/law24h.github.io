@php
$blogContent  = getContent('blog.content', true);
$blogElements = getContent('blog.element', false, 3, true);
@endphp
<div class="wp-block-mailpoet-blocks-container brand-gradient making-email-better">
    <div style="fill:#ffffff" class="wp-block-mailpoet-blocks-seperator">
        <svg preserveaspectratio="none"
             viewbox="0 0 1320 362" width="1320" height="362" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0h1320v46.7c-143.2,106.5-363.2,159.8-660,159.8S143.2,258.101,0,361.4V0z"></path>
        </svg>
    </div>
</div>
<div class="wp-block-mailpoet-blocks-container logos">
    <img decoding="async" width="200" height="100" src="{{asset('images/law.png')}}" alt class="wp-image-8578 jetpack-lazy-image"
         data-recalc-dims="1">
</div>

<section class="related-posts-wrapper must-read-wrapper">
    <div class="related-posts-title">{{($blogContent->data_values->heading) }}</div>
{{--    <p>{{ __($blogContent->data_values->subheading) }}</p>--}}
    <div class="related-posts">
        @foreach ($blogElements as $blog)
            <article id="post-9290" class="post-9290 post type-post status-publish format-standard has-post-thumbnail hentry category-email-writing-tips">
                <div class="content-wrapper">
                    <header class="entry-header">
                        <a class="post-thumbnail" href="" aria-hidden="true" tabindex="-1">
                            <img width="600" height="40"  src="{{ getImage('assets/images/frontend/blog/thumb_' . $blog->data_values->image, '400x280') }}" alt="image" class="attachment-single-post-must-read size-single-post-must-read wp-post-image jetpack-lazy-image"
                                 decoding="async"> </a>
                        <h2 class="entry-title">
                            <a class="plain-link" href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}"> @php echo substr(trans($blog->data_values->title),0,60) @endphp</a>
                        </h2>
                    </header><!-- .entry-header -->
                    <div class="entry-excerpt">
                        <p>@php echo strLimit(strip_tags($blog->data_values->description), 100)  @endphp</p>
                        <a href="{{ route('blog.details', [slug($blog->data_values->title), $blog->id]) }}" class="mt-3">@lang('Chi tiết') <i class="las la-long-arrow-alt-right"></i></a>

                        </a>
                    </div><!-- .entry-content -->
                </div><!-- .content-wrapper -->
            </article><!-- #post-9290 -->
        @endforeach
    </div>
</section>

