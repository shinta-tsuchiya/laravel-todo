<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100',

            //date 日付を表す値であること
            // after... 特定の日付と同じまたはそれ以降の日付であること
            // 引数に today 今日を含んだ未来日だけ許容
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function attributes()
    {
        return [
            'titel' => 'タイトル',
            'due_date' => '期限日',
        ];
    }

    // message メソッド
    // FormRequestクラス単位でエラーメッセージするために定義
    // 一般的なルールは validation.php に記述
    public function message()
    {
        return [

            // キーでメッセージが表示されるべきルールを指定
            // ドット区切りで左側が項目、右側がルールを意味する
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
