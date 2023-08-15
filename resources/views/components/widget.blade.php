@props([
    'style' => 1,
    'link' => null,
    'title' => null,
    'value' => null,
    'icon' => null,
    'bg' => null,
    'color' => null,
    'icon_color' => null,
    'icon_style' => 'outline',
    'overlay_icon' => 1,
    'query_string' => null,
    'parameters' => null,
])

@php
    $iconColor = $icon_color ?? $color;
    $widget = 'x-widget-' . $style;

    if (can($link)) {
        $link = route($link, $parameters);
        $link = $query_string ? $link . '?' . $query_string : $link;
    } else {
        $link = null;
    }

@endphp


@if ($style == 1)
    <x-widget-1 :bg=$bg :color=$color :icon=$icon :icon_color=$icon_color :icon_style=$icon_style :link=$link :overlay_icon=$overlay_icon :title=$title :value=$value />
@endif

