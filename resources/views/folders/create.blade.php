@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-offset-3 col-md-6">
      <nav class="panel panel-default">
        <div class="panel-heading">フォルダを追加する</div>
        <div class="panel-body">
          <!-- バリデーション ルール違反の確認-->
          @if($errors->any())
          <!-- $errors変数に詰めてテンプレートに渡す-->
          <!-- もしルール違反があったら...-->
          <div class="alert alert-danger">
              @foreach($errors->all() as $message)
              <!--エラーメッセージを列挙 -->
              <p>{{ $message }}</p>
              @endforeach
          </div>
          @endif
          <form action="{{ route('folders.create') }}" method="post">
            <!-- CSRFトークンを含んだinput要素を出力 -->
            @csrf
            <div class="form-group">
              <label for="title">フォルダ名</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              <!--old('title')の実行結果を展開 入力エラー時、入力値はセッションに一時的に保存Laravelが提供するold関数はそのセッション値を取得する 引数は取得したい入力欄のname属性-->
            </div>
            <div class="text-right">
              <button type="submit" class="btn btn-primary">送信</button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection