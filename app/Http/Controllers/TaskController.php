<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
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
        // 全てのフォルダを取得する
        $folders = Folder::all();
        // Folder モデルの all クラスメソッド
        // すべてのフォルダデータをデータベースから取得

        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);
        // findメソッド プライマリーキーのカラムを条件として一行分のデータを取得
        // (ex) Folder::find(1);
        // フォルダテーブルからIDカラム(プライマリーキー)が1である行のデータを検索して返す

        // 選ばれたフォルダに紐づくタスクを取得する
        // $tasks = Task::where('folder_id', $current_folder->id)->get();
        $tasks = $current_folder->tasks()->get(); // 省力形に変更
        /**
         * whereメソッド クエリビルダの機能 クエリ = SQLクエリ ビルダ = 構築者
         * クエリビルダの機能によってSQLを書かなくてもPHP風な記述でデータ操作を表現
         * 
         * whereメソッドはデータの取得条件を表す SQLのWHERE句にあたる
         * 第一引数がカラム名、第二引数が比較する値
         * 上記は以下の省略形
         * Tasks::where('folder_id', '=', $current_folder->id)->get();
         * 
         * 最後のgetメソッドで、構築されたSQLをデータベースに発行して結果を取得
         */

        return view('tasks/index', [
            // view関数でテンプレートに取得したデータを渡してデータを返却
            // 第一引数がテンプレートファイル名
            // 第二引数がテンプレートに渡すデータ
            // ここでは配列を渡している、キーがテンプレート側で参照する際の変数名
            
            'folders' => $folders,
            // view関数の結果をコントローラーメソッドから返却すると、
            // テンプレートをレンダリングした結果のHTMLがフレームワークによってブラウザにレスポンスされる
            
            'current_folder_id' => $current_folder->id,
            // 受け取った値をテンプレートに渡す
            // 'current_..' という名前で参照するように記述

            'tasks' => $tasks,
        ]);
    }
}
