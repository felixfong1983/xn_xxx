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

        $tagData = Tag::limit('3000','1000')->field('id,name')->order('id')->select()->toArray();

        $arr = [1,5];
        $insertData = [];
        foreach ($tagData as $k => $v)
        {
            $insertData[$k]['tag_id'] = $v['id'];
            $insertData[$k]['lang_id'] = $arr[mt_rand(0,1)];
        }

        foreach ($insertData as $tagK => $tagV)
        {
//            Db::name('tag_lang_access')->insert($tagV);
        }
//        dump($tagData);
//        dump($insertData);
        echo 'ok';
        die;


        foreach ($tagData as $k => $v)
        {
            $text = ['text' => $v['name']];
            $result = ProcessLanguage::getLanguageCode($text);
            $tagData[$k]['language'] = $result['language'];

        }

        foreach ($tagData as $tagK => $tagV)
        {
            $langId = Db::name('language')->where('iso_code',$tagV['language'])->find()['id'];
            Db::name('tag_lang_access')->insert(['tag_id' => $tagV['id'],'lang_id' => $langId]);
        }

    }

    //检测视频标题语言





}