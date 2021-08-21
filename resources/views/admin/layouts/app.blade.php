<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_name }} - {{ $site_name }}</title>
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/app/public/images/logo/favicon/'.App\Models\Settings::find('favicon')->value) }}">

        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('resources/views/assets/css/tabler.min.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/views/assets/css/toastr.css') }}">
        
        <script type="text/javascript">
            var APP_URL = {!! json_encode(url('/')) !!}
        </script>
        
    </head>
    <body class="font-sans antialiased">
        <div class="page">
            @include('admin.layouts.navigation')
            <div class="content">
                <div class="container-xl">

                    @yield('content')
                    @include('admin.layouts.footer')
                </div>
            </div>
        </div>
        
        <!-- Scripts -->
        <script src="{{ asset('resources/views/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('resources/views/assets/js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('resources/views/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('resources/views/assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('resources/views/assets/js/extra.js') }}"></script>
        @toastr_js
        @toastr_render
    </body>
</html>