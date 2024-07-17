<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\common\model\UploadClassModel;
use app\common\model\UploadFilesModel;

class UploadClass extends AdminBase
{
    public function index()
    {
        $param = $this->request->param();
        $model = new UploadClassModel();
        //构造搜索条件
        if( $param['storage']!='' ) {
            $model = $model->where('storage',$param['storage']);
        }
        if( $param['start_date']!=''&&$param['end_date']!='' ) {
            $model = $model->whereBetweenTime('create_time',$param['start_date'],$param['end_date']);
        }
        $list = $model->order('id desc')->paginate(['query' => $param]);
        return view('',['list'=>$list]);
    }

    public function edit()
    {
        if( $this->request->isPost() ) {
            $param = $this->request->param();
            $result = UploadClassModel::update(['id'=>$param['id'],'name'=>$param['name']]);
            if( $result ) {
                xn_add_admin_log('修改文件分类名称');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id = $this->request->get('id');
        $data = UploadClassModel::find($id);
        return view('form',['data'=>$data]);
    }

    public function add()
    {
        if( $this->request->isPost() ) {
            $param = $this->request->param();
            $result = UploadClassModel::create(['id'=>$param['id'],'name'=>$param['name']]);
            if( $result ) {
                xn_add_admin_log('添加文件分类');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        return view('form');
    }

    /**
     * 删除文件
     */
    public function delete()
    {
        $id = intval($this->request->get('id'));
        !($id>0) && $this->error('参数错误');
        $file_data = UploadClassModel::find($id);
        if( !$file_data ) {
            $this->error('分类不存在');
        }
        UploadFilesModel::destroy($id);
        xn_add_admin_log('删除文件');
        $this->success('删除成功');
    }
}
