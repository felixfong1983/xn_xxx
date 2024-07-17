<?php

namespace app\common\service;

class RandomName
{



    public static function getVisitorName() : string
    {
        return 'Visitor' . random_int(1000000, 9999999);
    }

}