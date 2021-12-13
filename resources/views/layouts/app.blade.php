<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Task Management System</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layouts/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/fontawesome.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/layouts/header.js') }}"></script>
</head>

<body>
    <div id="app">
        <my-header></my-header>
        <layout></layout>
        <my-footer></my-footer>
        {{-- @include('layouts.partials.header') --}}
        {{-- <main class="py-4">
            @yield('content')

    
            @yield('scripts')
        </main> --}}
        {{-- @include('layouts.partials.footer') --}}
    </div>
    <script src="{{ mix('js/app.js')}}"></script>
</body>

</html>
