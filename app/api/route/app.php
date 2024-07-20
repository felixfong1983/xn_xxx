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
Route::get('home', 'api/index/init');
Route::get('video_list', 'api/index/tag_videos_list');
Route::get('play', 'api/index/video_detail');
Route::get('lang','api/index/chang_language');
Route::get('search','api/index/search');



