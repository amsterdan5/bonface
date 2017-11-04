<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * 后台基础控制器
 */
class BackBaseController extends BaseController
{
    public function __construct()
    {
        // $this->checkLogin();
    }

    // 检测登录
    public function checkLogin()
    {
        if (!session('uid') || !session('username')) {
            return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        }
    }
}
