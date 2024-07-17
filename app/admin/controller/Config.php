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
use think\facade\View;

class Config extends AdminBase
{
    //配置文件目录
    protected $folder = 'cfg';

    /**
     * 基本配置
     * @return \think\response\View
     */
    public function index()
    {
        $items = [
            'base' => '基础配置',  //key对应模版名称以及配置文件名  value为标题名称
            'upload' => '上传配置',
            //'sms' => '短信配置'
        ];

        $type = $this->request->param('type','base');
        if ( !isset($items[$type]) ) {
            $this->error('配置项不存在');
        }

        if( $this->request->isPost() ) {
            $param = $this->request->post();
            $this->_set($param, $type);
            $this->success('设置成功');
        }

        $data = [];
        $content = '';
        foreach ( $items as $key=>$item ) {
            //各配置文件数据
            $data[$key] = $this->_load($key);

            //各配置文件模版
            $layui_show = $key=='base' ? 'layui-tab-item layui-show' : 'layui-tab-item';
            $content .= '<div class="'.$layui_show.'">' . file_get_contents(app_path() . "view/config/include/".$key.".html") . '</div>';
        }
        //渲染模版内容
        $tpl_content = View::display($content, ['data'=>$data]);

        return view('',compact('items','data','tpl_content'));
    }

    /**
     * 写入配置文件
     * @param $param
     * @param string $filename
     */
    protected function _set($param, $filename="base")
    {
        if( is_array($param) && !empty($param) ) {
            $file = config_path() . $this->folder. "/" . $filename . '.php';
            $str = "<?php\r\nreturn [\r\n";
            foreach ($param as $key=>$val) {
                $str .= "\t'$key' => '$val',";
                $str .= "\r\n";
            }
            $str .= '];';
            file_put_contents($file, $str);
        }
    }

    /**
     * 加载配置文件
     * @param $filename
     * @return array
     */
    protected function _load($filename)
    {
        $data = \think\facade\Config::load($this->folder. "/" . $filename, $filename);
        return $data;
    }
}
