<?php

namespace Infrastructure\Http\Middlewares;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

final class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array<int,string>
     */
    protected $except = [
        //
    ];
}
