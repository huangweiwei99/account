<?php

declare(strict_types=1);

namespace app\account\controller;

use app\BaseController;

class Base extends BaseController
{
    // public function responseAccountError($error = null)
    // {
    //     $error = null !== $error ? $error : $this->app->account_service->getError();
    //     if ($error) {
    //         return json((resultResponse(['error' => $error])));
    //     } else {
    //         return false;
    //     }
    // }

    // public function responseAccount3($data)
    // {
    //     return json((resultResponse(['data' => $data])));
    // }

    // public function responseAccount($error = null, $data = null)
    // {
    //     $error = null !== $error ? $error : $this->app->account_service->getError();
    //     if ($error) {
    //         return json((resultResponse(['error' => $error])));
    //     } else {
    //         return json((resultResponse(['data' => $data])));
    //     }
    // }
}
