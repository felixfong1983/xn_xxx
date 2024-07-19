<?php
namespace app\api\common;


use app\common\model\Language as LanguageModel;
use think\facade\Cookie;
use think\facade\Request;

class Language
{


    public string $langCode;    //语言码
    public int $langId;          //数据库语言id

    public function __construct()
    {
        if(Cookie::has('lang_code')){
            //todo 是否要通过数据库查下语言合法性
            $this->langCode = Cookie::get('lang_code');
        }else{
            $this->getBrowserLang();
        }
        return $this;
    }

    public function getLangPacks($langCode): array
    {
        return include(app()->getAppPath() . 'lang/' . strtolower($langCode) . '.php');
    }
    //先获取浏览器的语言 没有就默认英文
    protected function getBrowserLang()
    {
        //有可能浏览器安装有多个语言
        $headerLanguage = explode(',',Request::header('accept-language'));
        if(count($headerLanguage) > 0)
        {
            $langCode = explode(';', $headerLanguage[0]);
            $langModel = new LanguageModel();
            $id = $langModel->getIdByCode($langCode[0]); //查找是否有对应的语言也查检了是否open 不用系统的config配置
            if($id){
                $this->langCode = $langCode[0];
                $this->langId = $id;
                return true;
            }
            $this->langCode = 'en';
            $this->langId = 1;
            return true;
        }else{
            $this->langCode = 'en';
            $this->langId = 1;
        }
        return true;
    }





}