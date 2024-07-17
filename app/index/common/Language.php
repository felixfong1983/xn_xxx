<?php

namespace app\index\common;
use app\common\model\Language as LanguageModel;

class Language
{

    protected string $langFile;


    public function __construct(string $lang,LanguageModel $languageModel)
    {
        $this->langFile = app()->getAppPath() . 'lang/' . strtolower($lang) . '.php';
        if(!is_file($this->langFile)){  //没有就默认英文
            $this->langFile = app()->getAppPath() . 'lang/en.php';
        }
    }

    public function getLang()
    {
        return include($this->langFile);
    }




}