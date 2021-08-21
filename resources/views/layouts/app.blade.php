<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page_name }} - {{ $site_name }}</title>
        <meta name="description" content="{{ $site_description }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/app/public/images/logo/favicon/'.App\Models\Settings::find('favicon')->value) }}">

        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        
        <meta name="twitter:image:src" content="">
        <meta name="twitter:site" content="{{ $site_name }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $site_name }} - {{ $page_name }}">
        <meta name="twitter:description" content="{{ $site_description }}">
        <meta property="og:image" content="">
        <meta property="og:image:width" content="1280">
        <meta property="og:image:height" content="640">
        <meta property="og:site_name" content="{{ $site_name }}">
        <meta property="og:type" content="object">
        <meta property="og:title" content="{{ $site_name }} - {{ $page_name }}">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:description" content="{{ $site_description }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('resources/views/assets/css/tabler.min.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/views/assets/css/toastr.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/views/assets/css/extra.css') }}">
        
        <script type="text/javascript">"use strict";var APP_URL = {!! json_encode(url('/')) !!}</script>
        
    </head>
     
    <body class="font-sans antialiased">
        <div class="page">
            @include('layouts.navigation')
            <div class="content">
                <div class="container-xl">
                    @yield('content')
                </div>
            </div>
        </div>
        
        @include('layouts.footer')

        <!-- Scripts -->
        <script src="{{ asset('resources/views/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer></script>
        <script src="{{ asset('resources/views/assets/js/tabler.min.js') }}" defer></script>
        <script src="{{ asset('resources/views/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('resources/views/assets/js/masonry.pkgd.min.js') }}"></script>
        <script src="{{ asset('resources/views/assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('resources/views/assets/js/extra.js') }}"></script>
        @toastr_js
        @toastr_render
        @if(count($errors->write->all()) > 0)
        <script type="text/javascript">jQuery(document).ready(function(){jQuery("#modal--write--story").modal("show")});</script>
        @endif
        
    </body>
</html>