<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // user_id カラムを追加して外部キーを設定する処理を記述
    public function up()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();

            // 外部キーを設定する
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    
    // user_id カラムを削除する処理を記述
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}

/**
 * この状態で php artisan migrate するとエラー
 * SQLSTATE[23502]: Not null violation: 7 ERROR: column "user_id" contains null values (SQL: alter table "folders" add column "user_id" integer not null)
 * 
 * user_idカラムは NOT NULL なのに NULL値が入れられようとした、という内容
 * 
 * カラムを追加するだけデータを入れていないのに何故エラーを吐くのか
 * 
 * folder テーブルには既にデータが入っている
 * カラムを追加するということは、既存のデータ行にも user_id が増えるが、
 * このときデータベースは NULL を入れようとしているので、NOT NULLのエラーに引っかかる
 * 
 * 回避策
 * NULL許容にする、NULLではないデフォルト値を設定する、データを捨ててテーブルを作り直す
 * 今回の user_id は外部キーなのでNULL許容出来ない、デフォルト値の設定も大変
 * 今回はテーブルの作り直し
 * php artisan migrate:fresh
 */