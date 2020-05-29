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
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  @yield('scripts')
</body>

</html>