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
use think\facade\Session;

class Index extends AdminBase
{
    protected $noAuth = ['index','home','setThemes'];
    public function index()
    {
        // 分配菜单数据
        $auth = new AuthRuleModel();
        $menu = $auth->getMenu();
        foreach ($menu as $k => $v) {
            if ( $this->checkMenuAuth($v['name']) ) {
                foreach ($v['_data'] as $m => $n) {
                    if( $this->checkMenuAuth($n['name'])!==true ){
                        unset($menu[$k]['_data'][$m]);
                    }
                }
            }else{
                // 删除无权限的菜单
                unset($menu[$k]);
            }
        }
        $admin_data = Session::get('admin_auth');

        //当前页
        $p = $this->request->get('p');
        if( !empty($p) ) {
            $_t = explode('bcid=', $p);
            $bcid = explode('_', $_t[1]);
            $default_url = $p;
        } else {
            $bcid = [];
            $default_url = url('home');
        }

        //是否装了curd插件
        $curd_path = app_path() . 'controller/curd/Curd.php';
        if( file_exists($curd_path) ) {
            $is_curd = true;
        } else {
            $is_curd = false;
        }

        return view('', compact('menu','admin_data','p','bcid','default_url','is_curd'));
    }

    //设置网站主题风格
    public function setThemes()
    {
        $theme = $this->request->param('theme');
        $param = ['theme'=>$theme];
        if( is_array($param) && !empty($param) ) {
            $file = config_path() . "cfg/theme.php";
            $str = "<?php\r\nreturn [\r\n";
            foreach ($param as $key=>$val) {
                $str .= "\t'$key' => '$val',";
                $str .= "\r\n";
            }
            $str .= '];';
            file_put_contents($file, $str);
        }
    }

    public function home()
    {
        if (function_exists('gd_info')) {
            $gd = gd_info();
            $gd = $gd['GD Version'];
        } else {
            $gd = "不支持";
        }
        $server_info = array(
            '操作系统' => PHP_OS,
            'IP端口' => $_SERVER['SERVER_ADDR'] . ':' . $_SERVER['SERVER_PORT'],
            'PHP运行方式' => php_sapi_name(),
            '当前PHP版本' => PHP_VERSION,
            '最低PHP版本' => 'PHP >= 8.0.0',
            '上传附件限制' => ini_get('upload_max_filesize'),
            '执行时间限制' => ini_get('max_execution_time') . "秒",
            '剩余空间' => round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M',
            '服务器时间' => date("Y年n月j日 H:i:s"),
            '北京时间' => gmdate("Y年n月j日 H:i:s", time() + 8 * 3600),
        );
        return view('',['server_info'=>$server_info,'gd'=>$gd]);
    }

    public function about()
    {
        return view();
    }
}
