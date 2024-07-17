<?php

namespace app\common\service;

use app\common\service\base\CurlApi;

class VideoLink extends CurlApi
{
    //获取接口
    const API = 'http://207.246.126.148:443/video_url';


    //获取视频播放地址
    public static function getPlayLink($param)
    {
        return self::access_api($param,self::API)['url'];
    }

}