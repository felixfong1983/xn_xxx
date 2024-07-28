<?php

namespace app\common\model;

use think\Model;

class Video extends Model
{

    protected string $listField = 'id,title,img,dislikes,likes,definition,length,views,release_time';
    protected $playField = 'id,channel_id,thumbs_lide_big,thumbs_lide_min,thumbs_lide,thumbs_url,title,img,views,dislikes,likes,definition,length,play_page';

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
            ->field('v.id,v.title,v.img,v.dislikes,v.likes,v.definition,v.length,v.views,v.release_time')
            ->join('video_tag_access vt','vt.video_id = v.id')
            ->where(['is_online' => 1,'vt.tag_id' => $tagId])->order('release_time desc')->paginate($rows)->toArray();
    }

    //前台视频播放页  需要判断is_online 是否上架
    public function getVideoById($id)
    {
        $data = $this->field($this->playField)
            ->where(['is_online' => 1])->find($id);
        if($data) return $data->toArray();
        return false;
    }

    //主页最佳视频
    public function getBestVideoList($rows)
    {
        return $this->field($this->listField)->field($this->listField)
            ->where(['is_online' => 1])->order('release_time desc')
            ->paginate($rows)->toArray();
    }

    //搜索功能   通过搜索词查找
    public function search($search,$rows)
    {
        return $this->where('title','like','%'.$search.'%')
            ->field($this->listField)
            ->where('is_online',1)->paginate($rows)->toArray();
    }

    //根据视频ID找出采集站视频站播放页
    public function getPlayPageByid($id)
    {
        return $this->where('id',$id)->column('play_page');
    }

    //通过频道ID查找相关视频
    public function getVideoByChannelId($channelId,$rows)
    {
        return $this->where('channel_id',$channelId)->field($this->listField)->paginate($rows)->toArray();
    }

    //视频like和dislike加一
    public function like($id,$like)
    {
        if($like === 1) return $this->where('id',$id)->inc('likes',1)->save();
        return $this->where('id',$id)->inc('dislikes',1)->save();
    }




}