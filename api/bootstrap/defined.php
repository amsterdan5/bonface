<?php

/**
 * 常量定义
 */
// -----------------------------------------------------------------------------
// 路径常量定义
// -----------------------------------------------------------------------------

// 定义项目根目录
define('ROOT_PATH', dirname(dirname(__DIR__)) . '/api');

// WEB 所在目录
define('DOC_PATH', ROOT_PATH . '/public');

// 上传所在目录
define('UPLOAD_PATH', ROOT_PATH . '/public/uploads');

// 项目所在目录
define('APP_PATH', ROOT_PATH . '/app');

// 配置项目所在目录
define('CONF_PATH', ROOT_PATH . '/app/config');

// 引导项目所在目录
define('BOOT_PATH', ROOT_PATH . '/app/bootstrap');

// 功能函数所在目录
define('FUNC_PATH', ROOT_PATH . '/app/functions');

// 上传的图片所在目录
define('IMAGE_PATH', ROOT_PATH . '/../images');

// 样式所在目录
define('CSS_PATH', ROOT_PATH . '/../static/css');

// 外部库所在目录
define('VEN_PATH', ROOT_PATH . '/vendor');

// 数据存放目录
define('DATA_PATH', ROOT_PATH . '/data');

// 日志存放目录
define('LOGS_PATH', ROOT_PATH . '/data/logs');

// -----------------------------------------------------------------------------
// 项目常量定义
// -----------------------------------------------------------------------------

// 定义项目开始时间
defined('START_TIME') || define('START_TIME', microtime(true));

// 定义项目初始内存
defined('START_MEMORY') || define('START_MEMORY', memory_get_usage());

// 项目版本
define('VERSION', '1.0.0');

// -----------------------------------------------------------------------------
// CREDIT-ENGINE API 常量定义
// -----------------------------------------------------------------------------

// 项目ID
define('CE_APP_ID', 'loan');

// 密钥
define('CE_APP_KEY', '9a8f15800a7e598a');

/**
 * 定义开发环境
 * 如果服务器定义了 APP_ENV 变量，则以 APP_ENV 值作为环境定义
 *
 * @example for nginx config
 *     location ~ \.php$ {
 *         ...
 *         fastcgi_param APP_ENV 'PRODUCTION'; # PRODUCTION|TESTING|DEVELOPMENT
 *     }
 */
if (isset($_SERVER['AP_ENV'])) {
    defined($env = strtoupper($_SERVER['AP_ENV'])) || define($env, true);
    unset($env, $_SERVER['AP_ENV']);
}

// 生产环境
defined('PRODUCTION') || define('PRODUCTION', is_file('/etc/php.env.production'));

// 预发环境
defined('STAGING') || define('STAGING', is_file('/etc/php.env.staging'));

// 测试环境
defined('TESTING') || define('TESTING', is_file('/etc/php.env.testing'));

// 开发环境
defined('DEVELOPMENT') || define('DEVELOPMENT', !(PRODUCTION || STAGING || TESTING));

// 环境常量
if (PRODUCTION) {
    defined('ENV') || define('ENV', 'PRODUCTION');
} elseif (TESTING) {
    defined('ENV') || define('ENV', 'TESTING');
} else {
    defined('ENV') || define('ENV', 'DEVELOPMENT');
}

//版本
defined('APP_VERSION') || define(
    'APP_VERSION',
    isset($_SERVER['APP_VERSION']) && $_SERVER['APP_VERSION'] != 'version' && $_SERVER['APP_VERSION'] != 'mobile' ? $_SERVER['APP_VERSION'] : ''
);
unset($_SERVER['APP_VERSION']);

// -----------------------------------------------------------------------------
// 环境常量定义
// -----------------------------------------------------------------------------

// 定义是否 CLI 模式
define('IS_CLI', (PHP_SAPI === 'cli'));

// 定义是否 windows 环境
define('IS_WIN', (DIRECTORY_SEPARATOR === '\\'));

if (IS_CLI) {
    define('IS_AJAX', false);
    define('IS_CURL', false);
    define('HTTP_HOST', null);
    define('HTTP_PROTOCOL', null);
    define('HTTP_BASE', null);
    define('HTTP_URL', null);
} else {
    // 定义是否 AJAX 请求
    define('IS_AJAX',
        isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        'xmlhttprequest' === strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])
    );

    // 定义是否 cURL 请求
    define('IS_CURL', isset($_SERVER['HTTP_USER_AGENT']) &&
        stripos($_SERVER['HTTP_USER_AGENT'], 'curl') !== false);

    // 定义主机地址
    define('HTTP_HOST',
        isset($_SERVER['HTTP_X_FORWARDED_HOST'])
        ? strtolower($_SERVER['HTTP_X_FORWARDED_HOST'])
        : strtolower($_SERVER['HTTP_HOST'])
    );

    // 定义 HTTP 协议
    define('HTTP_PROTOCOL', (strpos($_SERVER['SERVER_PROTOCOL'], 'HTTPS') === false) ? 'http' : 'https');

    // 定义是否 SSL
    define('HTTP_SSL', HTTP_PROTOCOL === 'https');

    // 定义当前基础域名
    define('HTTP_BASE',
        ($_SERVER['SERVER_PORT'] == '80' || $_SERVER['SERVER_PORT'] == '443')
        ? (HTTP_PROTOCOL . '://' . HTTP_HOST . '/')
        : (HTTP_PROTOCOL . '://' . HTTP_HOST . ':' . $_SERVER['SERVER_PORT'] . '/')
    );

    // 定义当前页面 URL 地址
    define('HTTP_URL', rtrim(HTTP_BASE, '/') . $_SERVER['REQUEST_URI']);
}
