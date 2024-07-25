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



    public function getVideoById($id)
    {
        if(Cache::has('video' . $id)){
            return Cache::get('video' . $id);
        }
        $data = $this->videoModel->getVideoById($id);
        if(!$data) return false;
        $param = ['play_page' => $data['play_page']];
        if(empty($data['thumbs_lide_min'])){
            $param['get_lide_min'] = 1;
        }

        $urlInfo = VideoLink::getPlayLink($param);
        if($urlInfo['code'] != 200) return false;
        if(isset($param['get_lide_min'])){
            //todo 以后要考虑更新失败情况
            $this->videoModel->where('id',$id)->update(['thumbs_lide_min' => $urlInfo['data']['thumb_slide_min']]);
            $data['thumbs_lide_min'] = $urlInfo['data']['thumb_slide_min'];
        }

        unset($data['play_page']);
        $data['src'] = $urlInfo['data']['url'];
        $tagModel = new \app\common\model\Tag();
        $data['tags'] = $tagModel->getTagsByVideoId($data['id']);
        //todo 需要做缓存
        Cache::set('video' . $id,$data,60*60*3); //3小时
        return $data;
    }




}