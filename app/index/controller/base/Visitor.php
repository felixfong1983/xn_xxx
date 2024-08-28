<?php

namespace app\index\controller\base;
use app\api\common\Country;
use app\api\common\Language;
use app\common\model\Visitor as VisitorModel;
use app\common\model\VisitorPath;
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

    //相关访问路径
    protected $controller;
    protected $action;
    protected $param;



    public function __construct()
    {

        $this->cookieName = Config::get('Cookie.visitor_info');
        $this->getVisitorCountryAndLanguage(); //国家和IP会变，每次访问都需要更新
        if(Cookie::has($this->cookieName))
        {
            $this->oldVisitor();
        }else{
            $this->newVisitor();
        }
        $this->visitorPath();
//        var_dump($this);
        return $this;
    }

    //用户每次访问更新他的IP和国家信息
    protected function getVisitorCountryAndLanguage() : bool
    {
        $this->ip = Request::ip(); //获取IP地址
        $visitorCountryInfo = GetIPInfo::getCountryInfo($this->ip);//通过IP查国家信息
//        dump($visitorCountryInfo);
        $country = new Country();
        $this->country_id = $country->getIDByCountryCode2($visitorCountryInfo['countryCode']);//所在国家信息

        return true;
    }

    //如果是新访问者，就生成信息存库
    protected function newVisitor()
    {

//        $language = new Language();

        $this->lang_id = 24; //固定为越南语
        $this->langCode = 'vi'; //所用语言信息

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

    //记录用户的每次访问数据
    public function visitorPath()
    {
        $data = [];
        $data['visitor_name'] = $this->name;
        $data['visitor_id'] = $this->id;
        $data['controller'] = Request::controller();
        $data['action'] = Request::action();
        $data['param'] = serialize(Request::param());
        $data['time'] = date('Y-m-d H:i:s');
        $data['ip'] = $this->ip;
        $data['country_id'] = $this->country_id;
        VisitorPath::create($data);
        //todo  以后可以做对列
    }





}