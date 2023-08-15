@extends($activeTemplate.'layouts.app')

@section('layout')
    @include($activeTemplate . 'partials.header')
    <main class="main-wrapper">
        @yield('content')
    </main>
    @include($activeTemplate . 'partials.footer')
@endsection
