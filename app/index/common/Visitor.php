<?php

namespace app\index\common;
use app\common\model\Country as CountryModel;
use app\common\model\Language;
use app\common\model\Visitor as VisitorModel;
use app\common\service\Crpy;
use app\common\service\GetIPInfo;
use app\common\service\RandomName;
use think\facade\Config;
use think\facade\Cookie;
use think\facade\Request;

class Visitor
{

    public string $cookieName;
    public string $name;
    public int $country_id;
    public string $ip;
    public int $lang_id;
    public string $langCode;
    public int $sexual_orientation = 1;
    public int $id;

    public function __construct()
    {

        $this->cookieName = Config::get('Cookie.visitor_info');

        if(Cookie::has($this->cookieName))
        {
            $this->oldVisitor();
            return $this;
        }
        $this->newVisitor();

        return $this;
    }


    //如果是新访问者，就生成信息存库
    protected function newVisitor()
    {
        //$this->ip = Request::ip(); //获取IP地址
        $this->ip = '20.228.9.78';
        $this->name = RandomName::getVisitorName();

        //TODO 如果IP找不到国家地址怎么办
        $visitorCountryInfo = GetIPInfo::getCountryInfo($this->ip);
        //dump($visitorCountryInfo);

        $this->country_id = CountryModel::where('COUNTRY_ALPHA2_CODE',$visitorCountryInfo['countryCode'])->value('id');
        $langInfo = $this->getBrowserLang();
        $this->lang_id = $langInfo['lang_id'];
        $this->langCode = $langInfo['lang_code'];

        //存入数据库
        $visitor = VisitorModel::create([
                    'name' => $this->name,
                    'country_id' => $this->country_id,
                    'lang_id' => $this->lang_id,
                    'ip' => $this->ip,
                    'sexual_orientation' => $this->sexual_orientation
        ]);
        $this->id = $visitor->id;

        $visitorJsonStr = Crpy::encrypt(json_encode($this)); //加密cookie字符串
        //dump($visitorJsonStr);
        Cookie::set($this->cookieName, $visitorJsonStr);
        Cookie::set('lang', $this->langCode);

    }

    //如果是回访者就调取相关信息
    protected function oldVisitor()
    {
        $cookieStr = Cookie::get($this->cookieName);
        $visitorJsonStr = Crpy::decrypt($cookieStr);
        $values = json_decode($visitorJsonStr);

        //TODO 如果IP找不到国家地址怎么办
        //$this->ip = Request::ip(); //获取IP地址
        $this->ip = '20.228.9.78';
        $visitorCountryInfo = GetIPInfo::getCountryInfo($this->ip);

        $this->name = $values->name;
        $this->country_id = CountryModel::where('COUNTRY_ALPHA2_CODE',$visitorCountryInfo['countryCode'])->value('id');
        $this->lang_id = $values->lang_id;
        $this->langCode = Cookie::get('lang');
        $this->sexual_orientation = $values->sexual_orientation;
        $this->id = $values->id;


    }



    //获取浏览器语言
    protected function getBrowserLang()
    {
        $langCode = explode(',',Request::header('accept-language'))[0];
        $langModel = new Language();
        return ['lang_id' => $langModel->getIdByCode($langCode),'lang_code' => $langCode];

    }

}