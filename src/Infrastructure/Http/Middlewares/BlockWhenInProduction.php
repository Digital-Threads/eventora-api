<?php

namespace Infrastructure\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

final class BlockWhenInProduction
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (App::environment('production')) {
            return response()->error('blocked');
        }

        return $next($request);
    }
}
