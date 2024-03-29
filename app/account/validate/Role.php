<?php

declare(strict_types=1);

namespace app\account\validate;

use think\Validate;

class Role extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...].
     *
     * @var array
     */
    protected $rule = [
        'id' => 'integer',
        'title' => 'require|max:100',
        'status' => 'integer|length:1',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'.
     *
     * @var array
     */
    protected $message = [
        'id' => '必须为数字',
        'title' => '角色名称最多不能超过100字符',
    ];
}
