<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // URLの変数部分をコントローラーで受け取る
    // コントローラーメソッドの引数として受け取る
    // この時の引数名はルーティングで定義した波括弧内の値と合致しなければならない
    // {id} と定義したので $id
    // 仮に {sample_value} なら $sample_value で受け取る必要がある
    // public function 関数名(){処理;} public~アクセス権
    // int 型の $id を受け取るのではなく、Folder クラスの $folder を受け取る記述に変更
    // URL中のIDに該当するフォルダデータがコントローラーメソッドに渡される
    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder)
    {
        /**
         * ログインユーザーのIDとフォルダのuser_idカラムの値を比較
         * 一致していなければログインユーザーはそのフォルダと紐付いていない、
         * つまり閲覧する権限が無いので abort(403) が実行
         */
        // if(Auth::user()->id !== $folder->user_id) {
        //     abort(403);
        // }

        // 全てのフォルダを取得する->ユーザーのフォルダを取得する
        // $folders = Folder::all();
        // Folder モデルの all クラスメソッド
        // すべてのフォルダデータをデータベースから取得
        // ->ログインユーザーが持つフォルダのみ取得する記述に変更
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダを取得する
        // findメソッド プライマリーキーのカラムを条件として一行分のデータを取得
        // (ex) Folder::find(1);
        // フォルダテーブルからIDカラム(プライマリーキー)が1である行のデータを検索して返す
        // $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // $tasks = Task::where('folder_id', $current_folder->id)->get();
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
        $tasks = $folder->tasks()->get(); // 省力形に変更

        // view関数でテンプレートに取得したデータを渡してデータを返却
        // 第一引数がテンプレートファイル名
        // 第二引数がテンプレートに渡すデータ
        // ここでは配列を渡している、キーがテンプレート側で参照する際の変数名
        return view('tasks/index', [

            // view関数の結果をコントローラーメソッドから返却すると、
            // テンプレートをレンダリングした結果のHTMLがフレームワークによってブラウザにレスポンスされる
            'folders' => $folders,

            // 受け取った値をテンプレートに渡す
            // 'current_..' という名前で参照するように記述
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);

        // 選ばれたフォルダを取得する
        /**
         * abort関数が呼び出されると引数のレスポンスコードで、コードに対応するエラーページが返却される
         * 言語的には例外が投げられるので、以降の処理は実行されない
         */
        // $current_folder = Folder::find($id);

        // if (is_null($current_folder)) {
        //     abort(404);
        // }
    }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    /* showCreateFormメソッド
     * テンプレートでform要素のaction属性としてタスク作成
     * URLを作るためにフォルダのIDがひつよ
     * コントローラーメソッドの引数で受け取り、view関数でテンプレートに渡す
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        // リレーションを活かしたデータの保存方法
        // $current_folder に紐づくタスクを作成
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'folder' => $folder->id, // 教材はid -> folderに変更
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminte\View\View
     */
    // 編集対象のタスクデータを取得してテンプレートに渡す
    /**
     * 編集画面で画面が表示された時にその時点でタスクの各項目の値が、
     * 入力欄に既に入っているべき
     * テンプレートでフォームを作成する時に各input要素のvalueに値を入れるために
     * タスクを渡している
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'folder' => $task,
        ]);
    }


    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // edit メソッド
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        // 1 リクエストされたIDでタスクデータを取得 これが編集対象となる
        // $task = Task::find($task_id);

        // 2 編集対象のタスクデータに入力値を詰めて save
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3 最後に編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            $folder->id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}
