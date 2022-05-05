<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stack('description')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        jQuery(document).ready(function($) {
            $('.alert').each(function() {
                let _this = $(this);
                setTimeout(function() {
                    _this.fadeOut();
                }, 3000)
            })
        })
    </script>

</head>
<body>

@include('partials.navigation')

<div id="app">
    <main class="py-4">
        @if(session('message'))
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-{{ session('message')[0] }}">
                        <h4 class="alert-heading">{{ __("Mensaje informativo") }}</h4>
                        <p>{{ session('message')[1] }}</p>
                    </div>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Scripts -->

    @stack("scripts")

</div>
</body>
</html>
