<?php

namespace app\api\validate;

use think\Validate;

class Param extends Validate
{
    protected $rule =   [
        'tag_rows'  => 'number|max:1000',
        'video_rows'   => 'number|max:100',
        'page' => 'number',
        'tag_id' => 'number',
        'rows' => 'number',
        'id' => 'number',
        'search'=>'alphaNum'
    ];

    protected $message  =   [
        'tag_rows.number' => 'rag_rows.error',
        'video_rows.number' => 'video_rows.error',
        'page.number' => 'page.error',
        'tag_id.number' => 'tag_id.error',
        'rows.number' => 'rows.error',
        'id.number' => 'id.error',
        'search.alphaNum' => 'search.error',
        'id.require' => 'id.must',
        'search.require' => 'search.must'
    ];




}