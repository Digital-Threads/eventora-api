<?php

namespace Modules\OAuth;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository;
use Laravel\Passport\Bridge\UserRepository;
use Laravel\Passport\Passport;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Modules\OAuth\Grants\PasswordGrant;
use Modules\OAuth\Grants\PasswordSignupGrant;

final class ServiceProvider extends BaseServiceProvider
{
    public array $bindings = [
        UserRepositoryInterface::class         => UserRepository::class,
        RefreshTokenRepositoryInterface::class => RefreshTokenRepository::class,
    ];

    protected array $grants = [
        PasswordGrant::class,
        PasswordSignupGrant::class,
    ];

    public function register(): void
    {
        $this->app->extend(AuthorizationServer::class, function (AuthorizationServer $server): AuthorizationServer {
            foreach ($this->grants as $grant) {
                $server->enableGrantType(app($grant), Passport::tokensExpireIn());
            }
            return $server;
        });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');

        Passport::tokensCan(config('passport.scopes'));
        Passport::tokensExpireIn(now()->addDays(config('passport.tokens_expire_in')));
        Passport::personalAccessTokensExpireIn(now()->addDays(config('passport.personal_access_tokens_expire_in')));
        Passport::refreshTokensExpireIn(now()->addDays(config('passport.refresh_tokens_expire_in')));
    }
}
