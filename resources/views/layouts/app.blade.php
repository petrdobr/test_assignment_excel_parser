<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Excel Upload')</title>
    <link rel="stylesheet" href="{{ asset('styles/app.css') }}">
</head>
<body>
    <nav>
        <div class="container">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/upload') }}">Upload</a>
            <a href="{{ url('/products') }}">Products</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
