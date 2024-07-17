<?php
use app\ExceptionHandle;
use app\Request;
use app\index\common\Visitor;
use app\index\common\Tag;
use app\index\common\Video;
use app\index\common\Language;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,
    'think\app\index\common\Visitor' => Visitor::class,
    'think\app\index\command\Tag' => Tag::class,
    'think\app\index\command\Video' => Video::class,
    'think\app\index\common\Language' => Language::class
];
