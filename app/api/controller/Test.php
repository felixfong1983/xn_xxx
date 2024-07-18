<?php
namespace app\api\controller;


use app\common\service\GoogleLanguage;
use app\api\controller\base\Base;


class Test extends Base
{
    public function index()
    {


    }

    public function test()
    {
        $obj = new GoogleLanguage();
        $text = 'serbian';
        echo $obj->getLanguageCode($text);

        $obj->transLanguage('คุยไป-เย็ดไป','ZH-CN');

    }




}