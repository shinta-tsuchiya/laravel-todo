<!DOCTYPE html>
<html lang="ja">

<!-- layout 枠組み ページごとに変わらない部分だけを記述 -->
{{-- ページごとに変化する部分は @yield で穴埋めする --}}

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">ToDo App</a>
      <div class="my-navbar-control">
        {{-- ログイン状態の取得
          Auth クラスの check メソッドでログインしているかどうかを確認できる
          アクセスしたユーザーがログインしていれば Auth::check() は true を返し、
          ログインしていなければ false を返す
          テンプレートではこの Auth::check() を利用してログインしていた場合の要素と
          ログインしていない場合の要素を出し分けている --}}
        @if(Auth::check())
        {{-- ログインしていた場合 --}}
        <span class="my-navbar-item">ようこそ， {{ Auth::user()->name }}さん</span>
        ｜
        <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        @else
        {{-- ログインしていない場合 --}}
        <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
        ｜
        <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
        @endif
      </div>
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  {{-- ログアウト機能として必要なのは route('logout') のURLにPOSTリクエストを送信することだけ
  今回はたまたまリンクの見た目(<a>要素)でフォームを送信したかったので JavaScripsを使用している
    ログアウトリンクのクリックイベントで、リンクの下に置いたフォームを送信している
    POSTリクエストに必要なデータはCSRFトークンのみ --}}
  @if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
  @endif
  @yield('scripts')
</body>

</html>