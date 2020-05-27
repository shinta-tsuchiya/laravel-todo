<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>

<body>
  <header>
    <nav class="my-navbar">
      <a class="my-navbar-brand" href="/">ToDo App</a>
    </nav>
  </header>
  <main>
    <div class="container">
      <div class="row">
        <div class="col col-md-4">
          <nav class="panel panel-default">
            <div class="panel-heading">フォルダ</div>
            <div class="panel-body">
              <a href="#" class="btn btn-default btn-block">
                フォルダを追加する
              </a>
            </div>
            <div class="list-group">
              @foreach($folders as $folder) <!-- foreach でループした1つのアイテムである $folder -->
              <!-- フォルダテーブルの1行に相当する-->
              <a 
                href="{{ route('tasks.index', ['id' => $folder->id]) }}"
                class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}"
              > <!-- 三項演算子 ループしているフォルダデータの内、 $current_folder_id つまり閲覧されている
                      フォルダのIDとIDとが合致する場合のみ 'active' というHTMLクラスを出力 -->
                <!-- {}波括弧、変数の値の展開 -->
                <!-- Laravelが提供している route関数 ルーティングの設定からURLを作り出す その結果を hrefの値として展開-->
                <!-- routes/web.app参照 Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index'); -->
                <!-- route関数 第一引数 ルート名、第二引数の配列、ルートURL(Route::get(...))の内変数になっている部分(ここでは{id})に実際の値を埋める役割-->
                {{ $folder->title }} <!-- コントローラーから渡されたデータ $folders を参照している-->
                <!-- テンプレート側ではキー名が変数名になる -->
                <!-- カラム値は ->title、プロパティのように参照することができる -->
                <!-- $this->property 静的でないプロパティにアクセスする書き方 '->' オブジェクト演算子-->
              </a>
              @endforeach
            </div>
          </nav>
        </div>
        <div class="column col-md-8">
          <!-- ここにタスクが表示される -->
        </div>
      </div>
    </div>
  </main>
</body>

</html>