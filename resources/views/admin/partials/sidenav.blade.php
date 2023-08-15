<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn"><i class="las la-times"></i></button>
    <div class="sidebar__inner">
        <div class="sidebar__logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__main-logo"><img src="{{asset('images/logo.png')}}" alt="@lang('image')"></a>
        </div>
        <div class="sidebar__menu-wrapper" id="sidebar__menuWrapper">
            <ul class="sidebar__menu">
                @can(['admin.hotel.*'])
                    <li class="sidebar-menu-item sidebar-dropdown">
                        <a class="{{ menuActive('admin.hotel*', 3) }}" href="javascript:void(0)">
                            <i class="menu-icon las la-city"></i>
                            <span class="menu-title">@lang('Video')</span>
                        </a>
                        <div class="sidebar-submenu {{ menuActive('admin.hotel*', 2) }}">
                            <ul>
                                @can('admin.hotel.room.type.all')
                                    <li class="sidebar-menu-item {{ menuActive('admin.hotel.room.type.*') }}">
                                        <a class="nav-link" href="{{ route('admin.hotel.room.type.all') }}">
                                            <i class="menu-icon las la-dot-circle"></i>
                                            <span class="menu-title">@lang('Video')</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan
                    @can('admin.frontend.manage.pages')
                        <li class="sidebar-menu-item {{ menuActive('admin.frontend.manage.pages') }}">
                            <a class="nav-link" href="{{ route('admin.frontend.manage.pages') }}">
                                <i class="menu-icon la la-list"></i>
                                <span class="menu-title">@lang('Manage Pages')</span>
                            </a>
                        </li>
                    @endcan
                @can(['admin.staff.*', 'admin.roles.*', 'admin.users.*', 'admin.subscriber.index'])
                        @can('admin.subscriber.index')
                            <li class="sidebar-menu-item {{ menuActive('admin.subscriber.index') }}">
                                <a class="nav-link" data-default-url="{{ route('admin.subscriber.index') }}" href="{{ route('admin.subscriber.index') }}">
                                    <i class="menu-icon las la-thumbs-up"></i>
                                    <span class="menu-title">@lang('Subscribers') </span>
                                </a>
                            </li>
                        @endcan
                    @endcan

                    @can('admin.extensions.index')
                        <li class="sidebar-menu-item {{ menuActive('admin.extensions.index') }}">
                            <a class="nav-link" href="{{ route('admin.extensions.index') }}">
                                <i class="menu-icon las la-cogs"></i>
                                <span class="menu-title">@lang('Extensions')</span>
                            </a>
                        </li>
                    @endcan
                    @can('admin.setting.logo.icon')
                        <li class="sidebar-menu-item {{ menuActive('admin.setting.logo.icon') }}">
                            <a class="nav-link" href="{{ route('admin.setting.logo.icon') }}">
                                <i class="menu-icon las la-images"></i>
                                <span class="menu-title">@lang('Logo & Favicon')</span>
                            </a>
                        </li>
                    @endcan



                @can(['admin.ticket.*', 'admin.report*'])
                    <li class="sidebar__menu-header">@lang('Support & Report')</li>
                    @can(['admin.ticket.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.ticket*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon la la-ticket"></i>
                                <span class="menu-title">@lang('Hỗ trợ khách') </span>
                                @if (0 < $pendingTicketCount)
                                    <span class="menu-badge pill bg--danger ms-auto">
                                        <i class="fa fa-exclamation"></i>
                                    </span>
                                @endif
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.ticket*', 2) }} ">
                                <ul>
                                    @can('admin.ticket.pending')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.pending') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.pending') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Yêu cầu hỗ trợ')</span>
                                                @if ($pendingTicketCount)
                                                    <span class="menu-badge pill bg--danger ms-auto">{{ $pendingTicketCount }}</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.closed')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.closed') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.closed') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Đã hỗ trợ')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.answered')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.answered') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.answered') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Trả lời hỗ trợ')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.ticket.index')
                                        <li class="sidebar-menu-item {{ menuActive('admin.ticket.index') }} ">
                                            <a class="nav-link" href="{{ route('admin.ticket.index') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('danh sách hỗ trợ')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                @endcan

                @can(['admin.setting.index', 'admin.setting.system.configuration', 'admin.setting.logo.icon', 'admin.setting.notification.*', 'admin.gateway.*', 'admin.extensions.index', 'admin.language.manage', 'admin.seo'])
                    <li class="sidebar__menu-header">@lang('Cài đặt')</li>


                    @can(['admin.setting.notification.*'])
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.setting.notification*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon las la-bell"></i>
                                <span class="menu-title">@lang('Notification Setting')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.setting.notification*', 2) }}">
                                <ul>
                                    @can('admin.setting.notification.global')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.global') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.global') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Global Template')</span>
                                            </a>
                                        </li>
                                    @endcan

                                    @can('admin.setting.notification.email')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.email') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.email') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Email Setting')</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('admin.setting.notification.templates')
                                        <li class="sidebar-menu-item {{ menuActive('admin.setting.notification.templates') }}">
                                            <a class="nav-link" href="{{ route('admin.setting.notification.templates') }}">
                                                <i class="menu-icon las la-dot-circle"></i>
                                                <span class="menu-title">@lang('Notification Templates')</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                @endcan

                @can(['admin.frontend*'])
                    <li class="sidebar__menu-header">@lang('Frontend Manager')</li>

                    @can('admin.frontend.sections')
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a class="{{ menuActive('admin.frontend.sections*', 3) }}" href="javascript:void(0)">
                                <i class="menu-icon la la-puzzle-piece"></i>
                                <span class="menu-title">@lang('Manage Section')</span>
                            </a>
                            <div class="sidebar-submenu {{ menuActive('admin.frontend.sections*', 2) }}">
                                <ul>
                                    @php
                                        $lastSegment = collect(request()->segments())->last();
                                    @endphp
                                    @foreach (getPageSections(true) as $sec => $sections)
                                            <li class="sidebar-menu-item @if ($lastSegment == $sec) active @endif">
                                                <a class="nav-link" href="{{ route('admin.frontend.sections', $sec) }}">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title">{{ __($sections['name']) }}</span>
                                                </a>
                                            </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endcan

                @endcan

            </ul>

        </div>
    </div>
</div>
<!-- sidebar end -->

@push('style')
    <style>
        .transform-rotate-180 {
            transform: rotate(180deg)
        }
    </style>
@endpush

@push('script')
    <script>
        if ($('li').hasClass('active')) {
            $('#sidebar__menuWrapper').animate({
                scrollTop: eval($(".active").offset().top - 320)
            }, 500);
        }
    </script>
@endpush
