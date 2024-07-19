<?php

namespace app\api\common;
use app\api\common\Country;
use app\common\model\Country as CountryModel;
use app\common\service\Crpy;
use app\common\service\GetIPInfo;
use app\common\service\RandomName;
use think\facade\Config;
use think\facade\Cookie;
use think\facade\Request;
use app\common\model\Visitor as VisitorModel;

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
        $this->getVisitorCountryAndLanguage(); //国家和IP会变，每次访问都需要更新
        if(Cookie::has($this->cookieName))
        {
            $this->oldVisitor();
            return $this;
        }
        $this->newVisitor();

        return $this;
    }

    //用户每次访问更新他的IP和国家信息
    protected function getVisitorCountryAndLanguage()
    {
        $this->ip = Request::ip(); //获取IP地址
        $visitorCountryInfo = GetIPInfo::getCountryInfo($this->ip);//通过IP查国家信息
        //dump($visitorCountryInfo);
        $country = new Country();
        $this->country_id = $country->getIDByCountryCode2($visitorCountryInfo['countryCode']);//所在国家信息

        return true;
    }

    //如果是新访问者，就生成信息存库
    protected function newVisitor()
    {

        $language = new Language();

        $this->lang_id = $language->langId;
        $this->langCode = $language->langCode; //所用语言信息

        $this->name = RandomName::getVisitorName(); //随机生成用户名
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
        Cookie::set($this->cookieName, $visitorJsonStr); //设置cookie
        Cookie::set('lang', $this->langCode);

    }

    //如果是回访者就调取相关信息
    protected function oldVisitor()
    {
        $cookieStr = Cookie::get($this->cookieName);
        $visitorJsonStr = Crpy::decrypt($cookieStr);
        $values = json_decode($visitorJsonStr);

        //国家和IP会变
        $this->name = $values->name;
        $this->lang_id = $values->lang_id;
        $this->langCode = Cookie::get('lang');
        $this->sexual_orientation = $values->sexual_orientation;
        $this->id = $values->id;

    }


}