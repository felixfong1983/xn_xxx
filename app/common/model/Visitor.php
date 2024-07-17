<?php

namespace app\common\model;

use think\Model;

class Visitor extends Model
{
    //通过访问者的name查找id
    public function getIDByVisitorName($visitorName){
        $result = $this->field('id')->where('visitor_name',$visitorName)->find();
        return $result->id;
    }

}