<?php

namespace app\api\controller;


use app\api\controller\base\Base;
use app\api\validate\Param;
use app\common\model\Language;
use think\Exception;
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
            $config['logo'] = './logo.png';  //todo 这个图片临时的
            $langList = $configObj->getIsOpenLanguage();//开放的语言列表
            return $this->success([
                'lang' => $lang,
                'videoList' => $videoList,
                'tags' => $tags,
                'config' => $config,
                'langList' => $langList,
                'visitor' => [
                    'sexual_orientation' => $this->visitor->sexual_orientation,
//                    'name' => $this->visitor->name,
                ],
            ]);
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

    //访问者点赞或点踩
    public function like_or_dislike() : Json
    {
        try {
            $param = $this->request->param();
            validate(Param::class)->check($param);
            $id = $param['id'];
            $like =  intval($param['like']) === 1 ? 1 : 0;
            $result = app('app\api\common\Video')->likeOrDislike($id,$like);
            if($result) return $this->success(['code' => 200]);
            return $this->error(['code' => 400]);
        }catch(ValidateException $e)
        {
            return $this->error($e->getError());
        }


    }







}