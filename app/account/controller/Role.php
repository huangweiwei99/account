<?php

declare(strict_types=1);

namespace app\account\controller;

use app\BaseController;
use think\exception\ValidateException;
use think\Request;

class Role extends BaseController
{
    protected $middleware = [Auth::class];

    /**
     * 显示角色列表.
     *
     * @return \think\Response
     */
    public function index()
    {
        $params = request()->get(['keywords', 'page', 'limit']);
        $keywords = isset($params['keywords']) ? $params['keywords'] : [];
        $page = isset($params['page']) ? $params['page'] : null;
        $limit = isset($params['limit']) ? $params['limit'] : null;

        //验证参数
        $this->validate([
            'keywords' => $keywords,
            'page' => $page,
            'limit' => $limit,
             ], [
            'keywords' => 'array',
            'page' => 'integer',
            'limit' => 'integer', ]);

        $roles = $this->app->account_service->getRoles(null, 1, 10);
        $roles_count = $this->app->account_service->getRoles(null, null, null);

        $roles_list['list'] = $roles->visible(['id', 'title', 'permission']);
        $roles_list['count'] = count($roles_count);

        return json((resultResponse(['data' => $roles_list])));
    }

    /**
     * 显示创建角色表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return 'role create';
    }

    /**
     * 保存新建的角色.
     *
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //参数
        $params = $request->only(['title', 'status', 'permission']);
        $params['title'] = isset($params['title']) ? $params['title'] : null;
        $params['status'] = isset($params['status']) ? $params['status'] : null;
        $params['permission'] = isset($params['permission']) ? $params[permission] : null;

        try {
            $this->validate([
                'title' => $params['title'],
                'status' => $params['status'],
                'permission' => $params['permission'],
            ], [
                'title' => 'require|max:100',
                'status' => 'integer|length:1',
                'permission' => 'length:255',
            ]);
            $role = $this->app->account_service->createRole($params);

            if (isset($role->error)) {
                return json((resultResponse(['error' => $role->error])));
            }

            return json((resultResponse(['data' => '添加角色：'.$role->title.' 成功'])));
        } catch (ValidateException $e) {
            //记录控制器错误���息log
            return json((resultResponse(['error' => $e->getError()])))->code(422);
        }
    }

    /**
     * 显示指定的角色.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function read($id)
    {
        $role = $this->app->account_service->getRoleById($id);

        if ($role->isEmpty()) {
            $role = '没有数据';
        } else {
            $role->visible(['id', 'title', 'status']);
        }

        return json((resultResponse(['data' => $role])));
    }

    /**
     * 显示编辑角色表单页.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function edit($id)
    {
        $this->validate(['ID' => $id], ['ID' => 'integer']);
        $role = $this->app->account_service->getRoleById($id);

        foreach ($role->users as $user) {
            $user->visible(['id', 'username', 'email', 'phone'])->hidden(['pivot']);
        }
        $role = $role->visible(['id', 'title', 'permission']);

        return json((resultResponse(['data' => $role])));
    }

    /**
     * 保存更新的角色.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //参数
        $params = $request->put(['title', 'status', 'permission']);
        $params['id'] = $id;

        //验证参数
        $this->validate($params, 'app\account\validate\Role');
        $role = $this->app->account_service->updateRoleById($params, $id);

        return json((resultResponse(['data' => '修改用户：'.$role->title.' 成功'])));
    }

    /**
     * 删除指定角色.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        $this->validate(['ID' => $id], ['ID' => 'integer']);
        $role = $this->app->account_service->deleteRoleById($id);

        return json((resultResponse(['data' => '删除成功'])));
    }
}
