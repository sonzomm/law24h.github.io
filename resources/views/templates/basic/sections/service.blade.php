@php
    $serviceContent = getContent('service.content', true);
    $seviceElement = getContent('service.element', false, 4);
@endphp

<h2 style="text-align:center" class="section-title content-width wp-block-heading">
    Hoạt động của
    <mark>doanh nghiệp</mark>
</h2>

<div
    class=" ghostkit-carousel testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot testimonial-slider pull-down-a-lot"
    data-effect="slide" data-speed="0.5" data-autoplay="5" data-slides-per-view="2" data-centered-slides="false"
    data-loop="false" data-free-scroll="false" data-show-arrows="true" data-show-bullets="true"
    data-dynamic-bullets="false" data-gap="0">
    <div class="ghostkit-carousel-items">
        @foreach ($seviceElement as $service)
            <div class="ghostkit-carousel-slide">
                <div class="wp-block-mailpoet-blocks-testimonial">
                    <div class="testimonial-meta">
                        <div class="testimonial-avatar">
                            <div class="icon" style="font-size: 50px">
                                @php
                                    echo $service->data_values->icon;
                                @endphp
                            </div>
                        </div>
                        <div class="testimonial-author">
                            <strong class="testimonial-author-name strong">{{($service->data_values->name)}}</strong>
                            <span class="testimonial-stars"></span>
                        </div>
                    </div>
                    <p>{{($service->data_values->mota)}}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="ghostkit-carousel-arrow-prev-icon"><span class="fas fa-arrow-left"></span></div>
    <div class="ghostkit-carousel-arrow-next-icon"><span class="fas fa-arrow-right"></span></div>
</div>


<div class="ghostkit-carousel-arrow-prev-icon"><span class="fas fa-arrow-left"></span></div>
<div class="ghostkit-carousel-arrow-next-icon"><span class="fas fa-arrow-right"></span></div>
</div>
