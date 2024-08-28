<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;



//Route::get('/', 'api/index/index');
Route::get('/', 'index/index/init');
Route::get('new-<page>', 'index/index/init');
Route::get('t-<tag_name>-<tag_id>', 'VideoList/tag_videos_list');
Route::get('video-<id>-<title>', 'index/Video/video_detail');
Route::get('lang','index/index/chang_language');
Route::get('search','index/VideoList/search');
Route::get('like','index/index/like_or_dislike');



