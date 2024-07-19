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
        $lang = app('app\api\common\Language',[Cookie::get('lang')])
            ->getLangPacks($this->visitor->langCode); //当前语种语言包
        //dump($lang);
        $tags = app('app\api\common\Tag')
            ->getTags($this->visitor->lang_id,$this->request->param('tag_rows',30));

        //dump($tags);
        $videoList = app('app\api\common\Video')
            ->getBestVideoList($this->request->param('video_rows',30));
        //dump($videoList);

        $configObj = app('app\api\common\Config');
        $config = $configObj->getWebConfigByLangId($this->visitor->lang_id);
        $config['logo'] = './logo.jpg';
        $langList = $configObj->getIsOpenLanguage();//开放的语言列表
        return $this->success([
            'lang' => $lang,
            'videoList' => $videoList,
            'tags' => $tags,
            'config' => $config,
            'langList' => $langList,
            'visitor' => [
                'sexual_orientation' => $this->visitor->sexual_orientation,
                'name' => $this->visitor->name,
            ],
        ]);

    }

    //标签页及搜索页
    public function tag_videos_list() : Json
    {
        $param = $this->request->param();

        $videoList = app('app\api\common\Video')
            ->getVideoList($param['tag_id'],$param['rows']);
        $config = app('app\api\common\Config')->SeoData($videoList);

        return $this->success(['videoList' => $videoList,'config' => $config]);
    }


    //视频播放页
    public function video_detail() : Json
    {
        $video = app('app\api\common\Video')->getVideoById($this->request->param('id'));
        if (!$video)  return $this->error('this id is not exist');
        $config = app('app\api\common\Config')->SeoData($video);
        return $this->success(['videoDetail' => $video,'config' => $config]);
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