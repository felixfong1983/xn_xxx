<?php

namespace app\api\controller;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\ValidateException;
use think\Response;
use Throwable;
class Error extends Handle
{






    public function __call($method, $args)
    {

        dump($method);
        dump($args);
        return 'error request!';
    }


}