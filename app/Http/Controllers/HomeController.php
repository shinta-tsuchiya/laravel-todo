<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // ログインユーザーを取得する
        $user = Auth::user();

        // ログインユーザーに紐づくフォルダを一つ取得する
        $folder = $user->folders()->first();

        // まだ一つもフォルダを作っていなければホームページをレスポンスする
        // もし (nullなら(フォルダーが)){返却する ビューに(ホームを);}
        if (is_null($folder)) {
            return view('home');
        }

        // フォルダがあればそのフォルダのタスク一覧にリダイレクトする
        // 返却する ()に入ったリダイレクト先へ
        // 中身はrouteのtasks.indexでidはフォルダのid
        return redirect()->route('tasks.index', [
            'folder' => $folder->id,
        ]);
    }
}
