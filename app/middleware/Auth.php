<?php

declare(strict_types=1);

namespace app\middleware;

use app\account\facade\AccountServiceFacade;
use think\facade\Session;

class Auth
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     *
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        if (Session::has('username')) {
            $auth = AccountServiceFacade::authInMiddleWare(Session::get('username'), $request->controller(), $request->action());
            if ($auth) {
                return $next($request);
            } else {
                return  json(['没有授权']);
            }
        } else {
            return  json(['请登录']);
        }
    }
}
