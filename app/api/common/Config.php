<?php

namespace app\api\common;

use app\common\model\Config as ConfigModel;

class Config
{

    protected ConfigModel $configModel;

    public function __construct()
    {
        $this->configModel = new ConfigModel();
    }


    //通过语言ID找出当前语言网站TITLE、描述、关健词
    public function getWebConfigByLangId($langId)
    {
        return $this->configModel->getWebConfigByLangId($langId);
    }
}