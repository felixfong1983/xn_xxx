<?php

namespace app\api\controller;


use app\api\controller\base\Base;
use think\facade\Cookie;
use think\response\Json;

class Api extends Base
{

    //页面 title  description keywords 数据
    public function config()
    {

    }

    public function api()
    {
        try {

        }catch (\Exception $e){

        }
    }



    //主页信息
    public function index() : Json
    {
        $lang = app('app\api\common\Language',[Cookie::get('lang')])->getLang(); //当前语种语言包
        //dump($lang);
        $tags = app('app\api\common\Tag')->getTags($this->visitor->lang_id);
        //dump($tags);
        $videoList = app('app\api\common\Video')->getBestVideoList($this->request->param('rows',30));
        //dump($videoList);

        return $this->success([
            'lang' => $lang,
            'tags' => $tags,
            'videoList' => $videoList,
            'visitor' => [
                'sexual_orientation' => $this->visitor->sexual_orientation,
                'name' => $this->visitor->name,
            ],
        ]);

    }

    //标签页及搜索页
    public function tag_videos_list() : Json
    {
        $videoList = app('app\api\common\Video')->getVideoList($this->request->param('tag_id',));
        return $this->success(['data' => $videoList]);
    }


    //视频播放页
    public function video_detail() : Json
    {

        $video = app('app\api\common\Video')->getVideoById($this->request->param('id'));
        return $this->success(['data' => $video]);
    }




    //用户修改语言
    public function chang_language()
    {
        $langCode = $this->request->param('lang') ? $this->request->param('lang') : 'en';
        Cookie::set('lang',$langCode);
        return $this->redirect('/index/api');
    }


    public function __call($name, $arguments)
    {
        echo 1;
    }



}