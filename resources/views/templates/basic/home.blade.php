@extends($activeTemplate . 'layouts.frontend')
@section('content')
    @include($activeTemplate . 'sections.banner')
    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
    <div data-elementor-type="popup" data-elementor-id="3480" class="elementor elementor-3480 elementor-location-popup"
         data-elementor-settings="{&quot;entrance_animation&quot;:&quot;bounceInUp&quot;,&quot;exit_animation&quot;:&quot;slideInUp&quot;,&quot;entrance_animation_duration&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:0.6999999999999999555910790149937383830547332763671875,&quot;sizes&quot;:[]},&quot;a11y_navigation&quot;:&quot;yes&quot;,&quot;triggers&quot;:{&quot;click&quot;:&quot;yes&quot;,&quot;page_load_delay&quot;:3,&quot;page_load&quot;:&quot;yes&quot;,&quot;click_times&quot;:1},&quot;timing&quot;:[]}">
        <section class="elementor-section elementor-top-section elementor-element elementor-element-52a666aa elementor-section-height-min-height elementor-section-items-stretch elementor-section-boxed elementor-section-height-default" data-id="52a666aa" data-element_type="section">
            <div class="elementor-container elementor-column-gap-default">
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-4b217c51" data-id="4b217c51" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div class="elementor-element elementor-element-4fd6b30f elementor-widget elementor-widget-spacer" data-id="4fd6b30f" data-element_type="widget" data-widget_type="spacer.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-spacer">
                                    <div class="elementor-spacer-inner">
                                        <img src="{{'images/email.jpg'}}" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-f8846c4"
                     data-id="f8846c4" data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <section
                            class="elementor-section elementor-inner-section elementor-element elementor-element-78fec983 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                            data-id="78fec983" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div
                                    class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-648abded"
                                    data-id="648abded" data-element_type="column">
                                    <div class="elementor-widget-wrap elementor-element-populated">
                                        <div
                                            class="elementor-element elementor-element-16dc7a45 elementor-widget__width-initial elementor-widget elementor-widget-heading"
                                            data-id="16dc7a45" data-element_type="widget" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h2 class="elementor-heading-title elementor-size-default">
                                                    <b>Dịch vụ doanh nghiệp 24H</b>
                                                    <br>
                                                    Chào mừng đến với chúng tôi!
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
