<?php

namespace app\account\facade;

use think\Facade;

class UserFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\account\model\User';
    }
}
