<?php

namespace app\account\facade;

use think\Facade;

class PermissionFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\account\model\Permission';
    }
}
