<?php

namespace app\api\controller;


use app\api\controller\base\Base;
use app\api\validate\Param;
use app\common\model\Language;
use think\exception\ValidateException;
use think\facade\Cookie;
use think\response\Json;

class Index extends Base
{

    //主页信息
    public function init() : Json
    {
        try {

            validate(Param::class)->check($this->request->get());
            $lang = app('app\api\common\Language',[Cookie::get('lang')])
                ->getLangPacks($this->visitor->langCode); //当前语种语言包
            //dump($lang);
            $tags = app('app\api\common\Tag')
                ->getTags($this->visitor->lang_id,$this->request->get('tag_rows',30));

            //dump($tags);
            $videoList = app('app\api\common\Video')
                ->getBestVideoList($this->request->get('video_rows',30));
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
        }catch (ValidateException $e){
            return $this->error($e->getError());
        }

    }

    //标签页及搜索页
    public function tag_videos_list() : Json
    {
        try {
            $param = $this->request->get();
            validate(Param::class)->check($this->request->get());
            $videoList = app('app\api\common\Video')
                ->getVideoList($param['tag_id'],$param['video_rows']);
            $config = app('app\api\common\Config')->SeoData($videoList);

            return $this->success(['videoList' => $videoList,'config' => $config]);
        }catch (ValidateException $e){
            return $this->error($e->getError());
        }

    }


    //搜索功能
    public function search() : Json
    {
        try {
            $param = $this->request->get();
            $rows = isset($param['rows']) ? (int)$param['rows'] : 30;
            validate(Param::class)->check($param);//验证搜索词  重要
            $result = app('app\api\common\Search')->search($param['search'],$rows);
            if(is_numeric($result)){  //如果查了已经有了这个tag 就直接通过标签ID查询
                $videoList = app('app\api\common\Video')
                    ->getVideoList($result,$rows);
                $config = app('app\api\common\Config')->SeoData($videoList);
                return $this->success(['videoList' => $videoList,'config' => $config]);
            }else{
                return $this->success(['videoList' => $result]);
            }
        }catch (ValidateException $e)
        {
            return $this->error($e->getError());
        }

    }


    //视频播放页
    public function video_detail() : Json
    {
        try {
            $param = $this->request->get();
            validate(Param::class)->check($param);
            $video = app('app\api\common\Video')->getVideoById($param['id']);
            if (!$video)  return $this->error('this id is not exist');
            $config = app('app\api\common\Config')->SeoData($video);
            return $this->success(['videoDetail' => $video,'config' => $config]);
        }catch (ValidateException $e){
            return $this->error($e->getError());
        }

    }




    //用户修改语言
    public function chang_language() : Json
    {

        $langCode = $this->request->get('lang');
        $languageModel = new Language();
        $openLang = $languageModel->getIsOpen();
        $isOpenLangArr = array_column($openLang,'iso_code');

        if(in_array($langCode,$isOpenLangArr)){
            Cookie::set('lang',$langCode);
            return $this->success(['langCode' => $langCode]);
        }else
        {
            Cookie::set('lang','en');
            return $this->success(['langCode' => 'en']);
        }

    }


    public function __call($name, $arguments)
    {
        return $this->error(['name' => $name]);
    }



}