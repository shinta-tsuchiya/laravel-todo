<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // authorizeメソッドにtrueを返却
        // authorizaメソッドはリクエストの内容に基づいた権限チェックのために使う
        // true -> この機能を使用せず、リクエストを受け付けるという意味
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    // ruleメソッド 入力欄ごとにチェックするルールを定義
    // ruleメソッドが返却する配列が、ルールを表す
    public function rules()
    {
        return [
            'title' => 'required|max:20',// required:必須, 入力上限20文字,複数のルールは|で区切る
        ];
        /**
         * 配列のキーが入力欄
         * HTML側のinput要素のname属性に対応している
         * キーに対する値の部分でルールを指定
         */
    }

    // 入力欄の名称をカスタマイズ
    public function attributes()
    {
        // attributesメソッドが返却する配列が入力欄の名称を定義する
        return [
            'title' => 'フォルダ名',
        ];
    }
}
