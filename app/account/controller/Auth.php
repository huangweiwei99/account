<?php

declare(strict_types=1);

namespace app\account\controller;

use app\BaseController;
use think\facade\Session;
use think\Request;

class Auth extends BaseController
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

        return json((resultResponse(['data' => Session::get('username').' login'])));
    }

    public function Logout()
    {
        Session::delete('username');

        return json((resultResponse(['data' => '退出系统'])));
    }
}
