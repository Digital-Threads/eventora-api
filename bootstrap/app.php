<?php

use App\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Infrastructure\Http\Middlewares\Authenticate;
use Infrastructure\Http\Middlewares\BlockWhenInProduction;
use Infrastructure\Http\Middlewares\CheckRoleMiddleware;
use Infrastructure\Http\Middlewares\PreventRequestsDuringMaintenance;
use Infrastructure\Http\Middlewares\TrimStrings;
use Infrastructure\Http\Middlewares\TrustProxies;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([

    ])
    ->withRouting(
        health: '/up',
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
        //
    })
    ->create();