<?php

namespace app\index\controller;

use app\index\controller\base\Base;
use app\api\validate\Param;
use think\exception\ValidateException;


class Video extends Base
{
    //视频播放页
    public function video_detail($id)
    {
        try {

//            validate(Param::class)->check($param);
            $tags = app('app\api\common\Tag')
                ->getTags($this->visitor->lang_id,$this->request->get('tag_rows',30));
            $video = app('app\api\common\Video')->getVideoById($id);

            if (!$video)  return $this->error('this id is not exist');
            $config = app('app\api\common\Config')->SeoData($video);
            $videoList = app('app\api\common\Video')->getVideoByChannelId($video['channel_id'],40);
            foreach ($videoList['data'] as $k => $v)
            {
                $videoList['data'][$k]['mp4'] = $this->convertVideoSrc($v['img']);
                $videoList['data'][$k]['url'] = $this->titleToUrl($v['title']);
            }

            $data = [
                'video' => $video,
                'videoList' => $videoList,
                'config' => $config,
                'tags' => $tags,
            ];
            return $this->view_success('detail',$data);
        }catch (ValidateException $e){
            return $this->error($e->getError());
        }

    }
}