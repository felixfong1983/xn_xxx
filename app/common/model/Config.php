<?php

namespace app\common\model;

use think\Model;

class Config extends Model
{
    //通过语言找出当前语言网站设置
    public function getWebConfigByLangId($langId)
    {
        return $this->field('title,desc,keywords')->where(['lang_id' => $langId])->find()->toArray();
    }
}