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

class AdminModel extends Model
{
    protected $name = 'admin';

    protected $autoWriteTimestamp = true;

    public function authGroupAccess()
    {
        return $this->belongsToMany(AuthGroupModel::class, AuthGroupAccessModel::class, 'group_id', 'admin_id');
    }
}