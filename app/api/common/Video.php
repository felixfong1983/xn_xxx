<?php

namespace app\api\common;
use app\common\model\Video as VideoModel;
use app\common\service\VideoLink;
use think\facade\Cache;


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

    //通过频道ID找相关视频
    public function getVideoByChannelId($channelId,$rows)
    {
        return $this->videoModel->getVideoByChannelId($channelId,$rows);//通过频道找相关视频
    }

    public function getVideoById($id)
    {
//        if(Cache::has('video' . $id)){
//            return Cache::get('video' . $id);
//        }
        $data = $this->videoModel->getVideoById($id);
        if(!$data) return false;
        $param = ['play_page' => $data['play_page']];
        if(empty($data['thumbs_lide_min'])){
            $param['get_lide_min'] = 1;
        }

        $urlInfo = VideoLink::getPlayLink($param);

        //todo 采集站会有视频下架的情况，如果发现视频下架，需要改成下架状态
        if($urlInfo['code'] != 200) return false;

        if(isset($param['get_lide_min'])){
            //todo 以后要考虑更新失败情况
            $this->videoModel->where('id',$id)->update(['thumbs_lide_min' => $urlInfo['data']['thumb_slide_min']]);
            $data['thumbs_lide_min'] = $urlInfo['data']['thumb_slide_min'];
        }

        $data['src'] = $urlInfo['data']['url'];
        $tagModel = new \app\common\model\Tag();
        $data['tags'] = $tagModel->getTagsByVideoId($data['id']);

        // todo 如果频道视频不满足数量，再通过标签找相关视频
//        dump($data);
        unset($data['play_page']);
//        unset($data['channel_id']);
        //todo 需要做缓存
        Cache::set('video' . $id,$data,60*60*3); //3小时
        return $data;
    }

    public function likeOrDislike($id,$like)
    {
        return $this->videoModel->like($id,$like);
    }


}