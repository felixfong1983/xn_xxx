<?php

namespace app\index\common;
use app\common\model\Video as VideoModel;
use app\common\service\VideoLink;


class Video
{
    protected videoModel $videoModel;


    public function __construct(VideoModel $videoModel){
        $this->videoModel = $videoModel;
    }

    //根据标签或取视频列表
    public function getVideoList($tagId)
    {
        return $this->videoModel->getVideoByTag($tagId);
    }

    //获取主页最佳视频
    public function getBestVideoList($rows)
    {
        return $this->videoModel->getBestVideoList($rows);
    }



    public function getVideoById($id)
    {
        $data = $this->videoModel->getVideoById($id);
        $data['m3u8'] = VideoLink::getPlayLink(['video_id' => $data['video_id']]);
        $tagModel = new \app\common\model\Tag();
        $data['tag'] = $tagModel->getTagsByVideoId($data['id']);
        return $data;
    }



}