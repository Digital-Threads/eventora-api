<?php

use App\Application;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\ValidationException;
use Infrastructure\Console\Commands\CiCommand;
use Infrastructure\Console\Commands\InstallCommand;
use Infrastructure\Console\Commands\MakeCommands\MakeModuleFileCommand;
use Infrastructure\Console\Commands\MakeCommands\ModelMakeCommand;
use Infrastructure\Console\Commands\MakeCommands\ModuleMakeCommand;
use Infrastructure\Http\Middlewares\Authenticate;
use Infrastructure\Http\Middlewares\BlockWhenInProduction;
use Infrastructure\Http\Middlewares\CheckRoleMiddleware;
use Infrastructure\Http\Middlewares\PreventRequestsDuringMaintenance;
use Infrastructure\Http\Middlewares\TrimStrings;
use Infrastructure\Http\Middlewares\TrustProxies;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use League\OAuth2\Server\Exception\OAuthServerException;

function getModuleRoutes(string $modulePath): array
{
    $routes = [];
    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($modulePath)) as $file) {
        if ($file->isFile() && $file->getFilename() === 'routes.php') {
            $routes[] = $file->getPathname();
        }
    }

    return $routes;
}

$moduleRoutes = getModuleRoutes(__DIR__.'/../src/Modules');

return Application::configure(basePath: dirname(__DIR__))
    ->withCommands([
        InstallCommand::class,
        CiCommand::class,
        ModelMakeCommand::class,
        ModuleMakeCommand::class,
        MakeModuleFileCommand::class,
    ])
    ->withProviders([

    ])
    ->withRouting(
        api: $moduleRoutes,
        commands: __DIR__.'/../src/Infrastructure/Console/console.php',
        health: '/up',
        apiPrefix: '/api',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Глобальные миддлвары
        $middleware->append(HandleCors::class);
        $middleware->append(TrimStrings::class);
        $middleware->append(TrustProxies::class);
        $middleware->append(PreventRequestsDuringMaintenance::class);
        $middleware->append(ConvertEmptyStringsToNull::class);
        $middleware->append(BlockWhenInProduction::class);
        // Группы миддлваров
        $middleware->appendToGroup('api', [
            'throttle:api',
            SubstituteBindings::class,
        ]);

        // Миддлвары для маршрутов
        $middleware->alias([
            'auth'      => Authenticate::class,
            'throttle'  => ThrottleRequests::class,
            'checkRole' => CheckRoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationException $e, $request) {
            return response()->errorBag($e->errors(), $e->status);
        });

        // Handle Unauthenticated Exceptions
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            return response()->unauthenticated();
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            if ($e instanceof ModelNotFoundException || $e instanceof ItemNotFoundException) {
                return response()->notFound();
            }
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            if ($e instanceof NotFoundHttpException || $e instanceof MethodNotAllowedHttpException) {
                return response()->notFound();
            }
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            if ($e instanceof AuthorizationException || $e instanceof ThrottleRequestsException) {
                return response()->forbidden($e->getMessage());
            }
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            if ($e instanceof OAuthServerException) {
                return response()->json(['error' => $e->getMessage()], $e->getHttpStatusCode());
            }
        });

//        $exceptions->renderable(function (Throwable $e, $request) {
//            return response()->json([
//                'error'   => 'Unexpected error occurred',
//                'message' => $e->getMessage(),
//            ], 500);
//        });
    })
    ->create();
