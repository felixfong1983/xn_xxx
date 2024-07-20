<?php

namespace app\api\common;
use app\common\model\Tag as TagModel;
use think\facade\Request;

class Tag
{
    protected TagModel $tagModel;



    public function __construct(TagModel $tagModel){
        $this->tagModel = $tagModel;
    }
    public function getTags($langId,$rows)
    {
        return $this->tagModel->getIndexTagsByLang($langId,$rows);
    }





}