<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;

class Language extends AdminBase
{

    public function index()
    {
        $data = \app\common\model\Language::select()->toArray();
        dump($data);

    }
}