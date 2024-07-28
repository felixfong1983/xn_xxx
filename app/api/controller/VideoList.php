<?php

namespace app\api\controller;

use app\api\controller\base\Base;
use app\api\validate\Param;
use think\exception\ValidateException;
use think\response\Json;

class VideoList extends Base
{
    
    //标签页
    public function tag_videos_list() : Json
    {
        try {
            $param = $this->request->get();
            validate(Param::class)->check($this->request->get());
            $videoList = app('app\api\common\Video')
                ->getVideoList($param['tag_id'],$param['video_rows']);
            $config = app('app\api\common\Config')->SeoData($videoList);

            return $this->success(['videoList' => $videoList,'config' => $config]);
        }catch (ValidateException $e){
            return $this->error($e->getError());
        }
//        catch (\Exception $e){
//            return $this->error($e->getMessage());
//        }

    }

    //搜索功能
    public function search() : Json
    {
        try {
            $param = $this->request->get();
            $rows = isset($param['rows']) ? (int)$param['rows'] : 30;
            validate(Param::class)->check($param);//验证搜索词  重要
            $result = app('app\api\common\Search')->search($param['search'],$rows);
            if(is_numeric($result)){  //如果查了已经有了这个tag 就直接通过标签ID查询
                $videoList = app('app\api\common\Video')
                    ->getVideoList($result,$rows);
                $config = app('app\api\common\Config')->SeoData($videoList);
                return $this->success(['videoList' => $videoList,'config' => $config]);
            }else{
                return $this->success(['videoList' => $result]);
            }
        }catch (ValidateException $e)
        {
            return $this->error($e->getError());
        }

    }

}