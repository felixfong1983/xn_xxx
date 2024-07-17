<?php

namespace app\index\controller;

use app\index\common\Tag;
use app\index\common\Video;
use app\index\common\Visitor;
use app\Request;
use think\Response;
use think\response\Json;
use think\response\Redirect;

class Base
{

    protected Request $request;     //请求

    protected Visitor $visitor;     //访问者

    protected string $keywords;
    protected string $description;
    protected string $title;


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->visitor = new Visitor();


//        dump($this->visitor);



    }


    //成功返回
    protected function success($data,$code = 200) : Json
    {
        return json($data,$code);
    }


    //失败返回
    protected function error($data,$code = 400) : Json
    {
        return json(['data' => $data],$code);
    }

    //重定向
    protected function redirect($url) : Redirect
    {
        return redirect($url,302);
    }




}