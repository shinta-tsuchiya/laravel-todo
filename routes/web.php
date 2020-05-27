<?php

Route::get('/folders/{id}/tasks', 'TaskController@index') -> name('tasks.index');
/* Routeクラスがルーティングの設定
 コードの意味は左から呼んだまま
 getで /folders/{id}/tasks にリクエストが来たら TaskController コントローラーの
 index メソッドを呼びだす
 最後にこのルートに名前を付けている name('tasks.index')
 アプリケーションの中でURLを参照する際にはこの名前を使う
 
 idの値は変動するので波括弧の箇所で表現する
 波括弧の間の名前、今回はid、はどんな値でもOK
 */