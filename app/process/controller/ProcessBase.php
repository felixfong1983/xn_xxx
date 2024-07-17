<?php

namespace app\process\controller;

use app\common\controller\Base;
use think\facade\Request;

class ProcessBase
{
    //

    public function __construct()
    {
        $host = Request::host();
        if($host != 'www.xn.mac'){
            die('无权限');
        }
    }
}