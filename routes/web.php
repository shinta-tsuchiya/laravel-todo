<?php

Route::get('/folders/{id}/tasks', 'TaskController@index') -> name('tasks.index');

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

Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
Route::post('/folders/create', 'FolderController@create');

/**
 * RouteクラスにはHTTPメソッドに応じたクラスメソッドが用意されている
 * 
 * nameメソッドによるルートの命名はgetだけに定義をしているのは、
 * 名前を付けた後に呼び出せるのはURKだけ
 * 同一URKでHTTPのメソッド違いのルートがいくつか有る場合は
 * どれか1つに名前をつければOK
 */

Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/folders/{id}/tasks/create', 'TaskController@create');

Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');

Route::get('/', 'HomeController@index')->name('home');

// このメソッド 会員登録、ログイン、ログアウト、パスワード再設定の各機能で必要なルーティング設定を全て定義する
Auth::routes();