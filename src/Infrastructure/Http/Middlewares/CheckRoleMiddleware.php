<?php
 namespace Infrastructure\Http\Middlewares;
use Closure;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role->name !== $role) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}