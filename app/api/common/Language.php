<?php

namespace app\api\common;
use app\common\model\Language as LanguageModel;

class Language
{

    protected string $langFile;


    public function __construct(string $lang = 'en',LanguageModel $languageModel)
    {
        $this->langFile = app()->getAppPath() . 'lang/' . strtolower($lang) . '.php';
    }

    public function getLang()
    {
        return include($this->langFile);
    }




}