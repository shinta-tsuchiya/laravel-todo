<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

/**
 * EditTask クラスは CreateTask クラスを継承
 * タスクの作成と編集では状態欄の有無が異なるだけでタイトルと期限日は同一なので
 * 重複を避けるために継承を使用
 */
class EditTask extends CreateTask
{
    // 状態欄には入力値が許可リストに含まれているか検証する inルール を使用する
    public function rules()
    {
        $rule = parent::rules();

        /**
         * 許可リスト array_keys(Task::STATUS)で配列として取得
         * Rule クラスの in メソッドを使ってルールの文字列を作成
         */
        $status_rule = Rule::in(array_keys(Task::STATUS));
        // -> 'in(1, 2, 3)' を出力する

        return $rule + [
            // 親クラス CreateTask の rules メソッドの結果と合体したルールリストを返却する
            'status' => 'required|' . $status_rule,
            // 結果として出力されるルール
            // 'status' => 'required|in(1, 2, 3)',
        ];
    }

    // 親クラス CreateTask の attributes メソッドの結果と合体した属性名リストを返却
    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    /**
     * Taks::STATUS から status.in ルールのメッセージを作成
     * Task::STATUS の各要素から label キーの値のみ取り出して作った配列を
     * さらに句読点でくっつけて文字列を作成
     * 最終的に「状態には未着手、着手中、完了のいずれかを指定して下さい。」というメッセージが出来る
     */
    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
            }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
