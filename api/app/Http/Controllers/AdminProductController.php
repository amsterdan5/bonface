<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
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
        $this->middleware('auth');
        $this->request = $request;
    }

    // 保存产品信息
    public function saveProduct()
    {
        $name  = $this->request->post('name', '');
        $image = $this->request->post('image', '');
        $desc  = $this->request->post('desc', '');
        $id    = $this->request->post('id', 0);

        if (!$name || !$image) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_LACK));
        }

        $productModel = new Product();

        // 编辑
        if ($id) {
            if ($productModel->editProduct($id, $name, $image, $desc)) {
                return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_ADD_SUCCESS));
            }
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_INFO_ADD_FAILED));
        }

        // 新增
        if ($productModel->addProduct($name, $image, $desc)) {
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
