<?php

namespace App\Http\Controllers;

// クラスのインポート
// Folderクラスを使えるようにする記述
use App\Folder; 
use Illuminate\Http\Request;
// CreateFolderクラスのインポート
use App\Http\Requests\CreateFolder; // titleのバリデーションの設定
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
/**
 * extends 継承
 * class (子)クラス名 extends (親)クラス名
 * FolderControllerクラスはControllerクラスを継承した
 * 継承すると親のメンバを全て引き継ぐ
 */

{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    // 引数にインポートしたRequestクラスを受け入れる
    public function create(CreateFolder $request)

    /** コントローラーメソッドが呼び出される時にLaravaelが
     * リクエストの情報を Request クラスのインスタンス $requestに詰めて
     * 引数として渡す Requestクラスのインスタンスにはリクエストヘッダや
     * 送信元IPなど色々な情報が含まれている フォームの入力値も入っている
     */

    /** Request -> CreateFolderに変更
     * FormRequestクラスは、Requestクラスと互換性あり
     * ここに独自のFormRequestクラスを指定することで、
     * 入力値の取得などのRequestクラスの機能はそのままに、
     * バリデーションチェックを追加することができる
     * FormRequestクラスは基本的に1つのリクエストに対して1つ作成する
     */

    {
        // モデルの永続化 データベースに書き込む処理
        
        // 1.フォルダモデルのインスタンスを作成する
        $folder = new Folder();

        // 2.タイトルに入力値を代入する
        $folder->title = $request->title;
        //                リクエスト中の入力値はプロパティとして取得

        // 3.インスタンスの状態をデータベースに書き込む
        // saveメソッドを呼び出す
        //これにより、モデルクラスが表すテーブルに対してINSERTが実行される
        // $folder->save();

        // ユーザーに紐付けて保存
        // Auth::user() でユーザーモデルが取得できるので、前章で定義したリレーションを利用して
        // フォルダモデルを保存している
        // タスク作成を実装した以下のコードと同じパターン
        // $current_folde->tasks()->save($task);
        Auth::user()->folders()->save($folder);

        

        // リダイレクト先の指定、redirectメソッドに続いてrouteメソッドを呼び出し
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

}




