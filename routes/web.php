<?php

Route::group(['middleware' => 'auth'], function() {
  Route::get('/', 'HomeController@index')->name('home');
/**
* RouteクラスにはHTTPメソッドに応じたクラスメソッドが用意されている
* 
* nameメソッドによるルートの命名はgetだけに定義をしているのは、
* 名前を付けた後に呼び出せるのはURKだけ
* 同一URLでHTTPのメソッド違いのルートがいくつか有る場合は
* どれか1つに名前をつければOK
*/
  Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
  Route::post('/folders/create', 'FolderController@create');

/**
 * ルートをルートグループにまとめる
 * ルートグループはいくつかのルートに対して一括で機能を追加したい場合に使用する
 * 今回は認証ミドルウェアを複数のルートに一括して適用する為に使用
 * 
 * ミドルウェアは 'auth' という名前で指定されているが、
 * app/Http/Kernel.php というファイルに実際のクラスと名前の定義がある
 */
/** ポリシークラス
 * can という名前のミドルウェア、引数(コロン以降の部分)から適切な認可処理を判定して
 * コントローラーメソッド実行前に適用する
 * 認可処理が true を返せばそのまま後続の処理に移り、
 * false を返せば処理を中断してコード403をレスポンスする
 * can ミドルウェアの引数(view,folder)はカンマ区切りになっていて、
 * カンマの左側が認可処理の種類、右側がポリシーに渡すルートパラメーター(URLの変数部分)を示す
 * 
 * ルートモデルバインディングによってルートパラメーターから対応するモデルクラスが作り出される
 * モデルクラスが分かると AuthServiceProvider に登録した内容から適用すべきポリシークラスを特定できる
 * さらに認可処理の種類はポリシークラスのメソッド名とみなされる
 * 
 * 今回は view,folder という引数から、 Folderモデル -> FolderPolicyポリシーの viewメソッドが認可に使用される
 * view メソッドで定義された認可処理は「ユーザーとフォルダが紐付いているときのみ許可する」という内容
 * 
 * 結果としてタスク一覧にアクセスしたとき、ユーザーに対して、ルートモデルバインディングで取得できた
 * モデルインスタンスへの上記の認可処理を実行する
 */
  Route::group(['middleware' => 'can:view,folder'], function() {

    Route::get('/folders/{folder}/tasks', 'TaskController@index')->name('tasks.index');
  /* Routeクラスがルーティングの設定
  コードの意味は左から呼んだまま
  getで /folders/{id}/tasks にリクエストが来たら TaskController コントローラーの
  index メソッドを呼びだす
  最後にこのルートに名前を付けている name('tasks.index')
  nameメソッドの引数がそのルートの名前

  アプリケーションの中でURLを参照する際にはこの名前を使う

  idの値は変動するので波括弧の箇所で表現する
  波括弧の間の名前、今回はid、はどんな値でもOK
  */
    Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

    Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', 'TaskController@edit');

  });
});

// このメソッド 会員登録、ログイン、ログアウト、パスワード再設定の各機能で必要なルーティング設定を全て定義する
Auth::routes();