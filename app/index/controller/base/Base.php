<?php

namespace app\index\controller\base;

use app\Request;
use think\response\Redirect;
use think\response\View;

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
//        var_dump($this->visitor);

    }


    //成功办理出页面

    /**
     * @param $template
     * @param $data
     * @param $code
     * @return View
     */
    protected function view_success($template, $data, $code = 200)
    {
        return view($template,['data'=>$data,'code'=>$code]);
    }


    //失败返回
    protected function view_error($template,$data,$code = 400)
    {
        return view($template,['data' => $data],$code);
    }

    //重定向
    protected function redirect($url) : Redirect
    {
        return redirect($url,302);
    }

//    public function __call($name, $arguments)
//    {
//        return $this->error(['name' => $name]);
//    }
    //替换出MP4地址
    protected function convertVideoSrc($path, $t = true) : string
    {
        // Get the path without the filename
        $path = substr($path, 0, strrpos($path, '/'));
        // Replace the desired pattern in the path
        $path = preg_replace('/\/thumbs(169)?(xnxx)?((l*)|(poster))\//', '/videopreview/', $path);

        // Append the appropriate file type based on $t
        $videoSrc = $path . ($t ? '_169.mp4' : '_43.mp4');
//        echo $videoSrc;
        // Replace the pattern in the filename
        return  preg_replace('/(-[0-9]+)_([0-9]+)/', '_$2$1', $videoSrc);
    }

    //把视频标题替换成地址栏上的可用地址
    protected function titleToUrl($title)
    {
//        $title = 'Hijab Teen Sophia Leone New Neighbor Teaching Her American Manners';
        return str_replace(' ', '-', $title);

    }



}