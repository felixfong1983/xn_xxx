<?php

namespace app\index\controller;


use app\index\controller\base\Base;
use app\api\validate\Param;
use app\common\model\Language;
use think\Exception;
use think\exception\ValidateException;
use think\facade\Cookie;


class Index extends Base
{


    //主页信息
    public function init($page=1)
    {
//        echo $page;

//            validate(Param::class)->check($this->request->get());
        $tags = app('app\api\common\Tag')
            ->getTags($this->visitor->lang_id,$this->request->get('tag_rows',30));

        //dump($tags);
        $videoList = app('app\api\common\Video')
            ->getBestVideoList($this->request->get('video_rows',50));
        //dump($videoList);
        foreach ($videoList['data'] as $k => $video)
        {
            $videoList['data'][$k]['mp4'] = $this->convertVideoSrc($video['img']);
            $videoList['data'][$k]['url'] = $this->titleToUrl($video['title']);
        }

//        dump($videoList);
        $configObj = app('app\api\common\Config');
        $config = $configObj->getWebConfigByLangId($this->visitor->lang_id);
        $config['logo'] = './logo.png';  //todo 这个图片临时的

        $data = [
            'videoList' => $videoList,
            'tags' => $tags,
            'config' => $config,
        ];
//        dump($data);

        return $this->view_success('index',$data);


    }





    //访问者点赞或点踩
    public function like_or_dislike() : Json
    {
        try {
            $param = $this->request->param();
            validate(Param::class)->check($param);
            $id = $param['id'];
            $like =  intval($param['like']) === 1 ? 1 : 0;
            $result = app('app\api\common\Video')->likeOrDislike($id,$like);
            if($result) return $this->success(['code' => 200]);
            return $this->error(['code' => 400]);
        }catch(ValidateException $e)
        {
            return $this->error($e->getError());
        }


    }







}