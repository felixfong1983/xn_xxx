<?php
namespace app\index\controller;


use app\index\facade\Visitor;
use app\common\service\GoogleLanguage;




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