<?php
namespace App\Libs;

/**
 * 状态码规范
 */
class StatusNo
{
    const FAILED  = 0; //失败
    const SUCCESS = 1; //成功

    const LOGIN_SUCCESS         = 100; //登录成功
    const NO_LOGIN              = 101; //未登录
    const ACCOUNT_PASSWD_FAILED = 102; //账号名密码错误
    const TOKNE_TIMEOUT         = 103; //登录失效
    const PASSWD_IS_DIFF        = 104; //两次密码不一致
    const CHANGE_PASSWD_SUCCESS = 105; //密码修改成功
    const CHANGE_PASSWD_FAILED  = 106; //密码修改失败
    const ACCOUNT_IS_EXISTS     = 107; //账号已存在

    const NO_ACCOUNT_PASSWD = 200; //请输入账号，密码
    const ADD_ADMIN_SUCCESS = 201; //添加账号成功
    const ADD_ADMIN_FAILED  = 202; //添加账号失败

    const FILE_UPLOAD_FAILED  = 301; //图片上传失败
    const NO_FILE             = 302; //请上传图片
    const NO_FILE_TYPE        = 303; //无效类型
    const FILE_UPLOAD_SUCCESS = 304; //图片上传成功

    const PRODUCT_INFO_LACK        = 401; //请完整填写产品信息
    const PRODUCT_INFO_ADD_SUCCESS = 402; //产品添加成功
    const PRODUCT_INFO_ADD_FAILED  = 403; //产品添加失败
    const PRODUCT_ID_LACK          = 404; //缺少产品id
    const PRODUCT_DEL_SUCCESS      = 405; //产品删除成功
    const PRODUCT_DEL_FAILED       = 406; //产品删除失败

    const BANNER_INFO_ADD_SUCCESS = 502; //banner添加成功
    const BANNER_INFO_ADD_FAILED  = 503; //banner添加失败
    const BANNER_ID_LACK          = 504; //缺少banner id
    const BANNER_DEL_SUCCESS      = 505; //banner删除成功
    const BANNER_DEL_FAILED       = 506; //banner删除失败
    const BANNER_LEAST_ONE        = 507; //banner至少需要保留一条
    const BANNER_MAX_SIX          = 508; //banner最多6条

    const THEME_IS_NOT_SELECT  = 601; //请选择主题
    const THEME_CHANGE_SUCCESS = 602; //更换主题成功
    const THEME_CHANGE_FAILED  = 603; //更换主题失败
    const UNKONW_THEME         = 604; //未知主题

    const EXCEPTION = 9999; //错误

    public static $status_msg = [
        self::FAILED                   => '失败',
        self::SUCCESS                  => '成功',

        self::LOGIN_SUCCESS            => '登录成功',
        self::NO_LOGIN                 => '未登录',
        self::ACCOUNT_PASSWD_FAILED    => '账号名密码错误',
        self::TOKNE_TIMEOUT            => '登录失效',
        self::PASSWD_IS_DIFF           => '两次密码不一致',
        self::CHANGE_PASSWD_SUCCESS    => '密码修改成功',
        self::CHANGE_PASSWD_FAILED     => '密码修改失败',
        self::ACCOUNT_IS_EXISTS        => '账号已存在',

        self::NO_ACCOUNT_PASSWD        => '请输入账号，密码',
        self::ADD_ADMIN_SUCCESS        => '添加账号成功',
        self::ADD_ADMIN_FAILED         => '添加账号失败',

        self::FILE_UPLOAD_FAILED       => '图片上传失败',
        self::NO_FILE                  => '请上传图片',
        self::NO_FILE_TYPE             => '无效类型',
        self::FILE_UPLOAD_SUCCESS      => '图片上传成功',

        self::PRODUCT_INFO_LACK        => '请完整填写产品信息',
        self::PRODUCT_INFO_ADD_SUCCESS => '产品保存成功',
        self::PRODUCT_INFO_ADD_FAILED  => '产品保存失败',
        self::PRODUCT_ID_LACK          => '缺少产品id',
        self::PRODUCT_DEL_SUCCESS      => '产品删除成功',
        self::PRODUCT_DEL_FAILED       => '产品删除失败',

        self::BANNER_INFO_ADD_SUCCESS  => 'banner保存成功',
        self::BANNER_INFO_ADD_FAILED   => 'banner保存失败',
        self::BANNER_ID_LACK           => '缺少banner id',
        self::BANNER_DEL_SUCCESS       => 'banner删除成功',
        self::BANNER_DEL_FAILED        => 'banner删除失败',
        self::BANNER_LEAST_ONE         => 'banner至少需要保留一条',
        self::BANNER_MAX_SIX           => 'banner最多6条',

        self::THEME_IS_NOT_SELECT      => '请选择主题',
        self::THEME_CHANGE_SUCCESS     => '更换主题成功',
        self::THEME_CHANGE_FAILED      => '更换主题失败',
        self::UNKONW_THEME             => '未知主题',
    ];

    // 获取状态信息
    public static function getStatusMsg($code)
    {
        return isset(self::$status_msg[$code]) ? self::$status_msg[$code] : '未知状态';
    }
}
