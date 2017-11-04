<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;

/**
 * index
 */
class IndexController extends Controller
{
    public function __construct()
    {

    }
    public function tt()
    {
        return jsonAjax(StatusNo::SUCCESS, 'test', ['dd' => 'ok']);
    }
}
