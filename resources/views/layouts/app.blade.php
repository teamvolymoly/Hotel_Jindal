<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hotel Jindal')</title>
    @yield('head')
</head>
<body class="@yield('body_class', 'bg-[#111] font-body text-white antialiased')">
    @yield('content')

    @yield('scripts')
</body>
</html>
