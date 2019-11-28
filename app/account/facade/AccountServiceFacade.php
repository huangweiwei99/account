<?php

namespace app\account\facade;

use think\Facade;

class AccountServiceFacade extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\account\service\AccountService';
    }
}
