<?php

declare(strict_types=1);

namespace app\Account\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...].
     *
     * @var array
     */
    protected $rule = [
        'id' => 'integer',
        'username' => 'require|max:255',
        'password' => 'require|min:6',
        'email' => 'email',
        'phone' => 'integer|length:11',
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
        // 'username.require' => '用户名必须',
        'username.max' => '用户名最多不能超过255个字符',
        // 'password.require' => '密码必须',
        'password.min' => '密码长度最少为6位',
    ];
}
