<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Шар предсказаний</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/assets/app.css") }}">
    <script src="{{ asset("/assets/app.js") }}"></script>

</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="{{ asset("/assets/jquery.js") }}"></script>
</body>
</html>
