<?php

namespace app\common\model;

use think\Model;

class VisitorTag extends Model
{
    //通过用户ID，查找出所有的用户标签
    public function getTagsByVisitorId($visitorId)
    {
        return $this->field('tag_id')->where('visitor_id', $visitorId)->select()->toArray();
    }
}