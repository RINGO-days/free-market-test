<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="css/sanitize.css">
    <link rel="stylesheet" href="css/common.css">
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
            <input class="header-search__input"type="text" placeholder="何をお探しですか？">
        </div>
        <div class="header-nav">
            <nav>
                <ul class="header-nav__item">
                    <li>
                        <form action="" method="post">
                            @csrf
                            <button class="logout-button">ログアウト</button>
                        </form>
                    </li>
                    <li><a class="mypage"href="">マイページ</a></li>
                    <li><a class="sell" href="">出品</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        @yield('main')
    </main>
</body>
</html>