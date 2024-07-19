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
        return $this->field('id,iso_code')->where(['open' => 1])->select();
    }

    //通过语言值获取语言id  而且是系统开放的
    public function getIdByCode($code)
    {
        return $this->where(['iso_code' => $code,'open' => 1])->value('id');
    }

    //通过ID获取语种
    public function getLangCodeById($id)
    {
        return $this->where('id',$id)->value('iso_code');
    }


}