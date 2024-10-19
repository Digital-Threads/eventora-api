<?php

namespace Infrastructure\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

final class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        \League\OAuth2\Server\Exception\OAuthServerException::class,
        \Laravel\Passport\Exceptions\OAuthServerException::class,
        \Illuminate\Validation\UnauthorizedException::class,
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Http\Exceptions\ThrottleRequestsException::class,
        //        \Illuminate\Validation\ValidationException::class,
        \Infrastructure\Auth\CheckException::class,
    ];

    /**
     * A list of the forbidden exception types.
     *
     * @var string[]
     */
    protected $forbiddenExceptions = [
        \Illuminate\Http\Exceptions\ThrottleRequestsException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
    ];

    /**
     * A list of the resource not found exception types.
     *
     * @var string[]
     */
    protected $resourceFoundExceptions = [
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Support\ItemNotFoundException::class,
    ];

    /**
     * A list of the not found exception types.
     *
     * @var string[]
     */
    protected $notFoundExceptions = [
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
        \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'password',
    ];

    protected function shouldReturnJson($request, Throwable $e)
    {
        return true;
    }

    private function isInstanceOf(Throwable $e, array $classnames): bool
    {
        foreach ($classnames as $className) {
            if ($e instanceof $className) {
                return true;
            }
        }

        return false;
    }

    protected function isForbiddenException(Throwable $e)
    {
        return $this->isInstanceOf($e, $this->forbiddenExceptions);
    }

    protected function isHttpNotFoundException(Throwable $e)
    {
        return $this->isInstanceOf($e, $this->notFoundExceptions);
    }

    protected function isResourceNotFoundException(Throwable $e)
    {
        return $this->isInstanceOf($e, $this->resourceFoundExceptions);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        return response()->errorBag($e->errors(), $e->status);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->unauthenticated();
    }

    public function render($request, Throwable $e)
    {
        if ($this->isResourceNotFoundException($e)) {
            return response()->notFound();
        }

        if ($this->isHttpNotFoundException($e)) {
            return response()->notFound();
        }

        if ($this->isForbiddenException($e)) {
            return response()->forbidden($e->getMessage());
        }

        return parent::render($request, $e);
    }
}
