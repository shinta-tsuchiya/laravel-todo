<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // runメソッドの中にデータを挿入するコードを記述
        // プライベート仕事旅行、3つのフォルダを作成

        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
            DB::table('folders')->insert([
                'title' => $title,
                'created_at' => Carbon::now(),
                // Carbonライブラリ 現在日時を入れる
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}