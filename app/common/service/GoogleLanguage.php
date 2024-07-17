<?php

namespace app\common\service;
use Google\Cloud\Translate\V2\TranslateClient;
class GoogleLanguage
{
    /*
     * 所有语种
     * af,ak,am,ar,as,ay,az,be,bg,bho,bm,bn,bs,ca,ceb,ckb,co,cs,cy,da,de,doi,
     * dv,ee,el,en,eo,es,et,eu,fa,fi,fr,fy,ga,gd,gl,gn,gom,gu,ha,haw,he,hi,hmn,
     * hr,ht,hu,hy,id,ig,ilo,is,it,iw,ja,jv,jw,ka,kk,km,kn,ko,kri,ku,ky,la,lb,lg,
     * ln,lo,lt,lus,lv,mai,mg,mi,mk,ml,mn,mni-Mtei,mr,ms,mt,my,ne,nl,no,nso,ny,om,
     * or,pa,pl,ps,pt,qu,ro,ru,rw,sa,sd,si,sk,sl,sm,sn,so,sq,sr,st,su,sv,sw,ta,te,
     * tg,th,ti,tk,tl,tr,ts,tt,ug,uk,ur,uz,vi,xh,yi,yo,zh,zh-CN,zh-TW,zu,
     * */
    public TranslateClient $googleObj;
    const KEY = 'AIzaSyDYy2_6ZX5WxGINa00-nvtGCk9WTAvXWYM';
    public function __construct()
    {
        $this->googleObj = new TranslateClient(['key' => self::KEY]);
    }

    /*
     *  检测语言语种
     * */
    public function getLanguageCode($text)
    {
        $res = $this->googleObj->detectLanguage($text);
        return $res['languageCode'];
    }

    //翻译语言
    public function transLanguage($str,$languageCode)
    {
        $result = $this->googleObj->translate($str, [
            'target' => $languageCode
        ]);
        return $result['text'];
    }

    //获取所有语言
    public function getAllLanguageCode() : array
    {
        return $this->googleObj->languages();
    }

}