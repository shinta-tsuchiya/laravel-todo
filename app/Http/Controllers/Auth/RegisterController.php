<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// 会員登録機能を受け持つコントローラー

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * $redirectTo は登録に成功した後のリダイレクト先
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * validator メソッドでバリデーションが定義されている
     * FormRequestクラスを使わずに、コントローラーの中で
     * validator クラスの make メソッドからバリデーション定義を作成する方法もある
     */
    protected function validator(array $data)
    {
        /** make メソッド
         * 第一引数:検証するデータ 第二引数:ルール定義
         * 第三引数:メッセージ定義 第四引数:項目名定義
         * メッセージは validation.php で定義するので、配列を渡し、第四引数で日本語の項目名を定義
         */
        return Validator::make($data, [
            'name' => 'required | string | max:255',

            /** unique ルール
             * 実際にデータベースの内容を参照して既に使用されている値かどうか確かめるルール
             * ルールの引数である users は参照するテーブル名
             * 'email' => 'unique:users' は email の入力値は users テーブルの email カラムで
             * 使われていない値でなければいけない、と言う意味
             */
            'email' => 'required | string | email | max:255 | unique:users',
            'password' => 'required | string | min:6 | confirmed',
        ], [], [
            'name' => 'ユーザー名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
