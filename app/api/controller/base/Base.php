<?php

namespace app\api\controller\base;

use app\api\common\Visitor;
use app\Request;
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

        $controller = $this->request->controller();
        $action = $this->request->action();

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

    public function __call($name, $arguments)
    {
        return $this->error(['name' => $name]);
    }


}