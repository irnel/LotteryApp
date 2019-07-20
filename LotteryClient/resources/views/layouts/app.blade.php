<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lottery App') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>
<body class="bg">
    <div id="app">
        @include('partials/navbar')

        <main class="body-top">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- App Scripts -->
    @yield('scripts')

</body>
</html>
