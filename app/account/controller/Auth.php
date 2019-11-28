<?php

declare(strict_types=1);

namespace app\account\controller;

use think\facade\Session;
use think\Request;

class Auth extends Base
{
    public function login(Request $request)
    {
        $params = $request->post(['username', 'password']);
        $this->validate($params, 'app\account\validate\User');

        $user = $this->app->account_service->getUserByUsrAndPwd($params['username'], $params['password']);

        if ($user->isEmpty()) {
            return '用户名或者密码错误';
        }
        Session::set('username', $user->username);

        return Session::get('username').' login';
    }

    public function Logout()
    {
        Session::delete('username');

        return 'logout';
    }
}
