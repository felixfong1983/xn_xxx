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
use app\common\model\AuthRuleModel;
use think\helper\Str;
use utils\Data;

class Auth extends AdminBase
{
    public function index()
    {
        $list = AuthRuleModel::order('sort asc, id asc')->select()->toArray();
        $list = Data::tree($list, 'title','id');
        return view('',['list'=>$list])->filter(function($content){
            return str_replace("&amp;emsp;",'&emsp;',$content);
        });
    }

    /**
     * 编辑节点
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit()
    {
        if( $this->request->isPost() ) {
            $param = $this->request->param();
            if ( isset($param['name']) ) {
                $param['name'] = str::snake($param['name']); //转下划线小写
            }
            $result = AuthRuleModel::update($param);
            if( $result ) {
                xn_add_admin_log('编辑权限节点');
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        }
        $id = $this->request->get('id');
        $data = AuthRuleModel::where('id',$id)->find();
        $list = AuthRuleModel::order('sort asc, id asc')->select()->toArray();
        $list = Data::tree($list, 'title','id');
        return view('form',['data'=>$data,'list'=>$list,'pid'=>$data['pid']])->filter(function($content){
            return str_replace("&amp;emsp;",'&emsp;',$content);
        });
    }

    /**
     * 添加节点
     * @return \think\response\View
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add()
    {
        if( $this->request->isPost() ) {
            $param = $this->request->param();
            if ( isset($param['name']) ) {
                $param['name'] = str::snake($param['name']); //转下划线小写
            }
            $result = AuthRuleModel::create($param);
            if( $result ) {
                xn_add_admin_log('添加权限节点');
                $this->success('操作成功');
            } else {
                $this->success('操作失败');
            }
        }
        $list = AuthRuleModel::order('sort asc, id asc')->select()->toArray();
        $list = Data::tree($list, 'title','id');
        return view('form',['list'=>$list,'pid'=>$this->request->get('pid')])->filter(function($content){
            return str_replace("&amp;emsp;",'&emsp;',$content);
        });
    }

    /**
     * 按规则批量添加

     * 例如：
            文章管理|admin/article
            文章列表|admin/article/index;添加|admin/article/add;编辑|admin/article/edit;删除|admin/article/delete
            文章分类|admin/article_class/index;添加|admin/article/add;编辑|admin/article/edit;删除|admin/article/delete
     *
     *      多组数据用回车隔开
     */
    public function addBatch()
    {
        if( $this->request->isPost() ) {
            $param = $this->request->param();
            $content = trim($param['content']);
            if ( empty($content) ) {
                $this->error('请输入权限菜单规则信息');
            }
            $arr = explode(PHP_EOL.PHP_EOL, $content); //多组数据
            foreach ($arr as $group) {
                /*  每组$group的数据格式
                 *  文章管理|admin/article
                    文章列表|admin/article/index;添加|admin/article/add;编辑|admin/article/edit;删除|admin/article/delete
                    文章分类|admin/article_class/index;添加|admin/article/add;编辑|admin/article/edit;删除|admin/article/delete
                */
                $group_arr = explode(PHP_EOL, $group); //再按行数分割数组
                $pid = 0;
                foreach ( $group_arr as $k=>$row ) {
                    /* 每行的数据格式，
                        如第一行：
                        文章管理|admin/article
                    */
                    if ( $k == 0 && strpos($row, '*') !==false ) { //每组数据的第一行的pid为表单传值
                        $row_arr = explode(';', $row); //再 ; 符号分割数组
                        $_pid = 0;
                        foreach ( $row_arr as $j=>$item ) {
                            $item_arr = explode('|', $item);
                            if ( $j==0 ) {
                                $d = AuthRuleModel::create([
                                    'pid' => $param['pid'],
                                    'title' => trim($item_arr[0],'*'),
                                    'name' => $item_arr[1],
                                    'is_menu' => 1,
                                    'icon' => 'layui-icon-app'
                                ]);
                                $_pid = $d['id'];
                                $pid = $d['id'];
                            } else {
                                AuthRuleModel::create([
                                    'pid' => $_pid,
                                    'title' => $item_arr[0],
                                    'name' => $item_arr[1],
                                    'is_menu' => 0
                                ]);
                            }
                        }
                    } else {
                        $row_arr = explode(';', $row); //再 ; 符号分割数组
                        $_pid = 0;
                        foreach ( $row_arr as $j=>$item ) {
                            $item_arr = explode('|', $item);
                            if ( $j==0 ) {
                                $d = AuthRuleModel::create([
                                    'pid' => $pid,
                                    'title' => $item_arr[0],
                                    'name' => $item_arr[1],
                                    'is_menu' => 1,
                                    'icon' => 'layui-icon-app'
                                ]);
                                $_pid = $d['id'];
                            } else {
                                AuthRuleModel::create([
                                    'pid' => $_pid,
                                    'title' => $item_arr[0],
                                    'name' => $item_arr[1],
                                    'is_menu' => 0
                                ]);
                            }
                        }
                    }
                }
            }
            $this->success('操作成功');
        }
        $list = AuthRuleModel::order('sort asc, id asc')->select()->toArray();
        $list = Data::tree($list, 'title','id');
        return view('add_batch',['list'=>$list,'pid'=>$this->request->get('pid')])->filter(function($content){
            return str_replace("&amp;emsp;",'&emsp;',$content);
        });
    }

    /**
     * 删除节点
     */
    public function delete()
    {
        $id = intval($this->request->get('id'));
        !($id>0) && $this->error('参数错误');
        $child_count = AuthRuleModel::where('pid',$id)->count();
        $child_count && $this->error('请先删除子节点');
        AuthRuleModel::destroy($id);
        xn_add_admin_log('删除权限节点');
        $this->success('删除成功');
    }

    /**
     * 排序
     */
    public function sort()
    {
        $param = $this->request->post();
        foreach ($param as $k => $v) {
            $v=empty($v) ? null : $v;
            AuthRuleModel::where('id', $k)->save(['sort'=>$v]);
        }
        $this->success('排序成功', url('index'));
    }
}
