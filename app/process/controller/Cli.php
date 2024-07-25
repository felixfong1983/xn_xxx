<?php

namespace app\process\controller;

use think\Facade\Console;

class Cli
{
    public function index()
    {
        $commonds =Console::doRun('php -v');
        dump($commonds);
    }
}