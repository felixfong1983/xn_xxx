<?php

namespace app\index\facade;
use think\Facade;


class Visitor extends Facade
{
    protected static function getFacadeClass()
    {
        return 'app\index\common\Visitor';
    }
}