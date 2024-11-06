<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (HttpException $e) {
            if ($e->getStatusCode() === 404) {
                return response()->view('imfeelinglucky::404', [], 404);
            }
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 404) {
                return response()->view('imfeelinglucky::404', [], 404);
            }
        }
        return parent::render($request, $exception);
    }
}
