@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div id="content" class="content-area">
        <main id="main" class="main-content">
            <article id="post-13150"
                     class="post-13150 post type-post status-publish format-standard has-post-thumbnail hentry category-email-for-wordpress">

                <header class="entry-header">
                    <div class="wp-block-mailpoet-blocks-container">
                        <h1 class="entry-title" style="text-align:center; margin: .3em auto 1.5em">{{($blog->data_values->title) }}</h1>
                    </div>

                    <div class="post-thumbnail full-width">
                        <img
                            width="1440" height="480"
                            src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->image) }}"
                            class="attachment-single-post-thumbnail size-single-post-thumbnail wp-post-image jetpack-lazy-image">
                    </div><!-- .post-thumbnail -->


                    <div class="entry-meta">
                        <div class="author-info">
                            <a class="author-link" href="" title="Tư vấn doanh nghiệp 24h">
                                <img alt
                                     src="{{asset('images/avatar.jpeg')}}"
                                     class="avatar avatar-65 photo jetpack-lazy-image" height="65" width="65">
                            </a>
                        </div>
                        <span class="entry-date"><time class="published" datetime="2020-08-06T15:07:35+00:00">{{ showDateTime($blog->creatd_at, 'd M, Y') }}</time>
                           </span>
                    </div><!-- .entry-meta -->
                </header><!-- .entry-header -->

                <div class="content-floating-banners-wrapper">
                    <div class="content-wrapper">
                        <div class="entry-content">
                            <p>
                                @php
                                    echo $blog->data_values->description;
                                @endphp
                            </p>
                        </div><!-- .entry-content -->
                    </div><!-- .content-wrapper -->
                </div>
            </article><!-- #post-13150 -->

        </main><!-- #main -->

    </div>
    @if (count($blogLists) > 0)

                        <section class="related-posts-wrapper must-read-wrapper">
                            <div class="related-posts-title">
                                các tin tức khác</div>
                            @foreach ($blogLists as $listItem)
                            <div class="related-posts">
                                <article id="post-13150"
                                         class="post-13150 post type-post status-publish format-standard has-post-thumbnail hentry category-email-for-wordpress">

                                    <div class="content-wrapper">

                                        <header class="entry-header">

                                            <a class="post-thumbnail"
                                               href="https://www.mailpoet.com/blog/best-wordpress-email-subscription-plugins/"
                                               aria-hidden="true" tabindex="-1">
                                                <img width="600" height="340"
                                                     src="{{ getImage('assets/images/frontend/blog/thumb_' . $listItem->data_values->image, '400x280') }}"
                                                     class="attachment-single-post-must-read size-single-post-must-read wp-post-image jetpack-lazy-image">
                                            </a>
                                            <h6 class="s-post__title"><a href="{{ route('blog.details', [slug($listItem->data_values->title), $listItem->id]) }}">{{ __($listItem->data_values->title) }}</a></h6>
                                        </header><!-- .entry-header -->

                                        <div class="entry-excerpt">
                                            <p>@php echo strLimit(strip_tags($blog->data_values->description), 100)  @endphp</p>
                                            <p class="fs--14px mt-2"><i class="las la-calendar-alt fs--14px me-1"></i>{{ showDateTime($listItem->creatd_at, 'd M, Y') }}</p>
                                        </div><!-- .entry-content -->
                                    </div><!-- .content-wrapper -->

                                </article><!-- #post-13150 -->
                            </div>
                            @endforeach
                        </section>
    @endif

@endsection


@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush

