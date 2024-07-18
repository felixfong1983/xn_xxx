<?php

namespace app\api\controller;

use app\api\controller\base\Base;

class Index extends Base
{
    public function index()
    {
        try {
            return 1;
        }catch (\Exception $e)
        {
            dump($e->getMessage());
        }

    }


    public function __call($name, $arguments)
    {
        return 'this is __call method';
    }
}