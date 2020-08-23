<?php

namespace App\Exceptions;

use Throwable;
use App\Http\Responses\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $class = get_class($exception);

        switch ($class) {
            case NotFoundHttpException::class:
                $message = 'Endpoint not found';
                return response(compact('message'), Response::HTTP_METHOD_NOT_ALLOWED);

            case ValidationException::class:
                $message = $exception->errors();
                return response(compact('message'), Response::HTTP_UNPROCESSABLE_ENTITY);

            case ModelNotFoundException::class:
                $message = 'Model not found';
                return response(compact('message'), Response::HTTP_NOT_FOUND);

            default:
                $message = $exception->getMessage() ?: 'We have an error...';
                $code = is_callable([$exception, 'getStatusCode'])
                    ? $exception->getStatusCode()
                    : Response::HTTP_INTERNAL_SERVER_ERROR;
                return response(compact('message'), $code);
        }

        return parent::render($request, $exception);
    }
}
