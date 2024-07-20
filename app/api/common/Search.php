<?php

namespace app\api\common;

use app\common\model\Tag;

class Search
{

    protected Tag $tagModel;

    public function __construct()
    {
        $this->tagModel = new Tag();
    }


    //
    public function search($search,$rows)
    {
        $id = $this->tagModel->isExist($search);
        if($id)  return $id;
        $videoModel = new \app\common\model\Video();
        return $videoModel->search($search,$rows);
    }




}