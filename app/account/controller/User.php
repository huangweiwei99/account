<?php

declare(strict_types=1);

namespace app\account\controller;

use app\middleware\Auth;
use think\Request;

class User extends Base
{
    // protected $middleware = [Auth::class];

    /**
     * 显示用户列表.
     *
     * @return \think\Response
     */
    public function index()
    {
        //参数
        $params = request()->get(['keywords', 'page', 'limit', 'sort', 'order']);
        $keywords = isset($params['keywords']) ? $params['keywords'] : [];
        $page = isset($params['page']) ? $params['page'] : null;
        $limit = isset($params['limit']) ? $params['limit'] : null;
        $sort = isset($params['sort']) ? $params['sort'] : null;
        $order = isset($params['order']) ? $params['order'] : null;

        //验证参数
        $this->validate([
            'keywords' => $keywords,
            'page' => $page,
            'limit' => $limit,
             ], [
            'keywords' => 'array',
            'page' => 'number',
            'limit' => 'number', ]);
        // $keywords = null;
        // $keywords = [['username' => 'Van'], ['email' => 'sda']];
        $users = $this->app->account_service->getUsers($keywords, 1, 20, $sort, $order);
        $users_count = $this->app->account_service->getUsers();
        $user_list['list'] = $users->visible(['id', 'username', 'email', 'phone', 'status']);
        $user_list['count'] = count($users_count);

        return json((resultResponse(['data' => $user_list])));
    }

    /**
     * 显示创建用户表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * 保���新建的用户.
     *
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //参数
        $params = $request->post(['username', 'password', 'phone', 'email', 'status']);
        $this->validate($params, 'app\account\validate\User');
        $user = $this->app->account_service->createUser($params);

        return json((resultResponse(['data' => '添加用户：'.$user->username.' 成功'])));
    }

    /**
     * 显示指定的用户.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function read($id)
    {
        $user = $this->app->account_service->getUserById($id);
        if ($user->isEmpty()) {
            $user = '没有数据';
        } else {
            $user->visible(['id', 'username', 'email', 'phone', 'roles']);
        }

        return json((resultResponse(['data' => $user])));
    }

    /**
     * 显示编辑用户表单页.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function edit($id)
    {
        // die();
        $this->validate(['id' => $id], ['id' => 'integer']);
        $user = $this->app->account_service->getUserById($id);

        foreach ($user->roles as $role) {
            $role->visible(['id', 'title'])->hidden(['pivot']);
        }
        $user->visible(['id', 'username', 'email', 'phone', 'roles']);

        return json((resultResponse(['data' => $user])));
    }

    /**
     * 保存更新的用户.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //参数
        $params = $request->put(['username', 'password', 'phone', 'email', 'status']);
        $params['id'] = $id;

        $this->validate($params, 'app\account\validate\User');
        $user = $this->app->account_service->updateUserById($params, $id);

        return json((resultResponse(['data' => '修改用户：'.$user->username.' 成功'])));
    }

    /**
     * 删除指定用户.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        $this->validate(['id' => $id], ['id' => 'integer']);
        $data = $this->app->account_service->deleteUserById($id);

        return json((resultResponse(['data' => '删除成功'])));
    }
}
