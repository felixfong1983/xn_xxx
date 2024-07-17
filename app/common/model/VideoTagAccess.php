<?php
declare (strict_types = 1);

namespace app\common\model;

use think\model\Pivot;

/**
 * @mixin \think\Model
 */
class VideoTagAccess extends Pivot
{
    //因为think框架不用加表前缀  加了会报错  所以重定义表名
    protected $name = 'video_tag_access';
}
