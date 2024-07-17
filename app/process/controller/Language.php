<?php

namespace app\process\controller;

use app\common\model\Tag;
use app\common\service\ProcessLanguage;
use think\Facade\Db;

class Language extends ProcessBase
{


    //检测标签语言
    public static function tagLanguage()
    {
        $tagData = Tag::limit('40','30')->field('id,name')->order('id')->select()->toArray();

        foreach ($tagData as $k => $v)
        {
            $text = ['text' => $v['name']];
            $result = ProcessLanguage::getLanguageCode($text);
            $tagData[$k]['language'] = $result['language'];

        }
        dump($tagData);

        foreach ($tagData as $tagK => $tagV)
        {
            $langId = Db::name('language')->where('iso_code',$tagV['language'])->find()['id'];
            Db::name('tag_lang_access')->insert(['tag_id' => $tagV['id'],'lang_id' => $langId]);
        }

    }

    //检测视频标题语言





}