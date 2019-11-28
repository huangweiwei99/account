<?php

namespace app\account\service;

class BaseService
{
    protected $error;

    public function getError()
    {
        return $this->error;
    }
}
