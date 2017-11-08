<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
use App\Model\Banner;
use Illuminate\Http\Request;

/**
 * 后台banner控制器
 */
class AdminBannerController extends BackBaseController
{
    protected $request = '';

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    // 保存banner信息
    public function saveBanner()
    {
        $image = $this->request->post('image', '');
        $id    = $this->request->post('id', 0);
        $lang  = $this->request->post('lang', 'cn');

        if (!$image) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::NO_FILE));
        }

        $bannerModel = new Banner();

        // 编辑
        if ($id) {
            if ($bannerModel->editBanner($id, $image, $lang)) {
                return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::BANNER_INFO_ADD_SUCCESS));
            }
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::BANNER_INFO_ADD_FAILED));
        }

        // 不超过6条
        $count = $bannerModel->getBannerCount($lang);
        if ($count === 6) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::BANNER_MAX_SIX));
        }

        // 新增
        if ($bannerModel->addBanner($image, $lang)) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::BANNER_INFO_ADD_SUCCESS));
        }

        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::BANNER_INFO_ADD_FAILED));
    }

    // 删除banner
    public function delBanner()
    {
        $id = $this->request->post('id', 0);

        if (!$id) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::BANNER_ID_LACK));
        }

        $bannerModel = new Banner();
        $count       = $bannerModel->getBannerCount();

        if ($count === 1) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::BANNER_LEAST_ONE));
        }

        if ($bannerModel->delBanner($id)) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::BANNER_DEL_SUCCESS));
        }

        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::BANNER_DEL_FAILED));
    }
}
