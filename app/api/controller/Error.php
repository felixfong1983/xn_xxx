<?php

namespace app\api\controller;
use think\exception\Handle;

class Error extends Handle
{



    public function __call($method, $args)
    {
        //todo 写日志
        return json(['msg' => 'error'],400);
    }


}