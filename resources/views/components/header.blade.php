<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/header.js') }}"></script>
</head>
<body>

<header class="header">
    <a href="{{ route('top') }}" class="header-logo">
        <img src="{{ asset('images/atlas.png') }}" alt="ロゴ">
    </a>

    @if (Route::currentRouteName() !== 'login')
        <div class="header-user">
            <span class="header-user-name">
                {{ Auth::user()->username ?? '' }}
            </span>

            <div class="menu">
                <input type="checkbox" id="menu_bar01">
                <label for="menu_bar01" tabindex="0"></label>

                <ul id="links01">
                    <li><a href="{{ route('top') }}">HOME</a></li>
                    <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
                    <li>
                        <a href="#" id="logout-link" class="menu-logout">ログアウト</a>
                    </li>
                </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <div class="header-user-icon">
                <img src="{{ asset('images/icon1.png') }}" alt="ユーザーアイコン">
            </div>
        </div>
    @endif
</header>
