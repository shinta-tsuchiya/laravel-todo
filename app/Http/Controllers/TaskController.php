<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id)
    // URLの変数部分をコントローラーで受け取る
    // コントローラーメソッドの引数として受け取る
    // この時の引数名はルーティングで定義した波括弧内の値と合致しなければならない
    // {id} と定義したので $id
    // 仮に {sample_value} なら $sample_value で受け取る必要がある
    {
        $folders = Folder::all();
        // Folder モデルの all クラスメソッド
        // すべてのフォルダデータをデータベースから取得

        return view('tasks/index', [
            // view関数でテンプレートに取得したデータを渡してデータを返却
            // 第一引数がテンプレートファイル名
            // 第二引数がテンプレートに渡すデータ
            // ここでは配列を渡している、キーがテンプレート側で参照する際の変数名
            'folders' => $folders,
            // view関数の結果をコントローラーメソッドから返却すると、
            // テンプレートをレンダリングした結果のHTMLがフレームワークによってブラウザにレスポンスされる
            'current_folder_id' => $id,
            // 受け取った値をテンプレートに渡す
            // 'current_..' という名前で参照するように記述
        ]);
    }
}
