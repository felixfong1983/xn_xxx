<?php

namespace app\common\model;

use think\Model;

class Country extends Model
{
    //通过国家ALPHA2_CODE获取ID
    public function getIDByCountryCode2($countryCode2)
    {
        return $this->field('id')->where('COUNTRY_ALPHA2_CODE', $countryCode2)->value('id');
    }



}