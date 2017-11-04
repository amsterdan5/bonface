<?php

/**
 * ajax返回结构体
 */
if (!function_exists('jsonAjax')) {
    function jsonAjax(int $code = 0, string $msg = '', array $data = [])
    {
        $data = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];
        return response()->json($data);
    }
}

/**
 * 请求
 */
if (!function_exists('request')) {
    function request()
    {
        return new \Illuminate\Http\Request;
    }
}
