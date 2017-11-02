<?php

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
