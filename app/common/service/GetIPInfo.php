<?php

namespace app\common\service;

use IP2Location\Database;

class GetIPInfo
{
    const IP_DATA = "/ip_data/IP2LOCATION-LITE-DB1.IPV6.BIN";
    protected static object $ipDatabase;
    //www.ip2location.com   此IP三方网址
    public function __construct()
    {
        self::$ipDatabase = new Database(root_path() . self::IP_DATA);
    }

    public static function getCountryInfo($ip) : array
    {
        return app('IP2Location\Database',[root_path() . self::IP_DATA])->lookup($ip,Database::ALL);
//        return  self::$ipDatabase->lookup($ip,Database::ALL);
    }


}