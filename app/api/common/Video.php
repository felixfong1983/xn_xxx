<?php

namespace app\api\common;
use app\common\model\Video as VideoModel;
use app\common\service\VideoLink;


class Video
{
    protected videoModel $videoModel;


    public function __construct(VideoModel $videoModel){
        $this->videoModel = $videoModel;
    }

    //根据标签或取视频列表
    public function getVideoList($tagId,$rows)
    {
        return $this->videoModel->getVideoByTag($tagId,$rows);
    }

    //获取主页最佳视频
    public function getBestVideoList($rows)
    {
        return $this->videoModel->getBestVideoList($rows);
    }



    public function getVideoById($id)
    {
        $data = $this->videoModel->getVideoById($id);
        if(!$data) return false;
        $data['src'] = VideoLink::getPlayLink(['video_id' => $data['video_id']]);
        $tagModel = new \app\common\model\Tag();
        $data['tags'] = $tagModel->getTagsByVideoId($data['id']);
        return $data;
    }



}