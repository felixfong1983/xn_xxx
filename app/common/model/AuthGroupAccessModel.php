<?php
// +----------------------------------------------------------------------
// | 小牛Admin
// +----------------------------------------------------------------------
// | Website: www.xnadmin.cn
// +----------------------------------------------------------------------
// | Author: dav <85168163@qq.com>
// +----------------------------------------------------------------------

namespace app\common\model;
use think\Model;
use think\model\Pivot;

class AuthGroupAccessModel extends Pivot
{
    protected $name = 'auth_group_access';
}