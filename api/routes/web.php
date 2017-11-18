<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
	return $router->app->version();
});
// /******* 后台接口 ************/
// 登录
$router->post('/admin/login', 'AdminController@login');
// 添加管理员
$router->post('/admin/add-admin', 'AdminController@addAdmin');
// 修改密码
$router->post('/admin/change-pwd', 'AdminController@changePwd');
// 添加/编辑banner
$router->post('/admin/save-banner', 'AdminBannerController@saveBanner');
// 删除banner
$router->post('/admin/del-banner', 'AdminBannerController@delBanner');
// 修改密码
$router->get('/admin/save-line', 'AdminProductController@saveProductLine');
// 添加/编辑产品
$router->post('/admin/save-product', 'AdminProductController@saveProduct');
// 删除产品
$router->post('/admin/del-product', 'AdminProductController@delProduct');
// 主题列表
$router->get('/admin/theme-list', 'AdminThemeController@themeList');
// 更换主题
$router->post('/admin/change-theme', 'AdminThemeController@changeTheme');
// 图片上传
$router->post('/admin/upload-image', 'AdminController@uploadImage');

/******* 用户端接口 **********/
// banner 列表
$router->get('/user/banner-list', 'UserController@bannerList');
// 产品系列
$router->get('/user/product-line', 'UserController@productLine');
// 产品列表
$router->get('/user/product-list', 'UserController@productList');
// 产品详情
$router->get('/user/product-detail', 'UserController@productDetail');
// 当前主题
$router->get('/user/get-theme', 'UserController@getTheme');
