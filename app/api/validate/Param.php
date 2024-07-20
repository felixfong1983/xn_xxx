<?php

namespace app\api\validate;

use think\Validate;

class Param extends Validate
{
    protected $rule =   [
        'tag_rows'  => 'number',
        'video_rows'   => 'number',
        'page' => 'number',
        'tag_id' => 'number',
        'rows' => 'number',
        'id' => 'number',
    ];

    protected $message  =   [
        'tag_rows.number' => 'rag_rows.error',
        'video_rows.number' => 'video_rows.error',
        'page.number' => 'page.error',
        'tag_id.number' => 'tag_id.error',
        'rows.number' => 'rows.error',
        'id.number' => 'id.error',
    ];
}