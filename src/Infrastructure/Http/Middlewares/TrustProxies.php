<?php

namespace Infrastructure\Http\Middlewares;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;

final class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int,string>|string|null
     */
    protected $proxies;

    /**
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_AWS_ELB;
}
