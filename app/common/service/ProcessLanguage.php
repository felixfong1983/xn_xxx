<?php

namespace app\common\service;

use app\common\service\base\CurlApi;

class ProcessLanguage extends CurlApi
{
    const API = 'http://207.246.126.148:5000/classify';

    //检测语言
    public static function getLanguageCode(array $data)
    {
        return self::access_api($data,self::API,'JSON');
    }


}