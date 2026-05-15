<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header-logo">
            <a href="/">
                <img class="header-logo__img" src="/img/COACHTECHヘッダーロゴ.png" alt="ヘッダーロゴ">
            </a>
        </div>
        <div class="header-search">
            @if($nav ?? true)
            <form action="/" method="get">
                <input class="header-search__input"type="text" name="keyword" placeholder="何をお探しですか？" value="{{request('keyword')}}">
            </form>
            @endif
        </div>
        <div class="header-nav">
            @if($nav ?? true)
            <nav>
                <ul class="header-nav__item">
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @if(auth()->user())
                                <button class="logout-button">ログアウト</button>
                            @else
                                <a href="{{route('login')}}" class="logout-button">ログイン</a>
                            @endif
                        </form>
                    </li>
                    <li><a class="mypage"href="/myList">マイページ</a></li>
                    <li><a class="sell" href="/product/sell">出品</a></li>
                </ul>
            </nav>
            @endif
        </div>
    </header>
    <main>
        @yield('main')
    </main>
</body>
</html>