<?php

declare(strict_types=1);

namespace app\account\validate;

use think\Validate;

class Permission extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...].
     *
     * @var array
     */
    protected $rule = [
        'id' => 'integer',
        'controller' => 'max:100',
        'action' => 'max:100',
        'description' => 'max:255',
        'name' => 'max:100',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'.
     *
     * @var array
     */
    protected $message = [];
}
