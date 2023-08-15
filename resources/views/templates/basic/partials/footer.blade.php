@php
    $socialElement = getContent('social_icon.element', false, null, true);
    $policyElement = getContent('policy_pages.element', false, null, true);
    $footerContent = getContent('footer.content', true);
    $contactContent = getContent('contact_us.content', true);
@endphp
<style>
    .footer-widget .social-links li a,
    .footer-short-links li {
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }
    .footer-line::after,
    .footer-widget .social-links li a:hover,
    .footer-short-links li::before{
        background-color: var(--base-color);
    }
    .footer-widget .social-links,
    .footer-widget .social-links li a,
    .footer-widget .footer-contact-info li{
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .footer-widget .social-links li a{
        justify-content: center;
    }
    .footer-widget .social-links,
    .footer-widget .social-links li a{
        align-items: center;
    }
</style>
<footer id="colophon" class="site-footer two-step-gradient" >
    <div class="footer-menu">
        <ul id="footer-menu" class="menu menu-footer">
            <li class="menu-item footer-menu-header">
                <img src="{{asset('images/logo.png')}}" alt="">
            </li>
            <li id="menu-item-8597"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8597 nav-link">
                <a href="#"><span>CÔNG TY TNHH TƯ VẤN VÀ DỊCH VỤ TỔNG HỢP 24H</span></a>
                <ul class="sub-menu">
                    <li id="menu-item-8601" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8601"><a>
                            <span>{{($contactContent->data_values->Address_1)}}</span></a></li>
                    <li id="menu-item-8603" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8603">
                        <a href="">
                            <span>{{($contactContent->data_values->Address_2)}}</span>
                        </a>
                    </li>
                    <li id="menu-item-8604" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8604"><a
                            href="{{($contactContent->data_values->contact_number_1)}}">
                            <span>{{($contactContent->data_values->contact_number_1)}}</span></a></li>
                    <li id="menu-item-8604" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8604"><a
                            href="{{($contactContent->data_values->contact_number_2)}}">
                            <span>{{($contactContent->data_values->contact_number_2)}}</span></a></li>
                    <li id="menu-item-8616" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8616"><a
                            target="_blank" rel="noopener" href="mailto:{{($contactContent->data_values->email_address)}}"><span>

                                {{($contactContent->data_values->email_address)}}</span></a></li>
                    <div class="footer-widget" >
                       @if (count($socialElement) > 0)
                            <ul class="social-links mt-4" style="list-style:none;">
                                @foreach ($socialElement as $social)
                                    <li style="margin: 10px">
                                        <a href="{{ $social->data_values->url }}" target="_blank">
                                            @php
                                                echo $social->data_values->social_icon;
                                            @endphp
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </ul>
            </li>
            <li id="menu-item-8600"
                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8600 nav-link">
                <a href="#"><span>Địa chỉ</span></a>
                <ul class="sub-menu">
                    <iframe src="{{($contactContent->data_values->map)}}" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </ul>
            </li>
        </ul>
    </div>
</footer>
