<?php

declare(strict_types=1);

namespace app\account\model;

/**
 * @mixin think\Model
 */
class Permission extends Base
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 't_permission';

    /**
     * 控制搜索器.
     */
    public function searchControllerAttr($query, $value, $data)
    {
        $query->where('controller', 'like', $value.'%');
        if (isset($data['sort'])) {
            $query->order($data['sort']);
        }
    }

    /**
     * 动作搜索器.
     */
    public function searchActionAttr($query, $value, $data)
    {
        $query->where('action', 'like', $value.'%');
        if (isset($data['sort'])) {
            $query->order($data['sort']);
        }
    }

    /**
     * 名字搜索器.
     */
    public function searchNameAttr($query, $value, $data)
    {
        $query->where('name', 'like', $value.'%');
        if (isset($data['sort'])) {
            $query->order($data['sort']);
        }
    }

    /**
     * 描述搜索器.
     */
    public function searchDescriptionAttr($query, $value, $data)
    {
        $query->where('description', 'like', $value.'%');
        if (isset($data['sort'])) {
            $query->order($data['sort']);
        }
    }
}
