<?php

namespace Tests\Utils\Traits;

use Closure;
use Mockery;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;

trait WithSocialiteFake
{
    protected function expectFetchUserFromToken(string $driver, string $token, Closure | User | array $result = []): void
    {
        Socialite::shouldReceive('driver')
            ->withArgs([$driver])
            ->once()
            ->andReturn($driver = Mockery::mock(AbstractProvider::class));

        $driver
            ->shouldReceive('userFromToken')
            ->withArgs([$token])
            ->once()
            ->andReturnUsing(function () use ($result) {
                $result = value($result);

                if ($result instanceof User) {
                    return $result;
                }

                return $this->faker->socialiteUser($result);
            });
    }
}
