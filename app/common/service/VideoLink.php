<?php

namespace app\common\service;

use app\common\service\base\CurlApi;
use think\facade\Config;

class VideoLink extends CurlApi
{
    //获取接口
    protected static string $getVideoUrl;


    //获取视频播放地址
    public static function getPlayLink($param)
    {
        self::$getVideoUrl = Config::get('app.get_video_play_url');
        return self::access_api($param,self::$getVideoUrl);
    }

}