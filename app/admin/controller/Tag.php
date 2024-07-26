<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\Language as LanguageModel;
use app\common\model\Tag as TagModel;
use app\common\model\TagLangAccess;
use app\common\model\VideoTagAccess;
use think\Facade\Db;
use think\Exception;


class Tag extends AdminBase
{
    public function index()
    {
        $tagDataObj = TagModel::field('id,name,clicks,type')->paginate(['list_rows'=>$this->request->param('limit',15)]);
        $page = $tagDataObj->render(); //分页信息
        $tagData = $tagDataObj->toArray();
        foreach ($tagData['data'] as $v)
        {
            $tagIds[] = $v['id'];
        }
        $langTagAccess = TagLangAccess::field('tag_id,lang_id')->where('tag_id','in',$tagIds)->select()->toArray();
        foreach ($langTagAccess as $accessV)
        {
            $langIds[] = $accessV['lang_id'];
            foreach ($tagData['data'] as $k2 => $v2)
            {
                if($v2['id'] == $accessV['tag_id']){
                    $tagData['data'][$k2]['lang_id'][] = $accessV['lang_id'];
                }
            }
        }
        $langIds = !empty($langIds) ? array_unique($langIds) :[];

        $langData = LanguageModel::field('id,iso_code')->where('id','in',$langIds)->select()->toArray();

        foreach ($tagData['data'] as $k3 => $v3)
        {

            foreach ($v3['lang_id'] as $v4)
            {
                foreach($langData as $v5){

                    if($v5['id'] == $v4){
                        $tagData['data'][$k3]['lang_code'][] = $v5['iso_code'];
                    }
                }

            }
        }

        foreach ($tagData['data'] as $k6 => $v6)
        {
            foreach($v6['lang_id'] as $k7 => $v7)
            {
                $tagData['data'][$k6]['lang_info'][$k7]['id'] = $v7;
                $tagData['data'][$k6]['lang_info'][$k7]['code'] = $tagData['data'][$k6]['lang_code'][$k7];
            }
            unset($tagData['data'][$k6]['lang_code']);
            unset($tagData['data'][$k6]['lang_id']);
        }

//        p($tagData);
        return view('index',['list' => $tagData,'page'=>$page]);
    }

    //支持的语言列表
    public function langList()
    {
        $tagId = $this->request->param('tag_id');
        $accessData = TagLangAccess::where(['tag_id' => $tagId])->column('lang_id');
        $languageModel = new LanguageModel();
        $data = $languageModel->getAllLanguage();
        return view('lang_list',['data'=>$data,'access'=>$accessData,'tagId'=>$tagId]);
    }


    //修改标签语言
    public function editTagLang()
    {
        if ($this->request->isPost())
        {
            $param = $this->request->param();
//            p($param);
            foreach ($param['language'] as $k => $v)
            {
                $insertData[$k] = ['tag_id'=>$param['tag_id'],'lang_id'=>$v];
            }
//            p($insertData);
            $num = 0;
            foreach ($insertData as $k1 => $v1)
            {
                $count = TagLangAccess::where(['tag_id' => $v1['tag_id'],'lang_id' => $v1['lang_id']])->count();
                if($count == 0){
                    try {
                        TagLangAccess::create($v1,['tag_id','lang_id']);
                        $num += 1;
                    }catch (Exception $exception){
                        $this->error($exception->getMessage());
                    }
                }
            }
            $this->success("成功修改了{$num}条数据");
        }

    }

    //删除标签下的一个语言
    public function delTagLang()
    {
        if ($this->request->isGet()){
            try {
                TagLangAccess::destroy($this->request->param());
                $this->success('删除成功');
            }catch (Exception $exception)
            {
                $this->error($exception->getMessage());
            }
        }
    }
    //删除一个标签
    public function deleteTag()
    {
        if ($this->request->isGet()){
            $id = $this->request->param();
            Db::startTrans();
            try {
                TagModel::destroy($id); //删除标签数据
                TagLangAccess::destroy(['tag_id' => $id]); //删除语言和标签的关联表数据
                VideoTagAccess::destroy(['tag_id' => $id]);//删除视频和标签的关联表数据
                Db::commit();
                $this->success('删除成功','','',3);
            }catch (Exception $exception)
            {
                Db::rollback();
                $this->error($exception->getMessage());
            }
        }
    }

}