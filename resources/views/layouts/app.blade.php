<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $setting->nama_website }}">
    <meta name="keywords" content="{{ $setting->nama_website }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $setting->nama_website }}</title>

    <!-- Favicon -->
    <link href="{{ url($setting->favicon) }}" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    @yield('css')

    @yield('script_css')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include('layouts.partials.header')

    @yield('hero_section')

    @yield('content')

    @include('layouts.partials.footer')

    @yield('js')

    @yield('script')

</body>

</html>