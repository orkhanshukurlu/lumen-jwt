<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception): Response|JsonResponse
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->respondMessage('Method not allowed', 405);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->respondMessage('Not found', 404);
        }

        if ($exception instanceof ValidationException) {
            return $this->respondError('Validation errors', $exception->errors(), 422);
        }

        return parent::render($request, $exception);
    }
}
