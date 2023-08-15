@php
$video = \App\Models\video::active()->featured()->get();
@endphp
<div class="wp-block-mailpoet-blocks-container two-step-gradient">
<h3 style="text-align:center" class="section-title content-width wp-block-heading">
    Tư vấn nổi bật
</h3>

    <div class="ghostkit-carousel template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider template-slider"
        data-effect="slide"
         data-speed="0.5"
         data-autoplay="5"
         data-slides-per-view="5"
         data-centered-slides="false"
        data-loop="false"
         data-free-scroll="false"
         data-show-arrows="true"
         data-show-bullets="true"
        data-dynamic-bullets="false"
         data-gap="15">
        <div class="ghostkit-carousel-items">
            @foreach($video as $video)
                <div class="ghostkit-carousel-slide">
                    <div class="wp-block-mailpoet-blocks-email-template">
                        <a href="#" class="mailpoet-email-template-link" data-template="31-jazz-club"><span class="template-image">
                <div class="video anim" style="--delay:.4s">
                  <div class="video-wrapper">
                    <video src="{{asset($video->video)}}">
                    </video>
                    <div class="stream-area">
                    </div>
                    <div class="author-img__wrapper video-author">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                           stroke-linejoin="round" class="feather feather-check">
                        <path d="M20 6L9 17l-5-5" />
                      </svg>
                      <img class="author-img"
                           src="{{asset('images/avatar.jpeg')}}" />
                    </div>
                  </div>
                  <div class="video-by">{{$video->name}}</div>
                  <div class="video-name">{{$video->noidung}}</div>
                </div>
              </span></a>
                    </div>
                </div>
            @endforeach

        </div>
        <div>

        </div>
        <a href="{{route('video.show')}}" style="">
            <p class="section-title content-width wp-block-heading"> Xem thêm<i class="las la-long-arrow-alt-right"></i>
{{--                <img src="{{asset('images/tik-tok.png')}}" alt="">--}}
            </p>
        </a>

    </div>

</div>

