<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="navbar">
            <input class="checkbox" type="checkbox" name="" id="" />
            <div class="span-container">
                <span class="line1"></span>
                <span class="line2"></span>
                <span class="line3"></span>
            </div>
            <div class="logo">Rese</div>
            <div class="nav-container">
                <li><a href="/">Home</a></li>
                @if (Auth::check())
                <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="header-nav__button">Logout</button>
                    </form>
                </li>
                <li><a href="/mypage">Mypage</a></li>
                @else
                <li><a href="/register">Registration</a></li>
                <li><a href="/login">Login</a></li>
                @endif
            </div>
        </div>
        <div class="search-bar">@yield('search-bar')</div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>