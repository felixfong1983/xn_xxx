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

class UploadFiles extends AdminBase
{
    protected $noAuth = ['upload','select'];

    public function index()
    {
        $param = $this->request->param();
        $model = new UploadFilesModel();
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

    public function select()
    {
        $class_id = intval($this->request->get('class_id'));
        $model = new UploadFilesModel();
        if( $class_id>0 ) {
            $model = $model->where('class_id',$class_id);
        }
        $keyword = $this->request->get('keyword');
        if( $keyword != '' ) {
            $model = $model->whereLike('file_name', '%'. $keyword . '%');
        }
        $list = $model->where('app',1)->where('extension','in','jpg,jpeg,png,gif,bmp')->order('id desc')->paginate(['list_rows'=>24,'query' => $this->request->param()]);
        $num = intval($this->request->get('num'));
        //分类
        $classList = UploadClassModel::select();
        return view('', compact('list','num','classList','class_id'));
    }

    //移动图片到分类
    public function move()
    {
        if( $this->request->isPost() ) {
            $id = $this->request->param('id');
            $class_id = $this->request->param('class_id',0);
            $model = new UploadFilesModel();
            $result = $model->whereIn('id', $id)->update(['class_id'=>$class_id]);
            if( $result ) {
                $this->success('操作成功');
            } else {
                $this->success('操作失败');
            }
        }
        $classList = UploadClassModel::select();
        return view('', compact('classList'));
    }

    /**
     * 删除文件
     */
    public function delete()
    {

        $model = new UploadFilesModel();
        $id = $this->request->param('id');
        if ( is_array($id) ) {
            $files = $model->whereIn('id', $id)->select();
            if ( !$files ) {
                $this->error('文件不存在');
            }
            foreach ( $files as $file ) {
                //删除服务器上的物理文件
                $model->delStorageFile($file->storage, $file->url);
                $model->destroy($file->id);
            }
        } else {
            $file = $model->where('id', $id)->find();
            $model->delStorageFile($file->storage, $file->url);
            $model->destroy($file->id);
        }
        xn_add_admin_log('删除文件');
        $this->success('删除成功');
    }

    /**
     * 文件上传
     * @return \think\response\Json
     */
    public function upload()
    {
        $model = new UploadFilesModel();
        $folder_name = $this->request->param('folder_name/s','file');
        $result = $model->upload($folder_name);
        return json($result);
    }
}
