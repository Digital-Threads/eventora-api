<?php

namespace Tests\Infrastructure\HealthCheck\Checks;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\HealthCheck\Checks\CacheCheck;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class CacheCheckTest extends TestCase
{
    use WithFaker;

    public function testPutFail(): void
    {
        $e = new Exception($this->faker->uuid());
        $facade = Cache::spy();

        $facade
            ->shouldReceive('put')
            ->once()
            ->andReturnUsing(static function () use ($e) {
                throw $e;
            });

        $check = new CacheCheck();

        $this->expectException(CheckFailedException::class);
        $this->expectExceptionMessage($e->getMessage());

        $check->check();
    }

    public function testPullFail(): void
    {
        $e = new Exception($this->faker->uuid());
        $facade = Cache::spy();

        $facade
            ->shouldReceive('put')
            ->once()
            ->andReturnNull();

        $facade
            ->shouldReceive('pull')
            ->once()
            ->andReturnUsing(static function () use ($e) {
                throw $e;
            });

        $check = new CacheCheck();

        $this->expectException(CheckFailedException::class);
        $this->expectExceptionMessage($e->getMessage());

        $check->check();
    }

    public function testPullReturnedWrongValue(): void
    {
        $facade = Cache::spy();

        $facade
            ->shouldReceive('put')
            ->withArgs(['1'])
            ->andReturnNull();

        $facade
            ->shouldReceive('pull')
            ->andReturn('0');

        $check = new CacheCheck();

        $this->expectException(CheckFailedException::class);

        $check->check();
    }
}
