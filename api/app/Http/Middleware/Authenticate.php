<?php

namespace App\Http\Middleware;

use App\Libs\StatusNo;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // $this->checkLoginBySession();

        // if (!$request->header('token')) {
        //     return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        // }

        // $tokenModel = new Token();
        // $token      = $tokenModel->getToken($request->header('token'));
        // if (!$token) {
        //     return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        // }

        // if ($token->validate < time()) {
        //     return jsonAjax(StatusNo::TOKNE_TIMEOUT, StatusNo::getStatusMsg(StatusNo::TOKNE_TIMEOUT));
        // }

        return $next($request);
    }

    // 检测登录
    public function checkLoginBySession()
    {
        if (!session('uid') || !session('username')) {
            return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        }
    }
}
