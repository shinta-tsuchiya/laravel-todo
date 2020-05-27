<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 3) as $num) {
            // 反復処理
            // foreach(配列変数 as キー変数){処理}
            // range関数 ある範囲の整数を有する配列を作成する
            // 配列変数に含まれる要素の値を、キー変数に代入する
            DB::table('tasks')->insert([
                'folder_id' => 1,
                'title' => "サンプルタスク {$num}",
                'status' => $num,
                'due_date' => Carbon::now()->addDay($num),
                // CarbonライブラリのaddDayメソッド
                // 現在時間から1~3日加算した日付を指定
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            // id =1 のフォルダに対して3つのフォルダを登録
        }
    }
}
