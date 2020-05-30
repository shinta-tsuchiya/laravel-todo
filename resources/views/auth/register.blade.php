@extends('layout')

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-offset-3 col-md-6">
      <nav class="panel panel-default">
        <div class="panel-heading">会員登録</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          {{-- 認証機能のルート名 
            route という名前を指定 このルート名は Auth::route() で定義されている
            これはルーティングの定義を一覧表示する route:list で確認出来る --}}
          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
            </div>
            <div class="form-group">
              <label for="name">ユーザー名</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
            </div>
            <div class="form-group">
              <label for="password">パスワード</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
              {{-- パスワードの一致確認
                Laravelにはconfirmedルールというバリデーションルールが実装されている
                このルールは項目(仮にabc)と、その項目名 + _confirmation という名前の項目(abc_confirmation)の
                入力値が一致することを検証 
                確認用のパスワード欄が password_confirmation という名前であるのはこの為 --}}
              <label for="password-confirm">パスワード(確認)</label>
              <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
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