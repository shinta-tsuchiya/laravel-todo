<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('folder_id')->unsigned();
            $table->string('title', 100);
            $table->date('due_date');
            $table->integer('status')->default(1);
            // 状態カラムにデフォルト値を設定
            // todoタスク作成時は未着手状態ということで1
            $table->timestamps();

            // 外部キーを設定する FOREIGN KEY
            $table->foreign('folder_id')->references('id')->on('folders');
            // テーブル 外部キーをfolder_idテーブルに設定、idを参照、foldersテーブルから
            /*
            他のテーブルとの結びつきを表現する為のカラムに設定する
            外部キー制約が設定されたカラムには好き勝手な値が入れられなくなる
            今回はタスクテーブルのフォルダID列には実際に存在するフォルダIDの値しか入れられない
            これでデータの不整合を防ぐ
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
