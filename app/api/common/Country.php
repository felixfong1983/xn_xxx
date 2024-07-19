<?php

namespace app\api\common;

use app\common\model\Country as CountryModel;

class Country
{
    protected CountryModel $countryModel;
    public function __construct()
    {
        $this->countryModel = new CountryModel();
    }


    public function getIDByCountryCode2($countryCode2)
    {
        $id = $this->countryModel->getIDByCountryCode2($countryCode2);
        return $id ? $id : 233; //有就有，没有就默认美国
    }



}