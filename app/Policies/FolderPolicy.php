<?php

namespace App\Policies;

use App\Folder;
use App\User;

/**
 * ポリシークラスでは認可処理を、真偽値を返すメソッドで表現
 * FolderPolicy クラスでは view メソッドによって
 * 「ユーザーとフォルダが紐付いている時のみ許可する」
 * という意味の認可処理が定義されている
 */
class FolderPolicy
{
    /**
     * フォルダの閲覧権限
     * @param User $user
     * @param Folder $folder
     * @return bool
     */
    public function view(User $user, Folder $folder)
    {
        return $user->id === $folder->user_id;
    }
}
