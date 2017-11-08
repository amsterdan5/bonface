<?php

namespace App\Exceptions;

use App\Libs\StatusNo;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if (ENV === 'PRODUCTION') {
            if ($email_tos = config('mail.to')) {
                $email_tos = explode(',', $email_tos);
                $message   = '错误信息：' . $e->getMessage() . '<br/>文件：' . $e->getFile() . '<br/>行号：' . $e->getLine();
                foreach ($email_tos as $to) {
                    send_mail($to, '系统错误', $message);
                }
            }

            parent::render($request, $e);
            return jsonAjax(StatusNo::FAILED, StatusNo::getStatusMsg(StatusNo::EXCEPTION));
        }

        return parent::render($request, $e);
    }
}
