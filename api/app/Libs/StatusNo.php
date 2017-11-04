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

    const NO_ACCOUNT_PASSWD = 200; //请输入账号，密码
    const ADD_ADMIN_SUCCESS = 201; //添加账号成功
    const ADD_ADMIN_FAILED  = 202; //添加账号失败

    const FILE_UPLOAD_FAILED  = 301; //图片上传失败
    const NO_FILE             = 302; //请上传图片
    const NO_FILE_TYPE        = 303; //无效类型
    const FILE_UPLOAD_SUCCESS = 304; //图片上传成功

    const EXCEPTION = 9999; //错误

    public static $status_msg = [
        self::FAILED                => '失败',
        self::SUCCESS               => '成功',

        self::LOGIN_SUCCESS         => '登录成功',
        self::NO_LOGIN              => '未登录',
        self::ACCOUNT_PASSWD_FAILED => '账号名密码错误',
        self::TOKNE_TIMEOUT         => '登录失效',
        self::PASSWD_IS_DIFF        => '两次密码不一致',
        self::CHANGE_PASSWD_SUCCESS => '密码修改成功',
        self::CHANGE_PASSWD_FAILED  => '密码修改失败',

        self::NO_ACCOUNT_PASSWD     => '请输入账号，密码',
        self::ADD_ADMIN_SUCCESS     => '添加账号成功',
        self::ADD_ADMIN_FAILED      => '添加账号失败',

        self::FILE_UPLOAD_FAILED    => '图片上传失败',
        self::NO_FILE               => '请上传图片',
        self::NO_FILE_TYPE          => '无效类型',
        self::FILE_UPLOAD_SUCCESS   => '图片上传成功',
    ];

    // 获取状态信息
    public static function getStatusMsg($code)
    {
        return isset(self::$status_msg[$code]) ? self::$status_msg[$code] : '未知状态';
    }
}
