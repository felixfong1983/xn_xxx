<?php

namespace app\index\controller;

use app\index\controller\base\Base;
use app\api\validate\Param;
use think\exception\ValidateException;
use think\response\Json;

class VideoList extends Base
{
    
    //标签页
    public function tag_videos_list($tag_name,$tag_id)
    {
        try {

            $tags = app('app\api\common\Tag')
                ->getTags($this->visitor->lang_id,$this->request->get('tag_rows',30));

            $videoList = app('app\api\common\Video')
                ->getVideoList($tag_id,30);
            foreach ($videoList['data'] as $k => $video)
            {
                $videoList['data'][$k]['mp4'] = $this->convertVideoSrc($video['img']);
                $videoList['data'][$k]['url'] = $this->titleToUrl($video['title']);
            }
            $config = app('app\api\common\Config')->SeoData($videoList);
            $data = [
                'videoList' => $videoList,
                'config' => $config,
                'tags' => $tags,
            ];

//            dump($videoList);
            return $this->view_success('video_list',$data);
        }catch (ValidateException $e){
            return $this->view_error('404',$e->getError());
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