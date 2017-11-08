<?php

namespace App\Http\Controllers;

use App\Libs\StatusNo;
use App\Model\Banner;
use App\Model\Config;
use App\Model\Product;
use Illuminate\Http\Request;

/**
 * 用户端控制器
 */
class UserController extends Controller
{
    protected $request = '';
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // banner 列表
    public function bannerList()
    {
        $lang         = $this->request->get('lang', 'cn');
        $bannerModel  = new Banner();
        $banner_lists = $bannerModel->getBanner($lang);
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::SUCCESS), [$banner_lists]);
    }

    // 产品系列
    public function productLine()
    {
        $lang          = $this->request->get('lang', 'cn');
        $productModel  = new Product();
        $product_lists = $productModel->getProductList($lang);
        $product_lists = empty($product_lists) ? [] : [$product_lists];
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::SUCCESS), $product_lists);
    }

    // 产品列表
    public function productList()
    {
        $lang          = $this->request->get('lang', 'cn');
        $productModel  = new Product();
        $product_lists = $productModel->getProductList($lang);
        $product_lists = empty($product_lists) ? [] : [$product_lists];
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::SUCCESS), $product_lists);
    }

    // 产品详情
    public function productDetail()
    {
        $id = $this->request->get('id', 0);
        if (!$id) {
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::PRODUCT_ID_LACK));
        }

        $productModel   = new Product();
        $product_detail = $productModel->getProductDetail($id);
        $product_detail = empty($product_detail) ? [] : [$product_detail];
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::SUCCESS), $product_detail);
    }

    // 获取当前主题
    public function getTheme()
    {
        $configModel = new Config();
        $theme       = $configModel->getConfigByType('theme');
        return jsonAjax(StatusNo::SUCCESS, StatusNo::getStatusMsg(StatusNo::SUCCESS), ['theme' => $theme->value]);
    }
}
