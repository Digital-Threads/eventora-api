<?php

use App\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
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

$moduleRoutes = getModuleRoutes(__DIR__ . '/../src/Modules');
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
        //
    })
    ->create();
