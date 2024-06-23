<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('tubitak.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>
</head>
<body>
<div class="container2">
    <div class="left-panel">
        <div class="logo" onclick="location.href='{{ url('/') }}'">
            <span class="letter">U</span>niversal<br>
            <span class="letter">T</span>est<br>
            <span class="letter">S</span>ystem
        </div>
        <div class="menu" style="text-align: center">
            @yield('menu')
        </div>
        <div class="footer">
            <a href="{{ url('/about') }}">Hakkımızda</a><br>
            <a href="{{ url('/contact') }}">İletişim ve destek</a>
        </div>
    </div>
    <div class="right-panel">
        @yield('right-panel')
    </div>
</div>
</body>
</html>
