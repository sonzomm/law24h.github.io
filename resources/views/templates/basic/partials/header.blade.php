@php
    $contactContent = getContent('contact_us.content', true);
    $socialElements = getContent('social_icon.element', false, null, true);
@endphp
<header id="masthead">
    <div class="site-header">
        <div class="header-wrapper">
            <div class="site-branding">
                    <a href="{{route('home')}}"><img src="{{asset('images/logo.png')}}" alt=""></a>
            </div>
            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle round-button button-secondary" aria-controls="menu-wrapper" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12">
                        <title>Menu toggle</title>
                        <g id="Layer_2" data-name="Layer 2">
                            <g id="Layer_2-2" data-name="Layer 2">
                                <rect y="4.52" width="12" height="2.96" rx="1.41" ry="1.41" />
                                <rect y="9.04" width="12" height="2.96" rx="1.41" ry="1.41" />
                                <rect width="12" height="2.96" rx="1.41" ry="1.41" />
                            </g>
                        </g>
                    </svg> <span class="screen-reader-text">Primary Menu</span>
                </button>
                <div class="menu-wrapper">
                    <div class="menu-header wrapper">
                        <button class="menu-toggle round-button button-secondary" aria-controls="menu-wrapper" aria-expanded="false">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 12 12"
                                 style="enable-background:new 0 0 12 12;" xml:space="preserve">
                                <g id="Layer_2_1_">
                                    <g id="Layer_2-2">
                                        <path d="M10.9,8.8L8.1,6l2.8-2.8c0.6-0.6,0.6-1.5,0-2.1c-0.6-0.6-1.5-0.6-2.1,0L6,3.9L3.2,1.1c-0.6-0.6-1.5-0.6-2.1,0
					s-0.6,1.5,0,2.1L3.9,6L1.1,8.8c-0.6,0.6-0.6,1.5,0,2.1c0.6,0.6,1.5,0.6,2.1,0L6,8.1l2.8,2.8c0.6,0.6,1.5,0.6,2.1,0
					C11.5,10.4,11.5,9.4,10.9,8.8z" />
                                    </g>
                                </g>
								</svg>
                        </button>
                    </div>
                    <ul id="main-menu" class="menu menu-main">
                        <li id="menu-item-12364"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-12364 nav-link">
                            <a href=""><span>Dịch vụ</span><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.33 10.89">
                                    <title>Arrow</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="Layer_2-2" data-name="Layer 2">
                                            <path
                                                d="M13,4.74,8.76.44A1.5,1.5,0,0,0,6.64,2.56L8,4H1.5a1.5,1.5,0,0,0,0,3H8L6.64,8.33a1.5,1.5,0,1,0,2.12,2.12L13,6.15A1,1,0,0,0,13,4.74Z" />
                                        </g>
                                    </g>
                                </svg></a>
                            <ul class="sub-menu">
                                <li id="menu-item-12220"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-12220 npm-custom-type npm-custom-type-submenu_section nav-link">
                                    <a href='#'><span class='img-wrapper'><img
                                                src='{{asset('images/law1.png')}}'></span>
                                        <span>tư vấn </span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.48 6.43">
                                            <title>Chevron</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_2-2" data-name="Layer 2">
                                                    <path
                                                        d="M9,.44a1.49,1.49,0,0,0-2.12,0L4.74,2.62,2.56.44A1.5,1.5,0,0,0,.44,2.56L4,6.13a1,1,0,0,0,1.41,0L9,2.56A1.51,1.51,0,0,0,9,.44Z" />
                                                </g>
                                            </g>
                                        </svg></a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12249"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12249 npm-custom-type npm-custom-type-image">
                                            <img src='{{asset('images/law1.png')}}'>
                                        </li>
                                        <li id="menu-item-12224"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12224 npm-custom-type npm-custom-type-custom_text">
                                            <div class='h3 npm-menu-custom-text'>Dịch vụ doanh nghiệp</div>
                                        </li>
                                        <li id="menu-item-12242"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12242">
                                            <a href=""><span>Tư vấn thành lập doanh nghiệp</span></a>
                                        </li>
                                        <li id="menu-item-12241"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12241">
                                            <a href=""><span>Dịch vụ báo cáo tài chính</span></a>
                                        </li>
                                        <li id="menu-item-12240"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12240">
                                            <a href=""><span>dịch vụ kế toán</span></a>
                                        </li>
                                        <li id="menu-item-12379"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12379">
                                            <a href=""><span>Tư vấn sở hửu trí tuệ</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li id="menu-item-12221"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-12221 npm-custom-type npm-custom-type-submenu_section nav-link">
                                    <a href='#'><span class='img-wrapper'><img
                                                src='{{asset('images/law2.png')}}'></span>
                                        <span>Dịch dụ</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.48 6.43">
                                            <title>Chevron</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_2-2" data-name="Layer 2">
                                                    <path
                                                        d="M9,.44a1.49,1.49,0,0,0-2.12,0L4.74,2.62,2.56.44A1.5,1.5,0,0,0,.44,2.56L4,6.13a1,1,0,0,0,1.41,0L9,2.56A1.51,1.51,0,0,0,9,.44Z" />
                                                </g>
                                            </g>
                                        </svg></a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12248"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12248 npm-custom-type npm-custom-type-image">
                                            <img src='{{asset('images/law2.png')}}'>
                                        </li>
                                        <li id="menu-item-12225"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12225 npm-custom-type npm-custom-type-custom_text">
                                            <div class='h3 npm-menu-custom-text'>Tư vấn</div>
                                        </li>
                                        <li id="menu-item-12233"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12233">
                                            <a href=""><span>Tư vấn giải thể</span></a>
                                        </li>
                                        <li id="menu-item-12234"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12234">
                                            <a href=""><span>Tư vấn thuế </span></a>
                                        </li>
                                        <li id="menu-item-12235"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12235">
                                            <a href=""><span>Tư vấn kế toán</span></a>
                                        </li>
                                        <li id="menu-item-12228"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12228">
                                            <a href=""><span>Tư vấn doanh nghiệp</span></a>
                                        </li>

                                    </ul>
                                </li>
                                <li id="menu-item-12222"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-12222 npm-custom-type npm-custom-type-submenu_section nav-link">
                                    <a href="{{route('room.types')}}">
                                        <span class='img-wrapper'>
                                            <img src='{{asset('images/law3.png')}}'>
                                        </span>
                                        <span>Giới thiệu</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.48 6.43">
                                            <title>Giới thiệu</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_2-2" data-name="Layer 2">
                                                    <path
                                                        d="M9,.44a1.49,1.49,0,0,0-2.12,0L4.74,2.62,2.56.44A1.5,1.5,0,0,0,.44,2.56L4,6.13a1,1,0,0,0,1.41,0L9,2.56A1.51,1.51,0,0,0,9,.44Z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12247"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12247 npm-custom-type npm-custom-type-image">
                                            <img src='{{asset('images/law3.png')}}'>
                                        </li>
                                        <li id="menu-item-12226"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12226 npm-custom-type npm-custom-type-custom_text">
                                            <div class='h3 npm-menu-custom-text'>
                                                <a href="{{route('room.types')}}">
                                                    Giới thiệu
                                                </a>
                                            </div>
                                        </li>
                                        <li id="menu-item-12236"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12236">
                                            <a href=""><span>Về chúng tôi</span></a>
                                        </li>

                                    </ul>
                                </li>
                                <li id="menu-item-12223"
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-12223 npm-custom-type npm-custom-type-submenu_section nav-link">
                                    <a href='#'><span class='img-wrapper'><img
                                                src='{{asset('images/law4.png')}}'></span>
                                        <span>Liên hệ</span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.48 6.43">
                                            <title>Chevron</title>
                                            <g id="Layer_2" data-name="Layer 2">
                                                <g id="Layer_2-2" data-name="Layer 2">
                                                    <path
                                                        d="M9,.44a1.49,1.49,0,0,0-2.12,0L4.74,2.62,2.56.44A1.5,1.5,0,0,0,.44,2.56L4,6.13a1,1,0,0,0,1.41,0L9,2.56A1.51,1.51,0,0,0,9,.44Z" />
                                                </g>
                                            </g>
                                        </svg></a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-12246"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12246 npm-custom-type npm-custom-type-image">
                                            <img src='{{asset('images/law4.png')}}'>
                                        </li>
                                        <li id="menu-item-12227"
                                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-12227 npm-custom-type npm-custom-type-custom_text">
                                            <div class='h3 npm-menu-custom-text'>Liên hệ</div>
                                        </li>
                                        <li id="menu-item-12232"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12232">
                                            <a href=""><span>Trụ sở: Phòng 3236  Tòa Nhà VP6 Bán Đảo Linh Đàm, Hoàng Liệt, Hoàng Mai, Hà Nội</span></a>
                                        </li>
                                        <li id="menu-item-12373"
                                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-12373">
                                            <a href=""><span>Hotline: 033 444 5588</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li id="menu-item-10033"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10033 nav-link">
                            <a href="{{route('gioithieu')}}"><span>Giới thiệu</span><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.33 10.89">
                                    <title>Arrow</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="Layer_2-2" data-name="Layer 2">
                                            <path
                                                d="M13,4.74,8.76.44A1.5,1.5,0,0,0,6.64,2.56L8,4H1.5a1.5,1.5,0,0,0,0,3H8L6.64,8.33a1.5,1.5,0,1,0,2.12,2.12L13,6.15A1,1,0,0,0,13,4.74Z" />
                                        </g>
                                    </g>
                                </svg></a>
                        </li>
                        <li id="menu-item-10033"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10033 nav-link">
                            <a class="{{ menuActive('blog') }}" href="{{ route('blog') }}">@lang('Blog')</a>
                        </li>
                        <li id="menu-item-10033"
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10033 nav-link">
                            <a class="{{ menuActive('contact') }}" href="{{ route('contact') }}">@lang('CONTACT')</a>
                        </li>


                       <li id="menu-item-9791"
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-9791 nav-link">
                            <a target="_blank" rel="noopener" href="{{route('faq')}}">
                                <span>FAQ</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.33 10.89">
                                    <title>Arrow</title>
                                    <g id="Layer_2" data-name="Layer 2">
                                        <g id="Layer_2-2" data-name="Layer 2">
                                            <path
                                                d="M13,4.74,8.76.44A1.5,1.5,0,0,0,6.64,2.56L8,4H1.5a1.5,1.5,0,0,0,0,3H8L6.64,8.33a1.5,1.5,0,1,0,2.12,2.12L13,6.15A1,1,0,0,0,13,4.74Z" />
                                        </g>
                                    </g>
                                </svg></a>
                        </li>

                    </ul>
                </div>
            </nav><!-- #site-navigation -->
        </div>
    </div>
</header>
