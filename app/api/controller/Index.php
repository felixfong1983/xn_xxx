<?php

namespace app\api\controller;


use app\api\controller\base\Base;
use think\facade\Cookie;
use think\response\Json;

class Index extends Base
{



    //主页信息
    public function init() : Json
    {
        $lang = app('app\api\common\Language',[Cookie::get('lang')])->getLangPacks($this->visitor->langCode); //当前语种语言包
        //dump($lang);
        $tags = app('app\api\common\Tag')->getTags($this->visitor->lang_id);

        //dump($tags);
        $videoList = app('app\api\common\Video')->getBestVideoList($this->request->param('rows',30));
        //dump($videoList);

        $config = app('app\api\common\Config')->getWebConfigByLangId($this->visitor->lang_id);
        return $this->success([
            'lang' => $lang,
            'tags' => $tags,
            'videoList' => $videoList,
            'config' => $config,
            'visitor' => [
                'sexual_orientation' => $this->visitor->sexual_orientation,
                'name' => $this->visitor->name,
            ],
        ]);

    }

    //标签页及搜索页
    public function tag_videos_list() : Json
    {
        $videoList = app('app\api\common\Video')
            ->getVideoList($this->request->param('tag_id','rows'));
        $config = app('app\api\common\Config')->SeoData($videoList);

        return $this->success(['data' => $videoList,'config' => $config]);
    }


    //视频播放页
    public function video_detail() : Json
    {
        $video = app('app\api\common\Video')->getVideoById($this->request->param('id'));
        if (!$video)  return $this->error('this id is not exist');
        $config = app('app\api\common\Config')->SeoData($video);
        return $this->success(['data' => $video,'config' => $config]);
    }




    //用户修改语言
    public function chang_language()
    {
        $langCode = $this->request->param('lang') ? $this->request->param('lang') : 'en';
        Cookie::set('lang',$langCode);
        return $this->redirect('/');
    }


    public function __call($name, $arguments)
    {
        echo 'this is api __call';
    }



}