<?php

namespace app\api\common;

use app\common\model\Config as ConfigModel;
use think\facade\Request;

class Config
{

    protected ConfigModel $configModel;

    public function __construct()
    {
        $this->configModel = new ConfigModel();
    }


    //通过语言ID找出当前语言网站TITLE、描述、关健词
    public function getWebConfigByLangId($langId)
    {
        return $this->configModel->getWebConfigByLangId($langId);
    }


    //组合页面SEO数据
    public function SeoData($data) : array
    {

        $action = Request::action();
        $seoData = [];
        if($action == 'tag_videos_list')
        {
            $tagModel = new \app\common\model\Tag();
            $tagName = $tagModel->getTagName(Request::param('tag_id'));
            $seoData['title'] = $tagName . ' ' .Request::host();
            $seoData['keywords'] = $this->configModel->getkeywordsByLangId(1);
            $seoData['description'] = $tagName . 'free';
        }elseif($action == 'video_detail'){
            $seoData['title'] = $data['title'];
            $keywords = '';
            foreach($data['tags'] as $v)
            {
                $keywords .= $v['name'] . ' ' ; //连接空格  把标签分开
            }
            $seoData['keywords'] = $keywords;
            $seoData['description'] = $keywords . ' free';
        }

        return $seoData;
    }

    //获取系统开放的语言列表
    public function getIsOpenLanguage()
    {
        $model = new \app\common\model\Language();
        return $model->getIsOpen();
    }



}