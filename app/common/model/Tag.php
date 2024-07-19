<?php

namespace app\common\model;

use think\Model;

class Tag extends Model
{

//    public function video()
//    {
//        return $this->belongsToMany(Video::class,VideoTagAccess::class);
//    }


    public function language()
    {
        return $this->belongsToMany(Language::class,TagLangAccess::class,'lang_id','tag_id');
    }


    //获取当前语言首页显示的标签
    public function getIndexTagsByLang($langId,$rows)
    {
        return $this->name('tag')->alias('t')->field('t.id,t.name')
            ->join('tag_lang_access tl','t.id = tl.tag_id')
            ->join('language l','l.id = tl.lang_id')
            ->where(['type' => 1,'l.id' => $langId])->order('clicks','desc')->limit(0,$rows)->select()->toArray();
    }




    public function getId($name)
    {
        return $this->where('name',$name)->value('id');
    }

    public function getTagName($id)
    {
        return $this->where('id',$id)->value('name');
    }


    //通过视频ID找出标签
    public function getTagsByVideoId($videoId)
    {
        return $this->name('tag')->alias('t')->field('t.id,t.name')
            ->join('video_tag_access vt','t.id = vt.tag_id')
            ->join('video v','v.id = vt.video_id')
            ->where(['vt.video_id' => $videoId])->select()->toArray();
    }



}