<?php

namespace App\Providers;

use App\Folder;
// Folder クラスと FolderPolicy クラスをインポート
use App\Policies\FolderPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     * 
     * Policies プロパティでモデルクラスとポリシークラスを紐付け
     * Folder モデルに対する処理への認可には FolderPolicy ポリシーを使用するという意味
     */
    protected $policies = [
        Folder::class => FolderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
