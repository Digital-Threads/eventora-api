<?php

namespace Tests\Infrastructure\HealthCheck\Checks;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\HealthCheck\Checks\DatabaseCheck;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class DatabaseCheckTest extends TestCase
{
    use WithFaker;

    public function testFail(): void
    {
        $e = new Exception($this->faker->uuid());
        $facade = DB::spy();

        $facade
            ->shouldReceive('connection')
            ->once()
            ->andReturnSelf();

        $facade
            ->shouldReceive('getPdo')
            ->once()
            ->andReturnUsing(static function () use ($e) {
                throw $e;
            });

        $check = new DatabaseCheck();

        $this->expectException(CheckFailedException::class);
        $this->expectExceptionMessage($e->getMessage());

        $check->check();
    }
}
