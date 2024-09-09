<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>勤怠管理アプリAtte</title>
    <link rel="icon" href="/src/public/img/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="{{ route('login') }}">
                Atte
            </a>
            @yield('nav')
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <small class="copyright">&copy; Atte,inc</small>
    </footer>
</body>

</html>

