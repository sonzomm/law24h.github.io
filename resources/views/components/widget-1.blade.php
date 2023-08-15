@props([
    'link' => '',
    'title' => '',
    'value' => '',
    'icon' => '',
    'bg' => 'white',
    'color' => 'primary',
    'icon_style' => 'outline',
    'overlay_icon' => 1,
])

<div class="widget-two box--shadow2 b-radius--5 bg--{{ $bg }}">
    <div class="widget-two__content">
        <h3>{{ $value }}</h3>
        <p>{{ __($title) }}</p>
    </div>

    @if ($link)
        <a href="{{ $link }}" class="widget-two__btn btn btn-outline--{{ $color }}">@lang('View All')</a>
    @endif
</div>
