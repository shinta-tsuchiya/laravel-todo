@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col col-md-offset-3 col-md-6">
      <nav class="panel panel-default">
        <div class="panel-heading">タスクを編集する</div>
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
            @endforeach
          </div>
          @endif
          <form action="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="title">タイトル</label>
              <input type="text" class="form-control" name="title" id="title"
                value="{{ old('title', $task->title) }}" />
                <!-- 本文は '??' だが、解説は',' ? -> githubに合わせて',' -->
                <!-- 入力値の value に old('title', $task->title) を指定 -->
                <!-- old関数は直前の入力値を取得 第二引数を指定するとそれがデフォルト値になる -->
                <!-- 直前の入力値が無い場合、 $task->title が出力 ページを最初に表示した時-->
                <!-- これで編集ページを開いた時はタスクを作成したときのタイトルが入力欄に入っている-->
                <!-- 値を変更して送信したが入力エラーになって戻った時は変更後の値が入っている挙動を実現 -->
            </div>
            
            <div class="form-group">
              <label for="status">状態</label>
              <select name="status" id="status" class="form-control">
                @foreach(\App\Task::STATUS as $key => $val)
                <option value="{{ $key }}" 
                {{-- 選択状態を実現 --}}
                {{-- セレクトボックスは、selected属性に置かれた optin要素が初期表示で選択状態になる --}}
                {{-- そこでループしたキーと old('status, $task->status') (直前の入力値またはデータベースに登録済みの値)を比べ、--}}
                {{-- 一致する場合にoption タグの中に 'selected' を出力 --}}
                {{ $key == old('status', $task->status) ? 'selected' : '' }}>
                  {{ $val['label'] }}
                </option>
                @endforeach
              </select>
              <!-- 状態の入力欄の挙動はタイトルと同じ-->
              {{-- Taskモデルで定義した配列定数 STATUS を @foreach でループしてoption 要素を出力 --}}
              {{-- option要素のvalueに配列キー (1,2,3) をタグで囲んだ表示文字列には Task.phpの'label' の値を出力 --}}

            </div>
            <div class="form-group">
              <label for="due_date">期限</label>
              <input type="text" class="form-control" name="due_date" id="due_date"
                value="{{ old('due_date', $task->formatted_due_date) }}" />
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

@section('scripts')
  @include('share.flatpickr.scripts')
@endsection