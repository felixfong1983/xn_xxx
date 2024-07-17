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

class AdminLogModel extends Model
{
    protected $name = 'admin_log';

    protected $autoWriteTimestamp = true;

    public function admin()
    {
        return $this->belongsTo(AdminModel::class,'admin_id');
    }
}