<?php
use app\ExceptionHandle;
use app\Request;
use app\api\common\Visitor;
use app\api\common\Tag;
use app\api\common\Video;
use app\api\common\Language;
use app\api\controller\Error;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
    'think\app\api\common\Visitor' => Visitor::class,
    'think\app\api\command\Tag' => Tag::class,
    'think\app\api\command\Video' => Video::class,
    'think\app\api\common\Language' => Language::class,
//    'think\exception\Handle' => Error::class,
];
