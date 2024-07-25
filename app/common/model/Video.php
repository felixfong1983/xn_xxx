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
        return $this->field('id,video_id,title,img,cover_video,dislikes,likes,definition,length,is_online')
            ->order('id desc')->select();
    }

    //根据标签读取视频列表
    public function getVideoByTag($tagId,$rows)
    {
        return $this->name('video')->alias('v')
            ->field('v.id,v.video_id,v.title,v.img,v.cover_video,v.dislikes,v.likes,v.definition,v.length')
            ->join('video_tag_access vt','vt.video_id = v.id')
            ->where(['is_online' => 1,'vt.tag_id' => $tagId])->paginate($rows)->toArray();
    }

    //前台视频播放页  判断is_online 是否上架
    public function getVideoById($id)
    {
        $data = $this->field('id,video_id,thumbs_lide_big,thumbs_lide,thumbs_url,title,img,cover_video,dislikes,likes,definition,length,play_page')
            ->where(['is_online' => 1])->find($id);
        if($data) return $data->toArray();
        return false;
    }

    //主页最佳视频
    public function getBestVideoList($rows)
    {
        return $this->field('id,video_id,title,img,cover_video,dislikes,likes,definition,length')
            ->where(['is_online' => 1])->order('likes desc')
            ->paginate($rows)->toArray();
    }

    //搜索功能   通过搜索词查找
    public function search($search,$rows)
    {
        return $this->where('title','like','%'.$search.'%')
            ->where('is_online',1)->paginate($rows)->toArray();
    }

    //根据视频ID找出采集站视频站播放页
    public function getPlayPageByid($id)
    {
        return $this->where('id',$id)->column('play_page');
    }




}