<?php

declare(strict_types=1);

namespace app\account\service;

class AccountServiceRegister extends \think\Service
{
    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
        $this->app->bind('account_service', AccountService::class);
    }

    /**
     * 执行服务
     *
     * @return mixed
     */
    public function boot()
    {
    }
}
