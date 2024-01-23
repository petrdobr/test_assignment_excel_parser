<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('Excel Upload'))</title>
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}">
</head>
<body>
    <nav>
        <div class="container">
            <a href="{{ url('/') }}">{{ __('Main') }}</a>
            <a href="{{ url('/upload') }}">{{ __('Import') }}</a>
            <a href="{{ url('/products') }}">{{ __('Products') }}</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
