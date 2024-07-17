<?php

namespace app\common\model;

use think\Model;

class Language extends Model
{
    //读取所有语言
    public function getAllLanguage()
    {
        return $this->select();
    }

    //读取已开放的语言
    public function getIsOpen()
    {
        return $this->where(['open' => 1])->select();
    }

    //通过语言值获取ID
    public function getIdByCode($code)
    {
        return $this->where(['iso_code' => $code])->value('id');
    }

    //通过ID获取语种
    public function getLangCodeById($id)
    {
        return $this->where('id',$id)->value('iso_code');
    }


}