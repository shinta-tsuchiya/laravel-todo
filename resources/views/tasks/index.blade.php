@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-4">
      <nav class="panel panel-default">
        <div class="panel-heading">フォルダ</div>
        <div class="panel-body">
          <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
            フォルダを追加する
          </a>
        </div>
        <div class="list-group">
          @foreach($folders as $folder)
          <!-- foreach でループした1つのアイテムである $folder -->
          <!-- フォルダテーブルの1行に相当する-->
          <a href="{{ route('tasks.index', ['id' => $folder->id]) }}"
            class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">
            <!-- 三項演算子 ループしているフォルダデータの内、 $current_folder_id つまり閲覧されている
                フォルダのIDとIDとが合致する場合のみ 'active' というHTMLクラスを出力 -->
            <!-- {}波括弧、変数の値の展開 -->
            <!-- Laravelが提供している route関数 ルーティングの設定からURLを作り出す その結果を hrefの値として展開-->
            <!-- routes/web.app参照 Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index'); -->
            <!-- route関数 第一引数 ルート名、第二引数の配列、ルートURL(Route::get(...))の内変数になっている部分(ここでは{id})に実際の値を埋める役割-->
            {{ $folder->title }}
            <!-- コントローラーから渡されたデータ $folders を参照している-->
            <!-- テンプレート側ではキー名が変数名になる -->
            <!-- カラム値は ->title、プロパティのように参照することができる -->
            <!-- $this->property 静的でないプロパティにアクセスする書き方 '->' オブジェクト演算子-->
          </a>
          @endforeach
        </div>
      </nav>
    </div>
    <div class="column col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading">タスク</div>
        <div class="panel-body">
          <div class="text-right">
            <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
              タスクを追加する
            </a>
          </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            @foreach($tasks as $task)
            <tr>
              <td>{{ $task->title }}</td>
              <td>
                <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
              </td>
              <td>{{ $task->formatted_due_date }}</td>
              <td><a href="#">編集</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection