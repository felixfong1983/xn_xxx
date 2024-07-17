<?php

namespace app\common\model;

use think\Model;

class Xvideos extends Model
{
    //找出指定的数据
    public function get_data($start=0,$length=10)
    {
        return $this->field('id,title,img,category_id,video_id,video_url,cover_mp4,tag,duration,clarity')->limit($start,$length)->select()->toarray();
    }


}