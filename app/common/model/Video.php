<?php

namespace app\common\model;

use think\Model;

class Video extends Model
{


    public function tag()
    {
        return $this->belongsToMany(Tag::class,VideoTagAccess::class);
    }


    //后台读取视频列表
    public function getVideoList()
    {
        return $this->field('id,video_id,title,img,cover_video,dislikes,likes,definition,length,is_online')->order('id desc')->select();
    }

    //根据标签读取视频列表
    public function getVideoByTag($tagId)
    {
        return $this->name('video')->alias('v')
            ->field('v.id,v.video_id,v.title,v.img,v.cover_video,v.dislikes,v.likes,v.definition,v.length')
            ->join('video_tag_access vt','vt.video_id = v.id')
            ->where(['is_online' => 1,'vt.tag_id' => $tagId])->select()->toArray();
    }

    public function getVideoById($id)
    {
        return $this->field('id,video_id,title,img,cover_video,dislikes,likes,definition,length,is_online')
            ->find($id)->toArray();
    }

    //主页最佳视频
    public function getBestVideoList($rows)
    {
        return $this->field('id,video_id,title,img,cover_video,dislikes,likes,definition,length')
            ->where(['is_online' => 1])->order('likes desc')->limit($rows)
            ->select()->toArray();
    }


}