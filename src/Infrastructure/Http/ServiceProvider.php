<?php

namespace Infrastructure\Http;

use Illuminate\Http\Request;
use Infrastructure\Http\Macros\IdMacro;
use Illuminate\Cache\RateLimiting\Limit;
use Infrastructure\Http\Macros\ErrorMacro;
use Illuminate\Support\Facades\RateLimiter;
use Infrastructure\Http\Macros\SchemaMacro;
use Infrastructure\Http\Macros\ErrorBagMacro;
use Infrastructure\Http\Macros\NotFoundMacro;
use Infrastructure\Http\Macros\ErrorListMacro;
use Infrastructure\Http\Macros\ForbiddenMacro;
use Infrastructure\Http\Macros\UnauthenticatedMacro;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

/**
 * @OA\Info(title="API", version="2.0.0-alpha")
 */
final class ServiceProvider extends RouteServiceProvider
{
    public function boot(): void
    {
        SchemaMacro::bind();
        IdMacro::bind();
        ErrorBagMacro::bind();
        ErrorMacro::bind();
        ErrorListMacro::bind();
        UnauthenticatedMacro::bind();
        ForbiddenMacro::bind();
        NotFoundMacro::bind();

        $this->configureRateLimiting();
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', static function (Request $request) {
            return Limit::perMinute(240)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
