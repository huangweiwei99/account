<?php

namespace app\account\facade;

use think\Facade;

class RoleFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\account\model\Role';
    }
}
