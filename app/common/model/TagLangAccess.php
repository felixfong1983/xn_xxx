<?php
declare (strict_types = 1);

namespace app\common\model;

use think\model\Pivot;

/**
 * @mixin \think\Model
 */
class TagLangAccess extends Pivot
{
    //
    protected $name = 'tag_lang_access';
}
