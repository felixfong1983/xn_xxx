<?php

namespace app\process\controller;

use app\common\model\Tag;
use app\common\model\Video;
use app\common\model\Xvideos;
use think\facade\Db;

class InsertData extends ProcessBase
{
    //执行行插入标签
    public function insert_tags()
    {
        //已执行数据 记录ID  300
        $XvideosModel = new Xvideos();
        $data = $XvideosModel->get_data(400,1000);
        $tagModel = new Tag();
        $tags = [];
//        p($data);

        foreach ($data as $key => $value)
        {
            $a = explode(',',$value['tag']);
            $tags = array_merge($tags,$a);
        }
        echo count($tags);
        echo '<hr />';
        $tags = array_unique($tags);
        echo count($tags);
        p($tags);
        $insertData = [];
        //INSERT IGNORE INTO xn_tag (name) VALUES ('tag_name');
        //-- 这条插入将被忽略，不会插入重复的 email
        $num = 0;
        foreach ($tags as $k => $tv)
        {
            $tv = trim($tv);
            $count = $tagModel->where('name',$tv)->count(); //判断是否存在 避免重复插入
            if($count == 0)
            {
                try {
                    $tagModel->insert(['name' => $tv,'type' => 3]);
                    $num += 1;
                }catch (Exception $e){
                    dump($e->getMessage());
                }
            }
        }
        echo '本次插入' . $num . '条标签';

    }

    public function insert_videos()
    {
        $xvideosModel = new Xvideos(); //源视频表
        $videoModel = new Video();  //要插入的表
        $tagModel = new Tag();  //标签表
        //最后ID   310
        $data = $xvideosModel->get_data(600,200);
        p($data);
        $num = 0;
        foreach ($data as $k => $v)
        {
            $insertData['title'] = $v['title'];
            $insertData['video_id'] = $v['video_id'];
            $insertData['img'] = trim($v['img']);
            $insertData['cover_video'] = trim($v['cover_mp4']);
            $insertData['src'] = trim($v['video_url']);
            $insertData['definition'] = trim($v['clarity']);
            $insertData['length'] = trim($v['duration']);

            //通过标题判断视频是否已经存在
            $count = $videoModel->where('title',$insertData['title'])->count();
            if($count == 0)
            {
                try {
                    Db::startTrans();
                    Db::name('video')->insert($insertData);
                    $id = Db::name('video')->getLastInsID();
                    echo $id;
                    $tags = explode(',',$v['tag']);
                    foreach ($tags as $tag)
                    {
                        $tagId = $tagModel->getId(trim($tag));
                        $videoTagInsertData = ['video_id' => $id, 'tag_id' => $tagId];
                        Db::name('video_tag_access')->insert($videoTagInsertData);
                    }
                    Db::commit();
                    $num += 1;

                }catch (\Exception $e){
                    Db::rollback();
                    dump($e->getMessage());
                }
            }else
            {
                echo '此视频已添加';
            }

        }
        echo '添加了' . $num .'条视频数据';

    }
}