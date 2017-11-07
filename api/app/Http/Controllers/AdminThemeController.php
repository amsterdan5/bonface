<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
use App\Model\Config;
use Illuminate\Http\Request;

/**
 * 后台产品控制器
 */
class AdminThemeController extends BackBaseController
{
    protected $request = '';

    // private static $themeList = [
    //     'default' => '默认',
    // ];

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    /**
     * 主题列表
     */
    public function themeList()
    {
        $themes = $this->getAllTheme();
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::SUCCESS), $themes);
    }

    /**
     * 更换主题
     */
    public function changeTheme()
    {
        $theme = $this->request->post('theme', '');
        if (!$theme) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::THEME_IS_NOT_SELECT));
        }

        $themes = $this->getAllTheme();
        if (!array_key_exists($theme, $themes)) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::UNKONW_THEME));
        }

        $configModel = new Config();
        if ($configModel->changeConfig('theme', $theme)) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::THEME_CHANGE_SUCCESS));
        }
        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::THEME_CHANGE_FAILED));
    }

    private function getAllTheme()
    {
        $themes     = [];
        $theme_list = config('theme.list');
        foreach ($theme_list as $key => $theme) {
            if (file_exists(CSS_PATH . '/' . $key . '.css')) {
                $themes[$key] = $theme;
            }
        }
        return $themes;
    }
}
