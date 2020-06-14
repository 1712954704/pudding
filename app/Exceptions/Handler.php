<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        //如果路由中含有“admin/”，则说明是一个 后台 的接口请求
        if ($request->is('admin/*')) {
            //如果错误是 ValidationException的一个实例，说明是一个验证的错误
            if ($request->ajax()) {
                if ($exception instanceof ValidationException) {
                    $result = [
                        'code'  => 416,
                        'msg'   => array_values($exception->errors())[0][0],
                        'data'  => '',
                        'count' => '',
                    ];
                    return response()->json($result);
                }
            }
        }else if($request->is('api/*')){
            if ($exception instanceof ValidationException) {
                $result = [
                    'code'  => 416,
                    'msg'   => array_values($exception->errors())[0][0],
                    'data'  => '',
                    'count' => '',
                ];
                return response()->json($result);
            }
        }
        return parent::render($request, $exception);
    }
}
