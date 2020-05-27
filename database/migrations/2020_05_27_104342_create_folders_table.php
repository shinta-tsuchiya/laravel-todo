<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            // folders テーブル名
            // ここでカラムの作成の指示
            // ()内はカラム物理名
            // $table->カラムの属性('カラム名');
            $table->increments('id'); // SERIAL 自動採番 incrementsメソッド
            $table->string('title', 20); // VARCHAR(20) 20文字までの文字列
            $table->timestamps(); // 作成日、更新日 timestampsメソッドで作成される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folders');
    }
}
