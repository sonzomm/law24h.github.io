@php
    $bannerContent = getContent('banner.content', true);
    $bannerElement = getContent('banner.element',false,3,true);
@endphp

<div class="comp-HeroHomepage">

    <div class="comp-HeroHomepage__carousel">
        <div class="comp-HeroHomepage__slides">
            @foreach ($bannerElement as $item)
                <div class="comp-HeroHomepage__slide">
                    <div class="comp-HeroHomepage__slide__image" style="background-image:url('{{ getImage('assets/images/frontend/banner/' . $item->data_values->image,'1200x800') }}');"></div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="comp-HeroHomepage__overlay"></div>
    <div class="comp-HeroHomepage__content">
        <div class="grid-container">
            <div class="row">
                <div class="column xsmall-12 large-10 offset-large-1">
                    <h1 class="comp-HeroHomepage__heading">
                        {{($bannerContent->data_values->heading) }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wp-block-mailpoet-blocks-container">

    <div class="wp-block-columns  happiness-score-block pull-up">
        <div class="wp-block-column">

        </div>

        <div class="wp-block-column">
            <button class="menu-button menu-button-secondary">liên hệ ngay</button>
        </div>


        <div class="wp-block-column">

            <p data-ghostkit-sr="fade-up" style="color: #fff; text-align: center;">0909 016 286 (HN) - 0816.39.6269 (TP.HCM)
            </p>
            <p data-ghostkit-sr="fade-up" style="color: #fff;text-align: center;">law24h2013@gmail.com</p>
        </div>
        <div class="wp-block-column">

        </div>

    </div>
</div>


@push('script-lib')
    <script src="{{ asset('assets/global/js/vendor/datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/global/js/vendor/datepicker.en.js') }}"></script>
@endpush
