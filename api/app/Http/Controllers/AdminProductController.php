<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
use App\Model\Cates;
use App\Model\Product;
use Illuminate\Http\Request;

/**
 * 后台产品控制器
 */
class AdminProductController extends BackBaseController
{
    protected $request = '';

    public function __construct(Request $request)
    {
        $this->middleware('auth', ['except' => 'saveProductLine']);
        $this->request = $request;
    }

    // 保存产品封面图
    public function saveProductLine()
    {
        $image     = $this->request->post('image', '');
        $web_image = $this->request->post('web_image', '');

        if (!$image || !$web_image) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::NO_FILE));
        }

        $id = $this->request->post('id', 0);

        $catesModel = new Cates();

        if ($id) {
            if ($catesModel->editCates($id, $image, $web_image)) {
                return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::PRODUCT_LINE_ADD_SUCCESS));
            }
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_LINE_ADD_FAILED));
        }

        $id = $catesModel->addCates($image, $web_image);
        if ($id) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::PRODUCT_LINE_ADD_SUCCESS), ['id' => $id]);
        }
        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_LINE_ADD_FAILED));
    }

    // 保存产品信息
    public function saveProduct()
    {
        $name         = $this->request->post('name', '');
        $image        = $this->request->post('image', '');
        $web_image    = $this->request->post('web_image', '');
        $detail_image = $this->request->post('detail_image', '');
        $desc         = $this->request->post('desc', '');
        $lang         = $this->request->post('lang', 'cn');
        $cid          = $this->request->post('cid', 0);
        $id           = $this->request->post('id', 0);

        if (!$name || !$image || !$web_image || !$detail_image || !$cid) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_LACK));
        }

        $productModel = new Product();

        // 编辑
        if ($id) {
            if ($productModel->editProduct($id, $name, $image, $web_image, $detail_image, $desc, $lang, $cid)) {
                return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_ADD_SUCCESS));
            }
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_ADD_FAILED));
        }

        // 新增
        if ($productModel->addProduct($name, $image, $web_image, $detail_image, $desc, $lang, $cid)) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_ADD_SUCCESS));
        }

        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_ADD_FAILED));
    }

    // 删除产品
    public function delProduct()
    {
        $id = $this->request->post('id', 0);

        if (!$id) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_ID_LACK));
        }

        $productModel = new Product();
        if ($productModel->delProduct($id)) {
            return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::PRODUCT_DEL_SUCCESS));
        }

        return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_DEL_FAILED));
    }
}
