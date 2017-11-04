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
// 修改密码
$router->post('/admin/add-admin', 'AdminController@addAdmin');
// // banner 列表
// $router->get('/admin/banner-list', 'AdminController@bannerList');
// $router->post('/admin/banner-list', 'AdminController@bannerList');
// 添加/编辑banner
$router->post('/admin/add-banner', 'AdminController@addBanner');
// 删除banner
$router->get('/admin/del-banner', 'AdminController@delBanner');
$router->post('/admin/del-banner', 'AdminController@delBanner');
// 产品系列
$router->post('/admin/product-line', 'AdminController@productLine');
// // 产品列表
// $router->post('/admin/product-list', 'AdminController@productList');
// 添加/编辑产品
$router->post('/admin/add-product', 'AdminController@addPorduct');
// 删除产品
$router->get('/admin/del-product', 'AdminController@delPorduct');
$router->post('/admin/del-product', 'AdminController@delPorduct');
// 主题列表
$router->post('/admin/theme-list', 'AdminController@themeList');
// 更换主题
$router->post('/admin/change-theme', 'AdminController@changeTheme');
// 图片上传
$router->post('/admin/upload-image', 'AdminController@uploadImage');

/******* 用户端接口 **********/
// banner 列表
$router->get('/user/banner-list', 'UserController@bannerList');
$router->post('/user/banner-list', 'UserController@bannerList');
// 产品系列
$router->get('/user/product-line', 'UserController@productLine');
$router->post('/user/product-line', 'UserController@productLine');
// 产品列表
$router->get('/user/product-list', 'UserController@productList');
$router->post('/user/product-list', 'UserController@productList');
// 产品详情
$router->get('/user/product-detail', 'UserController@productDetail');
$router->post('/user/product-detail', 'UserController@productDetail');
// 当前主题
$router->get('/user/get-theme', 'UserController@change-theme');
