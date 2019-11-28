<?php

declare(strict_types=1);

namespace app\account\controller;

use app\middleware\Auth as AuthMiddleWare;
use think\Request;

class Permission extends Base
{
    // protected $middleware = [AuthMiddleWare::class];

    /**
     * 显示权限列表.
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
            'page' => 'number',
            'limit' => 'number', ]);
        $permission = $this->app->account_service->getPermissionList(null, 1, 10);
        $permission_count = $this->app->account_service->getPermissionList(null, null, null);
        $permission_list['list'] = $permission;
        $permission_list['count'] = count($permission_count);

        return json((resultResponse(['data' => $permission_list])));
    }

    /**
     * 显示创建权限表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return 'create';
    }

    /**
     * 保存新建的权限.
     *
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $params = $request->post(['controller', 'action', 'description', 'name']);
        $this->validate($params, 'app\account\validate\Permission');
        $this->app->account_service->createPermission($params);

        return json((resultResponse(['data' => '添加权限成功'])));
    }

    /**
     * 显示指定的权限.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function read($id)
    {
        $this->validate(['ID' => $id], ['ID' => 'integer']);
        $permission = $this->app->account_service->getPermissionById($id);
        if ($permission->isEmpty()) {
            $permission = '没有数据';
        } else {
            $permission->visible(['id', 'controller', 'action', 'name']);
        }

        return json((resultResponse(['data' => $permission])));
    }

    /**
     * 显示编辑权限表单页.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function edit($id)
    {
    }

    /**
     * 保存更新的权限.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //参数
        $params = $request->put(['controller', 'action', 'name', 'description']);
        $params['id'] = $id;
        $this->validate($params, 'app\account\validate\Permission');
        $user = $this->app->account_service->updatePermissionById($params, $id);

        return json((resultResponse(['data' => '修改权限成功'])));
    }

    /**
     * 删除指定权限.
     *
     * @param int $id
     *
     * @return \think\Response
     */
    public function delete($id)
    {
        $this->validate(['id' => $id], ['id' => 'integer']);
        $data = $this->app->account_service->deletePermissionById($id);

        return json((resultResponse(['data' => '删除成功'])));
    }
}
