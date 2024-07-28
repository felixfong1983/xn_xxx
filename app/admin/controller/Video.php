<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\Video as VideoModel;
use app\common\service\VideoLink;

class Video extends AdminBase
{

    public function index()
    {
        $list = VideoModel::paginate(['list_rows'=>$this->request->param('limit',15)]);
//        dump($list);
        return view('index',['list' => $list]);
    }

    public function add()
    {

    }


    //视频详细信息
    public function info()
    {

        $id = $this->request->get('id');

        $videoInfo = VideoModel::find($id);
        $tags = [];
        foreach ($videoInfo->tag as $k => $tag)
        {
            $tags[$k]['name'] = $tag->name;
            $tags[$k]['id'] = $tag->id;
        }

        //获取视频播放地址
        $playLink = VideoLink::getPlayLink(['play_page' =>$videoInfo->play_page]);
//        dump($playLink);
        $videoInfo->src = $playLink['data']['url'] ? $playLink['data']['url'] : 0;
        $videoInfo->linkStatus = VideoLink::isUrlValid($playLink['data']['url']) ? 'success' : 'error';

        return view('from',['videoInfo' => $videoInfo,'tags' => $tags]);
    }

    //修改视频上下架
    public function edit_is_online()
    {
        if($this->request->isPost())
        {
            $param = $this->request->param();
            $id = $param['id'];
            $is_online = $param['is_online'] == 1 ? 2 : 1;
            $result = VideoModel::update(['is_online'=>$is_online,'release_time' => date('y-m-d H:i:s',time())],['id'=>$id]);
            if($result)
            {
                $this->success('操作成功');
            }else
            {
                $this->error('操作失败');
            }
        }
    }



    //修改视频标题
    public function change_title()
    {
        //todo
        $param = $this->request->param();
        $this->success('todo');
    }



}