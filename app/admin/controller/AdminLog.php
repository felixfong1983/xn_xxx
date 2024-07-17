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
use app\common\model\AdminLogModel;
use think\facade\Db;

class AdminLog extends AdminBase
{
    public function index()
    {
        $param = $this->request->param();
        $model = new AdminLogModel();
        if( $param['start_date']!=''&&$param['end_date']!='' ) {
            $start_date = $param['start_date'].' 00:00:00';
            $end_date = $param['end_date'].' 23:59:59';
            $model = $model->whereBetweenTime('create_time',$start_date,$end_date);
        }
        $list = $model->order('id desc')->paginate(['query' => $param,'list_rows'=>$this->request->param('limit',15)]);
        return view('',['list'=>$list]);
    }

    /**
     * 清除日志
     */
    public function clear()
    {
        $model = Db::name('admin_log');
        $day = $this->request->param('day/d');
        if( $day > 0 ) {
            $model = $model->whereTime('create_time', '<=', strtotime(date('Y-m-d',time()-$day*86400)) );
            $result = $model->delete();
        } else {
            $result = $model->delete(true);
        }
        if( $result ) {
            xn_add_admin_log('清除日志');
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    public function delete()
    {
        $id = $this->request->param('id');
        AdminLogModel::destroy($id);
        xn_add_admin_log('删除日志');
        $this->success('删除成功');
    }
}
