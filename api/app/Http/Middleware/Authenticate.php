<?php

namespace App\Http\Middleware;

use App\Libs\StatusNo;
use App\Model\Token;
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
        if (!$request->header('token')) {
            return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        }

        $tokenModel = new Token();
        $token      = $tokenModel->getToken($request->header('token'));
        if (!$token) {
            return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        }

        if ($token->validate < time()) {
            return jsonAjax(StatusNo::TOKNE_TIMEOUT, StatusNo::getStatusMsg(StatusNo::TOKNE_TIMEOUT));
        }

        if (!app('session')->get('admin_name') || !app('session')->get('admin_id')) {
            return jsonAjax(StatusNo::NO_LOGIN, StatusNo::getStatusMsg(StatusNo::NO_LOGIN));
        }

        return $next($request);
    }
}
