
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="header">
    <!-- ロゴ -->
    <a href="{{ route('top') }}" class="header-logo">
        <img src="{{ asset('images/atlas.png') }}" alt="ロゴ">
    </a>

    @if (Route::currentRouteName() !== 'login')
        <div class="header-user">

            <!-- ユーザーアイコン -->
            <div class="header-user-icon">
                <img src="{{ asset('images/icon.png') }}" alt="ユーザーアイコン">
            </div>

            <!-- アコーディオンメニュー -->
            <div class="menu">
                <input type="checkbox" id="menu_bar01">
                <label for="menu_bar01" tabindex="0"></label>

                <ul id="links01">
                    <li><a href="{{ route('top') }}">HOME</a></li>
                    <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
                    <li><a href="#" id="logout-link" class="menu-logout">ログアウト</a></li>
                </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <!-- ユーザー名 -->
            <span class="header-user-name">
                {{ Auth::user()->name ?? '' }}
            </span>

        </div>
    @endif
</header>

<script src="{{ asset('js/header.js') }}"></script>
</body>
</html>
