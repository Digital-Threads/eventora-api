<?php

namespace Tests\Infrastructure\HealthCheck\Checks;

use Exception;
use Hamcrest\Matchers;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\WithFaker;
use Infrastructure\HealthCheck\Checks\LogCheck;
use Infrastructure\HealthCheck\Exceptions\CheckFailedException;
use Tests\Infrastructure\AbstractInfrastructureTestCase as TestCase;

final class LogCheckTest extends TestCase
{
    use WithFaker;

    public function testFail(): void
    {
        $e = new Exception($this->faker->uuid());

        Log::spy()
            ->shouldReceive('info')
            ->withArgs([Matchers::stringValue()])
            ->once()
            ->andReturnUsing(static function () use ($e) {
                throw $e;
            });

        $check = new LogCheck();

        $this->expectException(CheckFailedException::class);
        $this->expectExceptionMessage($e->getMessage());

        $check->check();
    }
}
