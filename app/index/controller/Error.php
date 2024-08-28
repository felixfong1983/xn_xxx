<?php

namespace app\index\controller;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;
use Throwable;


class Error extends Handle
{

    public function __call($method, $args)
    {
        //todo 写日志
        return json(['msg' => 'Error'],400);
    }


}