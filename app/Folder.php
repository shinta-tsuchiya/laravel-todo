<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
}

/*
 継承元のModelクラスで様々な設定を読み取る
 モデルクラスがどのテーブルに対応しているかはクラス名から自動的に推定される
 つまり、モデルクラスのクラス名の複数形のテーブルが対応していると解釈される
 今回の場合は folder テーブル
 このデフォルトの推定に当てはまらない場合には追加で設定を書く
*/