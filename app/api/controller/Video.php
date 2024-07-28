<?php

namespace app\api\controller;

use app\api\controller\base\Base;
use app\api\validate\Param;
use think\exception\ValidateException;
use think\response\Json;

class Video extends Base
{
    //视频播放页
    public function video_detail() : Json
    {
        try {
            $param = $this->request->get();
            validate(Param::class)->check($param);
            $video = app('app\api\common\Video')->getVideoById($param['id']);
            if (!$video)  return $this->error('this id is not exist');
            $config = app('app\api\common\Config')->SeoData($video);
            return $this->success(['videoDetail' => $video,'config' => $config]);
        }catch (ValidateException $e){
            return $this->error($e->getError());
        }

    }
}