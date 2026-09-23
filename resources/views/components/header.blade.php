
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- ここでCSSを読み込む -->
</head>

<body>

    <header>
  <a href="{{ route('top') }}">
    <img src="{{ asset('images/atlas.png') }}" alt="ロゴ">
</a>
</header>

@if (Route::currentRouteName() !== 'login')
<div class="menu">
  <!-- ドロップダウン付きメニュー -->
  <input type="checkbox" id="menu_bar01" />
  <label for="menu_bar01" tabindex="0"></label>
  <ul id="links01">
    <li><a href="{{ route('top') }}">HOME</a></li>
    <li><a href="{{ route('profile') }}">プロフィール編集</a></li>
    <li><a href="#" id="logout-link" class="menu-logout">ログアウト</a></li>
  </ul>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf</form>
</div>
@endif
<script src="{{ asset('js/header.js') }}"></script>
</body>
</html>
